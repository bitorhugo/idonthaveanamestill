<?php

namespace App\Services;

use App\Mail\PaymentFulfilled;
use App\Models\Card;
use Illuminate\Support\Facades\Mail;
use Stripe\Stripe;
use Illuminate\Support\Str;

class StripeCheckoutService
{

    public function handleCheckoutSessionCompleted()
    {
        Stripe::setApiKey(config('stripe.sk'));
        $payload = @file_get_contents('php://input');
        $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
        $endpoint_secret = env('SEPS');
        $event = null;

        try {
            $event = \Stripe\Webhook::constructEvent(
                $payload,
                $sig_header,
                $endpoint_secret
            );
        } catch (\UnexpectedValueException $e) {
            // Invalid payload
            http_response_code(400);
            exit();
        } catch (\Stripe\Exception\SignatureVerificationException $e) {
            // Invalid signature
            http_response_code(400);
            exit();
        }

        // Handle the checkout.session.completed event
        if ($event->type == 'checkout.session.completed') {
            // Retrieve the session. If you require line items in the response, you may include them by expanding line_items.
            $session = \Stripe\Checkout\Session::retrieve([
                'id' => $event->data->object->id,
                'expand' => ['line_items'],
            ]);

            // Update Inventory
            $line_items = $session->line_items;
            $this->updateInv($line_items);

            // Send email to buyer
            $email = $session->customer_email;
            $this->sendEmail($email);
        }
        
        http_response_code(200);
    }
    
    private function sendEmail($email)
    {
        Mail::to($email)->send(new PaymentFulfilled());
    }

    private function updateInv($line_items)
    {
        $items = collect($line_items->data);
        $items->each(function($item){
            $id = Str::between($item->description, 'id=', ')');
            $inv = Card::find($id)->inventory;
            InventoryService::update($inv, $inv->quantity - $item->quantity);
        });
    }

}



