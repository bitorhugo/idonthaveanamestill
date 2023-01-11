<?php

namespace Tests\Feature\Search;

use App\Models\Card;
use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SearchTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_empty_search_card()
    {
        Card::factory(10)->create();
        $category = 'none';
        $sort = 'none';
        $response = $this->call('GET', '/search', [
            'category' => $category, 'sort' => $sort
        ]);
        $response->assertStatus(200);
    }

    public function test_search_card_name()
    {
        Card::factory()->state(
            [
                'name' => 'foo'
            ]
        )->create();

        $category = 'none';
        $sort = 'none';
        $response = $this->call('GET', '/search', [
            'q'        => 'foo',
            'category' => $category,
            'sort'     => $sort
        ]);
        $response->assertStatus(200);
    }

    public function test_search_category()
    {
        Category::factory()->state(
            [
                'id' => 1,
                'name' => 'foo'
            ]
        )->create();
        
        $sort = 'none';
        $response = $this->call('GET', '/search', [
            'category' => 1,
            'sort'     => $sort
        ]);
        $response->assertStatus(200);
    }

    public function test_search_card_category()
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
        $sort = 'none';

        $card->categories()->attach($cat->id);
        
        $response = $this->call('GET', '/search', [
            'q' => $card->name,
            'category' => $cat->id,
            'sort'     => $sort
        ]);
        $response->assertStatus(200);
    }

    public function test_search_card_sorted()
    {
        Card::factory(10)->create();
        $category = 'none';

        $sort = collect([
            'age-asc',
            'age-desc',
            'price-asc',
            'price-desc',
            'discount-asc',
            'discount-desc'
        ]);

        $sort->each(function ($s) use ($category) {
            $response = $this->call('GET', '/search', [
                'category' => $category,
                'sort' => $s
            ]);
            $response->assertStatus(200);
        });
        
    }

    public function test_search_card_category_sorted()
    {

        Card::factory(10)->create();
        Category::factory()->state(
            [
                'id' => 1,
                'name' => 'foo'
            ]
        )->create();

        $category = Category::find(1);

        $sort = collect([
            'age-asc',
            'age-desc',
            'price-asc',
            'price-desc',
            'discount-asc',
            'discount-desc'
        ]);

        $sort->each(function ($s) use ($category) {
            $response = $this->call('GET', '/search', [
                'category' => $category->id,
                'sort' => $s
            ]);
            $response->assertStatus(200);
        });
    }
    
}
