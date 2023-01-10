<?php

namespace Tests\Feature\Payment;

use App\Models\Card;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PayNowTest extends TestCase
{
    
    /**
     * test_payNow
     */
    public function test_payNow()
    {
        $user = User::factory()->create();
        $card = Card::factory()->create();
        $response = $this->actingAs($user)
                         ->post('/payNow', ['quantity' => 1]);
        $response->assertRedirectContains('stripe');
    }

    public function test_payNow_payment_success()
    {
        $user = User::factory()->create();
        $card = Card::factory()->create();
        
        $response = $this->actingAs($user)
                         ->post('/payNow', ['quantity' => 1]);
        $response->assertRedirectContains('stripe');

        $responsePayment = $this->call('GET', '/paymentSuccess', ["item_id" => $card->id]);
                         
        $responsePayment->assertRedirectContains('search/');
    }

    public function test_payNow_payment_canceled()
    {
        $user = User::factory()->create();
        $card = Card::factory()->create();
        
        $response = $this->actingAs($user)
                         ->post('/payNow', ['quantity' => 1]);
        $response->assertRedirectContains('stripe');

        $responsePayment = $this->call('GET', '/paymentCanceled', ["search" => $card->id]);
                         
        $responsePayment->assertRedirectContains('search');
    }

}
