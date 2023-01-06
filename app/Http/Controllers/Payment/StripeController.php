<?php

namespace App\Http\Controllers\Payment;

use Stripe;

use App\Http\Controllers\Controller;
use App\Mail\PaymentFulfilled;
use App\Models\Card;
use App\Services\InventoryService;
use Darryldecode\Cart\CartCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class StripeController extends Controller
{

    public function __construct()
    {
        $this->middleware(['EnsureStockIsValid']);
        $this->middleware(['verified']);            
    }
    
    public function checkout()
    {
        Stripe\Stripe::setApiKey(config('stripe.sk'));

        $cart = \Cart::session(Auth::id())->getContent();

        $line_items = array();
        foreach ($cart as $item) {
            $priceWithDiscount =
                $item->getPriceWithConditions() - ($item->getPriceWithConditions() * $item->discount_amount);
            $line_data =
                [
                    'price_data' => [
                        'currency' => 'eur',
                        'product_data' => [
                            'name' => $item->name,
                        ],
                        'unit_amount' => $priceWithDiscount * 100,
                    ],
                    'quantity'            => $item->quantity,
                    'adjustable_quantity' => [
                        'enabled' => true,
                        'minimum' => 1,
                        'maximum' => $item->model->inventory->quantity,
                    ],
                ];
            Array_push($line_items, $line_data);
        }

        $shipping_cost = 7.50;
        $session = Stripe\Checkout\Session::create([

            'shipping_address_collection' => ['allowed_countries' => ['PT', 'ES']],
            'shipping_options' => [
                [
                    'shipping_rate_data'    => [
                        'type'              => 'fixed_amount',
                        'fixed_amount'      => ['amount' => $shipping_cost * 100, 'currency' => 'eur'],
                        'display_name'      => 'Shipping Costs',
                        'delivery_estimate' => [
                            'minimum'       => ['unit' => 'business_day', 'value' => 3],
                            'maximum'       => ['unit' => 'business_day', 'value' => 5],
                        ],
                    ],
                ],
            ],
            'line_items'       => $line_items,
            'mode'             => 'payment',
            'success_url'      => route('paymentSuccess'),
            'cancel_url'       => route('paymentCanceled'),
        ]);
        return redirect()->away($session->url);
    }

    public function payNow(Request $request)
    {
        \Stripe\Stripe::setApiKey(config('stripe.sk'));
        $shipping_cost = 7.50;
                
        $session = \Stripe\Checkout\Session::create([
            'customer_email'              => $request->email,
            'shipping_address_collection' => ['allowed_countries' => ['PT', 'ES']],
            'shipping_options'            => [
                [
                    'shipping_rate_data'    => [
                        'type'              => 'fixed_amount',
                        'fixed_amount'      => ['amount' => $shipping_cost * 100, 'currency' => 'eur'],
                        'display_name'      => 'Shipping Costs',
                        'delivery_estimate' => [
                            'minimum'       => ['unit' => 'business_day', 'value' => 3],
                            'maximum'       => ['unit' => 'business_day', 'value' => 5],
                        ],
                    ],
                ],
            ],
            'line_items'  => [
                [
                    'price_data' => [
                        'currency'     => 'eur',
                        'product_data' => [
                            'name' => $request->name,
                        ],
                        'unit_amount'  => ($request->price - ($request->price * $request->discount)) * 100,
                    ],
                    'quantity'   => $request->quantity,
                ],
            ],
            'mode'        => 'payment',
            
            'success_url' => route('paymentSuccess', ['item_id' => $request->id]),
            'cancel_url'  => route('paymentCanceled', ['search' => $request->id,
                                                       'stock' => $request->quantity]),
        ]);

        return redirect()->away($session->url);
    }

    public function success(Request $request)
    {
        if ($request->has('item_id')) {
            return $this->successPayNow($request->item_id);
        }
        return $this->successCheckout();
     }

    public function canceled(Request $request)
    {
        if ($request->has('search')) {
            return redirect()->route('search.show', ['search' => $request->search])
                ->with('error', 'Payment Canceled.');
        }
        return redirect()->route('cart.index')
            ->with('error', 'Payment Canceled.');
    }


    private function successPayNow($item_id)
    {
        // update inventory by 1
        $inv = Card::find($item_id)->inventory;
        InventoryService::update($inv, $inv->quantity - 1);

        return redirect() ->route('search.show', ['search' => $item_id])
                          ->with('success', 'Payment was fullfilled.');
    }

    private function successCheckout()
    {
        // update cart inventory by qty
        \Cart::session(Auth::id())
            ->getContent()
            ->each(function ($item) {
                $inv = $item->model->inventory;
                InventoryService::update($inv, $inv->quantity - $item->quantity);
            });

        // clear the cart
        \Cart::session(Auth::id())->clear();
        
        return redirect()->route('home')->with('success', 'Payment was fullfilled.');
    }

   
    
}
