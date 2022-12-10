<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('isAdmin');
    }

    public function index()
    {
        $allUsers['usersjson'] = User::paginate(10);
        $allUsers['users']     = $allUsers['usersjson']->toArray();
        $allUsers['keys']      = array_keys(current($allUsers['users']['data']));
        return view('admin.users.index')->with($allUsers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // use make() in order to not persist model in database
        $arr['user'] = User::factory()->make();
        $arr['user']->makeVisible('password');
        return view('admin.users.create')->with($arr);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user)
    {
        $hashed = $request->collect()
            ->replace(
                ['password' => Hash::make($request['password'])]
            );

        $filtered = $hashed->collect()
            ->except(['_token']);

        $filtered->collect()
            ->each(         // on ->each, the order of $key $value gets flipped
                fn ($value, $key) => $user->$key = $value
            );

        $user->save();
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

        //        return view('admin.users.show')->with(['user' => $user]);
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
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $filtered = $request->collect()
            ->except(['_token', '_method']);

        $filtered->collect()
            ->each(         // on ->each, the order of $key $value gets flipped
                fn ($value, $key) => $user->$key = $value
            );

        $user->save();
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
