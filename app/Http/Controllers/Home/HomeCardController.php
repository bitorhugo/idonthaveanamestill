<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Card;
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
        if ($request->input('c') == 'none')
        {
            $cards = Card::search($request->input('q'))
                   ->paginate(5)->
                   appends(['c' => 'none']);
            return view('home.cards.index')->with(['cards' => $cards]);
        }
        else
        {
        $category = Category::find($request->input('c'));

        $cards = Card::search($request->input('q'))
               ->get();

        // filter cards with selected category
        $filtered = $cards->filter(function ($card) use ($category) {
            return $card
                ->categories()
                ->get()
                ->contains($category->id);
        })->paginate(2)
            ->withQueryString(); // don't forget to add current request's query string to retrieve category
        
        return view('home.cards.index')->with(['cards' => $filtered]);
        }
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
        return view ('home.cards.show')->with(['card' => $card]);
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
