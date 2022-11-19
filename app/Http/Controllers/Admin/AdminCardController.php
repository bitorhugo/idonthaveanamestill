<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Card;
use Illuminate\Http\Request;

class AdminCardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allCards['cards'] = Card::all()->toArray();
        $allCards['keys'] = array_keys(current($allCards['cards']));
        return view('admin.cards.index')->with($allCards);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // use make() in order to not persist model in database
        $arr['card'] = Card::factory()->make();
        return view('admin.cards.create')->with($arr);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Card $card)
    {
        $filtered = $request->collect()
            ->except(['_token']);

        $filtered->collect()
            ->each(         // on ->each, the order of $key $value gets flipped
                fn ($value, $key) => $card->$key = $value
            );
        $card->save();
        return redirect()->route('cards.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Card $card)
    {
        return view('admin.cards.show')->with(['card' => $card]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Card $card)
    {
        $card->makehidden('id');
        return view('admin.cards.edit')->with(['card' => $card]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Card $card)
    {
        $filtered = $request->collect()
                            ->except(['_token', '_method']);

        $filtered->collect()
            ->each(         // on ->each, the order of $key $value gets flipped
                fn ($value, $key) => $card->$key = $value
            );

        $card->save();
        return redirect()->route('cards.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Card::destroy($id);
        return redirect()->route('cards.index');
    }
}
