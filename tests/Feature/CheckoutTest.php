<?php

namespace Tests\Feature;

use App\Models\Card;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

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


}
