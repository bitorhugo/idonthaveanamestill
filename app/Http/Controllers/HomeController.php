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
        $showcase = cache()->remember('showcase', now()->addSeconds(5), function () {
            return Card::join('inventories', 'cards.id', '=', 'inventories.card_id')
            ->where('inventories.quantity', '>', '0')
                ->where('cards.discount_amount', '>', '0')
                ->limit(8)
                ->get();
        });

        $recent = Card::orderBy('created_at', 'desc')
                ->take(8)
                ->get();
        
        $categories = Category::all();

        return view('home')->with(
            [
                'categories' => $categories,
                'showcase' => $showcase,
                'recent' => $recent,
            ]);
    }
}
