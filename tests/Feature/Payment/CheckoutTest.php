<?php

namespace Tests\Feature\Payment;

use App\Models\Card;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use function PHPUnit\Framework\assertFalse;
use function PHPUnit\Framework\assertTrue;

class CheckoutTest extends TestCase
{

    /**
     * test_checkout
     */
    public function test_checkout()
    {
        $user = User::factory()->create();
        $card = Card::factory()->create();
        $cart = \Cart::session($user->id)
              ->add(
                  array(
                      'id'              => $card->id,
                      'name'            => $card->name,
                      'price'           => $card->price,
                      'quantity'        => 4,
                      'attributes'      => array(),
                      'associatedModel' => $card
                  )
              );
        $response = $this->actingAs($user)->post('/checkout');
        $response->assertRedirectContains('stripe');
    }

    public function test_checkout_payment_sucess()
    {
        $user = User::factory()->create();
        $card = Card::factory()->create();
        $cart = \Cart::session($user->id)
            ->add(
                array(
                    'id'              => $card->id,
                    'name'            => $card->name,
                    'price'           => $card->price,
                    'quantity'        => 4,
                    'attributes'      => array(),
                    'associatedModel' => $card
                )
            );
        
        assertFalse(\Cart::session($user->id)->isEmpty());
        
        $response = $this->actingAs($user)->post('/checkout');
        $response->assertRedirectContains('stripe');

        $responsePayment = $this->actingAs($user)->get('/paymentSuccess');
        assertTrue(\Cart::session($user->id)->isEmpty());
        $responsePayment->assertRedirectContains('home');
    }

    public function test_payNow_payment_canceled()
    {
        $user = User::factory()->create();
        $card = Card::factory()->create();
        
        $response = $this->actingAs($user)
                         ->post('/payNow', ['quantity' => 1]);
        $response->assertRedirectContains('stripe');

        $responsePayment = $this->get('paymentCanceled');
                         
        $responsePayment->assertRedirectContains('cart');
    }


}
