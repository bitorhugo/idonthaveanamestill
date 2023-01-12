<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Card;
use App\Models\Category;
use App\Services\SearchService;
use Illuminate\Http\Request;


class HomeCardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->sort == 'none') {
            $cards = SearchService::handleSearchCards($request->q, $request->category, $request->sort);
        } else {
            $cards = SearchService::handleOrderedSearchCards($request->q, $request->category, $request->sort);
        }

        return view('home.cards.index')->with([
            'q'          => $request->q,
            'sort'       => $request->sort,
            'category'   => $request->category,
            'cards'      => $cards,
            'categories' => Category::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(){}

    /**
     * Display the specified resource.
     *
     * @param  Card $card
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $card = Card::find($id);
        $categories = $card->categories;
        return view('home.cards.show')->with([
            'card'       => $card,
            'categories' => $categories,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){}


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(){}


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){}

}
