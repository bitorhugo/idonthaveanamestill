<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Cards\CardPatchRequest;
use App\Http\Requests\Admin\Cards\CardPostRequest;
use App\Models\Card;
use App\Models\Category;
use App\Models\Inventory;
use App\Services\InventoryService;
use Illuminate\Http\Request;

use App\Services\MediaService;
use Illuminate\Support\Facades\Cache;

class AdminCardController extends Controller
{
    
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
            $cards = Card::search($request->input('q'))
                ->paginate(15);
            return view('admin.cards.index')->with([
                'cards' => $cards,
            ]);
        }
        
        $cards = Cache::remember('cards-page-' . ($request->page ?? 1),
                                 now()->addDay(),
                                 function() {
                                     return Card::paginate();
                                 });
        
        return view('admin.cards.index')->with([
            'cards' => $cards,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // use make() in order to not persist model in database
        $card = Card::factory()->make();
        $categories = Category::all();
        return view('admin.cards.create')->with([
            'card' => $card,
            'categories' => $categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CardPostRequest $request, Card $card)
    {
        $safe = $request->safe();

        $filtered = collect($safe)
                  ->except(['_token', 'categories', 'quantity', 'image']);

        $filtered->each(         // on ->each, the order of $key $value gets flipped
            fn ($value, $key) => $card->$key = $value
        );

        $card->save();

        // add inventory
        $card->inventory()->save(new Inventory(['quantity' => $safe->quantity]));

        // add media if present
        if($safe->__isset('image')) {
            MediaService::addCardMedia($card, collect($safe->image));            
        }

        // attach categories to card
        $card->categories()->attach($safe->categories);
        
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
        return view('admin.cards.show')->with([
            'card' => $card,
            'categories' => $card->categories,
        ]);
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
        return view('admin.cards.edit')->with([
            'card' => $card,
            'cardCategories' => $card->categories,
            'categories' => Category::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CardPatchRequest $request, Card $card)
    {
        $safe = $request->safe();
        
        $filtered = collect($safe->except(['categories', 'quantity', 'image']));
        
        $filtered->each(         // on ->each, the order of $key $value gets flipped
            function ($value, $key) use ($card) {
                if (!is_null($value))  {
                    $card->$key = $value;
                }
            });

        // update inventory
        if($safe->__isset('quantity')){
            InventoryService::update($card->inventory, $safe->quantity);
        }
        
        // save both card and relation
        $card->push();

        // update categories
        if($safe->__isset('categories')){
            $card->categories()->sync($request->categories);
        }
        
        // update images
        if ($safe->__isset('image')) {
            MediaService::addCardMedia($card, collect($safe->image));
        }
        
        return redirect()->route('cards.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Card $card)
    {
        Card::destroy($card->id);
        return redirect()->route('cards.index');
    }


}
