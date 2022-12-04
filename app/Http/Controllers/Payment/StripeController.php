<?php

namespace App\Http\Controllers\Payment;

use Stripe;
use Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StripeController extends Controller
{
    
    public function session()
    {
        Stripe\Stripe::setApiKey(config('stripe.sk'));

        $session = Stripe\Checkout\Session::create([
            'line_items'  => [
                [
                    'price_data' => [
                        'currency'     => 'eur',
                        'product_data' => [
                            'name' => 'gimme money!!!!',
                        ],
                        'unit_amount'  => 500,
                    ],
                    'quantity'   => 1,
                ],
            ],
            'mode'        => 'payment',
            'success_url' => route('home'),
            'cancel_url'  => route('home'),
        ]);

        return redirect()->away($session->url);
    }
    
}
