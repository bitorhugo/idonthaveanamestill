<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //return showcase cards and available categories
        $showcase = Card::all()->take(8);
        $categories = Category::all();
        return view('home')->with(
            [
                'showcase' => $showcase,
                'categories' => $categories
            ]);
    }
}
