<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\Card_Category;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
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

        $recent = cache()->remember('recent', now()->addSecond(10), function () {
            return Card::join('inventories', 'cards.id', '=', 'inventories.card_id')
                ->where('inventories.quantity', '>', '0')
                ->orderBy('cards.created_at', 'desc')
                ->limit(8)
                ->get();
        });

        $promoCatXCards = cache()->remember('promoCatXCards', now()->addDay(), function () {
            return Card::
               join('card__categories', 'cards.id', '=', 'card__categories.card_id')
               ->join('categories', 'categories.id', '=', 'card__categories.category_id')
               ->join('inventories', 'inventories.card_id', '=', 'cards.id')
               ->where('card__categories.category_id', '=', rand(1, Category::count()))
               ->where('cards.discount_amount', '>', '0.3')
               ->where('inventories.quantity', '>', '0')
               ->select('cards.*')
               ->limit(8)
               ->get();
        });

        $lowStockDiscount = cache()->remember('lowStockDiscount', now()->addMinute(10), function () {
            return Card::join('inventories', 'cards.id', '=', 'inventories.card_id')
                ->whereBetween('inventories.quantity', [1, 25])
                ->where('cards.discount_amount', '>', '0')
                ->orderBy('cards.created_at', 'asc')
                ->limit(8)
                ->select('cards.*')
                ->get();
        });

        $categories = Category::all();

        return view('home')->with(
            [
                'categories'       => $categories,
                'showcase'         => $showcase,
                'recent'           => $recent,
                'promoCatXCards'   => $promoCatXCards,
                'lowStockDiscount' => $lowStockDiscount,
            ]);
    }
}
