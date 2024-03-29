<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Categories\CategoryPatchRequest;
use App\Http\Requests\Admin\Categories\CategoryPostRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class AdminCategoryController extends Controller
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
        if ($request->has('q')) {
            $categories = Category::search($request->input('q'))
                ->paginate(15);
            return view('admin.categories.index')->with([
                'categories' => $categories,
            ]);
        }

        $categories = Cache::remember('category-page-' . ($request->page ?? 1),
                                      now()->addDay(),
                                      function () {
                                          return Category::paginate();
                                      });
        
        return view('admin.categories.index')->with([
            'categories' => $categories,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $arr['category'] = Category::factory()->make();
       return view('admin.categories.create')->with($arr);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryPostRequest $request, Category $category)
    {
        $safe = $request->safe();
        $filtered = collect($safe);

        $filtered->each(
            function ($value, $key) use ($category){
                if(!is_null($value)){
                    $category->$key = $value;                      
                }
            } 
        );
        
        $category->save();
        
        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('admin.categories.show')->with(['category' => $category]);
    }

    /**
     * Show the form for editing the sppecified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $category->makehidden('id');
        return view('admin.categories.edit')->with(['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryPatchRequest $request, Category $category)
    {
        $safe = $request->safe();
        $filtered = collect($safe);

        $filtered->each(         // on ->each, the order of $key $value gets flipped
            function ($value, $key) use ($category){
                if(!is_null($value)){
                    $category->$key = $value;
                }
            });

        $category->save();

        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::destroy($id);
        return redirect()->route('categories.index');
    }
}
