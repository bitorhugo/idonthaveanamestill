<?php

namespace App\Http\Controllers\Payment;

use Stripe;

use App\Http\Controllers\Controller;
use Darryldecode\Cart\CartCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StripeController extends Controller
{

    public function checkout()
    {
        Stripe\Stripe::setApiKey(config('stripe.sk'));
        
        $cart = \Cart::session(Auth::id())->getContent();

        $line_items = array();
        foreach ($cart as $item) {
            $line_data =
                [
                    'price_data' => [
                        'currency' => 'eur',
                        'product_data' => [
                            'name' => $item->name,
                        ],
                        'unit_amount' => $item->price * 100,
                    ],
                    'quantity' => $item->quantity,
                ];
            array_push($line_items, $line_data);
        }
        
        $session = Stripe\Checkout\Session::create([
            'line_items'  => $line_items,
            'mode'        => 'payment',
            'success_url' => route('paymentSuccess'),
            'cancel_url'  => route('paymentCanceled'),
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
            'success_url' => route('paymentSuccess'),
            'cancel_url'  => route('paymentCanceled', ['search' => $request->id]),
        ]);

        return redirect()->away($session->url);
    }

    public function success()
    {
        return redirect()->route('home')->with('success', 'Payment was fullfilled.');
    }

    public function canceled(Request $request)
    {
        if($request->has('search')) {
            return redirect()->route('search.show', ['search' => $request->search])
                             ->with('error', 'Payment Canceled.');
        }
        return redirect()->route('cart.index')
                         ->with('error', 'Payment Canceled.');
    }

    private function isCartCheckout()
    {
        $cart = \Cart::session(Auth::id())->getContents();
        $line_items = array();
        foreach($cart as $item) {
            $line_items = array_push(
                ['price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                       'name' => $item->name,
                    ],
                    'unit_amount' => $item->price * 100,
                ],
                 'quantity' => $item->quantity,
                ]
            );
        }

        $session = Stripe\Checkout\Session::create([
            'line_items'  => $line_items,
            'mode'        => 'payment',
            'success_url' => route('paymentSuccess'),
            'cancel_url'  => route('paymentCanceled'),
        ]);

        return $session;
    }

    private function isBuyNowCheckout($request)
    {
        
    }
}
