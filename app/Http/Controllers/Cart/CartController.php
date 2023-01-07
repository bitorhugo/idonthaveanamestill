<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use App\Models\Card;
use Darryldecode\Cart\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function __construct(Request $request)
    {
        $this->middleware(['auth', 'verified']);
        
        if ($request->isMethod('post')){
            $this->middleware('EnsureStockIsValid');
        }
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cart = \Cart::session(Auth::id())->getContent();
        $subTotal = \Cart::session(Auth::id())->getSubtotal();
        return view('home.cart.index')->with(
            ['cart'     => $cart,
             'subTotal' => $subTotal,
            ]);
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
        $discount = new \Darryldecode\Cart\CartCondition(array(
            'name' => 'SALE ' . $request->discount * 100,
            'type' => 'discounts',
            'value' => '-' . ($request->discount * 100) . '%',
        ));
        
        \Cart::session(Auth::id())->add(
            $request->id,
            $request->name,
            $request->price,
            $request->quantity,
            array(),
            $discount
        )->associate('App\Models\Card');

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
     * Update cart.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id item id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //check for negative qty
        if ($request->qty < 1){
            return back()->with('error', 'Something went wrong.');
        }

        //check for available stock
        if (Card::find($id)->inventory->quantity < $request->qty){
            return back()->with('error', 'Something went wrong.');
        }

        \Cart::session(Auth::id())->update($id, [
            'quantity' => [
                'relative' => false,
                'value'    => $request->input('qty')
            ],
        ]);
        
        return redirect()->route('cart.index')
                         ->with('success', 'Item updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        \Cart::session(Auth::id())->remove($id);
        return redirect()->route('cart.index')
                         ->with('success', 'Item deleted');
    }
}
