<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Users\UserPatchRequest;
use App\Http\Requests\Admin\Users\UserPostRequest;
use App\Models\User;
use App\Services\MediaService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class AdminUserController extends Controller
{

    /**
     * __construct
     */
    public function __construct()
    {
        $this->middleware('isAdmin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->has('q')){
            $users = User::search($request->input('q'))
                   ->paginate(15);
            return view('admin.users.index')->with([
                'users' => $users,
            ]);
        }

        // cache paginated results
        $users = Cache::remember('users-page-' . ($request->page ?? 1),
                                 now()->addDay(),
                                 function() {
                                     return User::paginate();
                                 });
        
        return view('admin.users.index')->with([
            'users' => $users,
        ]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // use make() in order to not persist model in database
        $user = User::factory()->make();
        $user->makeVisible('password');
        return view('admin.users.create')->with(['user' => $user]);
    }

    
    /**
     * Store a newly created resource in storage.
     *
     * @param UserPostRequest $request
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function store(UserPostRequest $request, User $user)
    {
        $safe = $request->safe();
        $filtered = collect($safe->except('image'))
                  ->replace(
                      ['password' => Hash::make($safe->password),
                       'remember_token' => Str::random(10),
                      ]
                  );
        
        $filtered->each(
            fn ($value, $key) => $user->$key = $value
        );
        
        $user->save();
        
        // get images
        if($safe->__isset('image')) {
            MediaService::addUserMedia($user, $safe->image);
        }
                            
        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('admin.users.show')->with(['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $user->makehidden('id');
        return view('admin.users.edit')->with(['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserPatchRequest $request
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserPatchRequest $request, User $user)
    {
        $safe = $request->safe();
        $filtered = collect($safe->except('image'));

        $filtered->each(
            function ($value, $key) use ($user) {
                if (!is_null($value)) {
                    $user->$key = $value;
                }
            });
        
        $user->save();

        if($safe->__isset('image')) {
            $user->clearMediaCollection();
            MediaService::addUserMedia($user, $safe->image);            
        }
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->route('users.index');
    }
}
