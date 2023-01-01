<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Darryldecode\Cart\CartCollection;
use Illuminate\Support\Facades\Auth;

class EnsureStockIsValid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->has('id')) {
            return $request->stock > 0
                ? $next($request)
                : redirect()->route('search.show', ['search' => $request->id])
                ->with('error', 'Out of Stock.');
        }
        else {
            $cart = \Cart::session(Auth::id())->getContent();
            $cart->each(function($item) {
                if($item->model->inventory->quantity <= 0){
                    return redirect()->route('cart.index')->with('error', 'Invalid Stock');
                }
            });
            return $next($request);
        }
    }
}
