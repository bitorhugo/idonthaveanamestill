<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


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
        $showcase = Card::join('inventories', 'cards.id', '=', 'inventories.card_id')
                  ->where('inventories.quantity', '>', '0')
                  ->where('cards.discount_amount', '>', '0')
                  ->limit(4)
                  ->get();

        $categories = Category::all();
        return view('home')->with(
            [
                'showcase' => $showcase,
                'categories' => $categories
            ]);
    }
}
