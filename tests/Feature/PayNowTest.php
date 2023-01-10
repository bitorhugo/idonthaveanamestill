<?php

namespace Tests\Feature;

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
}
