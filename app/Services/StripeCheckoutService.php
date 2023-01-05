<?php

namespace App\Services;

use App\Mail\PaymentFulfilled;
use App\Models\Card;
use Illuminate\Support\Facades\Mail;
use Stripe\Stripe;

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

            // $line_items = $session->line_items;
            
            // Send email to buyer
            $this->sendEmail($session->customer_email);
        }
        error_log("Passed signature verification!");
        http_response_code(200);
        error_log($payload);
    }
    
    public function sendEmail($email)
    {
        Mail::to($email)->send(new PaymentFulfilled());
    }
    
}



