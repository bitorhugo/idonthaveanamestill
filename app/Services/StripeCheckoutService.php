<?php

namespace App\Services;

use App\Mail\PaymentFulfilled;
use Illuminate\Support\Facades\Auth;
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
            // $this->updateInv($line_items);

            // Send email to buyer
            $email = $session->customer_email;
        }
        
        http_response_code(200);
    }
    
    private function sendEmail($email)
    {
        Mail::to($email)->send(new PaymentFulfilled());
    }

    private function updateInv($items)
    {
        
    }

}



