<?php

namespace Tests\Feature\Search;

use App\Models\Card;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ShowTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        Category::factory()->state([
            'id' => 1,
            'name' => 'foo'
        ])->create();

        Card::factory()->state([
            'id' => 1,
            'name' => 'bar'
        ])->create();

        $card = Card::find(1);
        $cat = Category::find(1);
        $card->categories()->attach($cat->id);

        $response = $this->call('GET', '/search/' . $card->id, [
            'search'     => $card->id
        ]);
        $response->assertStatus(200);

    }
}
