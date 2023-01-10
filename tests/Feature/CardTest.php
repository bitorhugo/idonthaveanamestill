<?php

namespace Tests\Feature;

use App\Models\Card;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CardTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_create_card()
    {
        $card = Card::factory()
              ->make(
              [
                  'name' => 'c',
                  'description' => 'd',
                  'price' => 1,
                  'discount_amount' => 0.2
              ]);
        $this->assertSame('c', $card->name);
        $this->assertSame('d', $card->description);
        $this->assertSame(1, $card->price);
    }


    public function test_edit_card()
    {
        $card = Card::factory()
            ->make(
                [
                    'name' => 'c',
                    'description' => 'd',
                    'price' => 1,
                    'discount_amount' => 0.2
                ]
            );
        $card->name = 'a';
        $card->description = 'k';
        $card->price = 2;
        
        $this->assertSame('a', $card->name);
        $this->assertSame('k', $card->description);
        $this->assertSame(2, $card->price);
    }

}
