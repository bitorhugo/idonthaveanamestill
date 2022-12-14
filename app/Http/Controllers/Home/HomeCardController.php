<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Card;
use App\Models\Card_Category;
use App\Models\Category;
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
        //TODO fix query
        if ($request->input('c') == 'none') {
            $cards = Card::search($request->input('q'))
                   ->paginate(5)
                   ->appends(['c' => 'none']);

            return view('home.cards.index')->with(['cards' => $cards]);
        }

        $cards = Card::search($request->input('q'));
        $category = Category::find($request->input('c'));



        return view('home.cards.index')->with(['cards' => $cards]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  Card $card
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $card = Card::find($id);
        // update card price with discount
        if ($card->discount_amount) {
            $card->price = $card->price - ($card->price * $card->discount_amount);
        }
        return view('home.cards.show')->with(['card' => $card]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
