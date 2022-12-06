<?php

namespace App\Http\Controllers\Payment;

use Stripe;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StripeController extends Controller
{

    public function checkout(Request $request)
    {
        Stripe\Stripe::setApiKey(config('stripe.sk'));

        $session = Stripe\Checkout\Session::create([
            'line_items'  => [
                [
                    'price_data' => [
                        'currency'     => 'eur',
                        'product_data' => [
                            'name' => $request->name,
                        ],
                        'unit_amount'  => $request->price * 100,
                    ],
                    'quantity'   => $request->quantity,
                ],
            ],
            'mode'        => 'payment',
            'success_url' => route('home'),
            'cancel_url'  => route('cart.index'),
        ]);

        return redirect()->away($session->url);
    }
    
    public function payNow(Request $request)
    {
        Stripe\Stripe::setApiKey(config('stripe.sk'));

        $session = Stripe\Checkout\Session::create([
            'line_items'  => [
                [
                    'price_data' => [
                        'currency'     => 'eur',
                        'product_data' => [
                            'name' => $request->name,
                        ],
                        'unit_amount'  => $request->price * 100,
                    ],
                    'quantity'   => $request->quantity,
                ],
            ],
            'mode'        => 'payment',
            'success_url' => route('home'),
            'cancel_url'  => route('search.show', ['search' => $request->id]),
        ]);

        return redirect()->away($session->url);
    }
    
}
