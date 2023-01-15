<?php

namespace Tests\Feature\Cart;

use App\Models\Card;
use App\Models\Inventory;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CartTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_cart_index()
    {
        $user = User::factory()->state(
            [
                'name'     => 'foo',
                'email'    => 'email@email.com',
                'password' => 'secret',
                'isAdmin' => false,
            ]
        )->create();
        
        $response = $this->actingAs($user)->get('/cart');
        $response->assertStatus(200);
    }

    public function test_cart_post()
    {
        $user = User::factory()->state(
            [
                'name'     => 'foo',
                'email'    => 'email@email.com',
                'password' => 'secret',
                'isAdmin' => false,
            ]
        )->create();

        $card =  Card::factory()->state(
            [
                'id' => 1,
                'name'     => 'new',
                'description' => 'd',
                'price' => 100,
                'discount_amount' => 0,
            ]
        )->create();

        $inv = Inventory::factory()->state(
            [
                'id' => 1,
                'card_id' => 1,
                'quantity' => 10,
            ]
        )->create();

        $response = $this->actingAs($user)->post('/cart', [
            'id' => $card->id,
            'name' => $card->name,
            'price' => $card->price,
            'stock' => $inv->quantity,
            'discount' => $card->discount_amount,
            'quantity' => 1
        ]);

        $response->assertRedirect();
        $this->assertFalse(\Cart::session($user->id)->isEmpty());
    }

    public function test_cart_update()
    {
        $user = User::factory()->state(
            [
                'name'     => 'foo',
                'email'    => 'email@email.com',
                'password' => 'secret',
                'isAdmin' => false,
            ]
        )->create();

        $card =  Card::factory()->state(
            [
                'id' => 1,
                'name'     => 'new',
                'description' => 'd',
                'price' => 100,
                'discount_amount' => 0,
            ]
        )->create();

        $inv = Inventory::factory()->state(
            [
                'id' => 1,
                'card_id' => 1,
                'quantity' => 10,
            ]
        )->create();
        $cart = \Cart::session($user->id)
              ->add(
                  array(
                      'id'              => $card->id,
                      'name'            => $card->name,
                      'price'           => $card->price,
                      'quantity'        => 1,
                      'attributes'      => array(),
                      'associatedModel' => $card
                  )
              );
        
        $response = $this->actingAs($user)->patch('/cart/' . $card->id, [
            'cart' => $card->id,
            'qty' => 5
        ]);

        $collection = $cart->getContent();
        $itemCount = $collection->first()->quantity;
        $this->assertTrue($itemCount == 5);
        $response->assertRedirectContains('cart');
    }

    public function test_cart_delete()
    {
        $user = User::factory()->state(
            [
                'name'     => 'foo',
                'email'    => 'email@email.com',
                'password' => 'secret',
                'isAdmin' => false,
            ]
        )->create();

        $card =  Card::factory()->state(
            [
                'id' => 1,
                'name'     => 'new',
                'description' => 'd',
                'price' => 100,
                'discount_amount' => 0,
            ]
        )->create();

        Inventory::factory()->state(
            [
                'id' => 1,
                'card_id' => 1,
                'quantity' => 10,
            ]
        )->create();
        
        $cart = \Cart::session($user->id)
              ->add(
                  array(
                      'id'              => $card->id,
                      'name'            => $card->name,
                      'price'           => $card->price,
                      'quantity'        => 1,
                      'attributes'      => array(),
                      'associatedModel' => $card
                  )
              );
        
        $response = $this->actingAs($user)->delete('/cart/' . $card->id, [
            'cart' => $card->id,
        ]);

        $this->assertTrue($cart->isEmpty());
        $response->assertRedirectContains('cart');
    }

}
