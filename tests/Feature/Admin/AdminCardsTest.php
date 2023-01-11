<?php

namespace Tests\Feature\Admin;

use App\Models\Card;
use App\Models\Category;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AdminCardsTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_adminCards_as_admin()
    {
        $admin = User::factory()->state(
            [
                'name'     => 'foo',
                'email'    => 'email@email.com',
                'password' => 'secret',
                'isAdmin' => true,
            ]
        )->create();

        $response = $this->actingAs($admin)->get('/admin/cards');
        $response->assertStatus(200);
    
    }

    /**
     * test_adminHomePage_as_not_admin
     */
    public function test_adminCards_as_not_admin()
    {
        $basic = User::factory()->state(
            [
                'name'     => 'foo',
                'email'    => 'basic@email.com',
                'password' => 'secret',
                'isAdmin' => false,
            ]
        )->create();

        $response = $this->actingAs($basic)->get('/admin/cards');
        $response->assertRedirectContains('home');
    
    }

    public function test_search_card()
    {
        $admin = User::factory()->state(
            [
                'name'     => 'hugo',
                'email'    => 'admin@email.com',
                'password' => 'secret',
                'isAdmin' => true,
            ]
        )->create();

        $card =  Card::factory()->state(
            [
                'name'     => 'new',
                'description' => 'd',
                'price' => 100,
                'discount_amount' => 0.2,
            ]
        )->create();

        $response = $this->actingAs($admin)->call('GET', '/admin/cards', [
            'q' => $card->name
        ]);
        $response->assertViewIs('admin.cards.index');
        $response->assertStatus(200);
        
    }

    public function test_create_card()
    {
        $admin = User::factory()->state(
            [
                'name'     => 'foo',
                'email'    => 'admin@email.com',
                'password' => 'secret',
                'isAdmin' => true,
            ]
        )->create();

        $response = $this->actingAs($admin)
                         ->get('/admin/cards/create');
        $response->assertStatus(200);
    }

    public function test_store_card()
    {
        $admin = User::factory()->state(
            [
                'name'     => 'foo',
                'email'    => 'admin@email.com',
                'password' => 'secret',
                'isAdmin' => true,
            ]
        )->create();

        $card =  Card::factory()->state(
            [
                'name'     => 'new',
                'description' => 'd',
                'price' => 100,
                'discount_amount' => 0.2,
            ]
        )->make();

        $cat =  Category::factory()->state(
            [
                'name'     => 'new',
                'description' => 'd',
            ]
        )->create();

        $quantity = 10;

        Storage::fake('avatar');
        $file = UploadedFile::fake()->image('avatar.jpg');

        $response = $this->actingAs($admin)
            ->post('admin/cards', [
                'name'     => $card->name,
                'description' => $card->description,
                'price' => $card->price,
                'discount_amount' => $card->discount_amount,
                'quantity' => $quantity,
                'categories' => [$cat->id],
                'image' => [$file],
            ]);
        
        $this->assertDatabaseHas('cards', [
            'name'     => $card->name,
        ]);        
    }

    public function test_update_card()
    {
        $admin = User::factory()->state(
            [
                'name'     => 'foo',
                'email'    => 'foo@email.com',
                'password' => 'secret',
                'isAdmin'  => true,
            ]
        )->create();

        $card =  Card::factory()->state(
            [
                'id'              => 1,
                'name'            => 'new',
                'description'     => 'd',
                'price'           => 100,
                'discount_amount' => 0.2,
            ]
        )->create();

        $this->actingAs($admin)
            ->patch('/admin/cards/' . $card->id, [
                'name' => 'bar',
                'quantity' => 100,
            ]);

        $this->assertDatabaseHas('cards', [
            'id' => $card->id,
            'name' => 'bar',
        ]);

        $this->assertDatabaseMissing('cards', [
            'id' => $card->id,
            'name' => 'foo',
        ]);
    }

    public function test_delete_card()
    {
        $admin = User::factory()->state(
            [
                'name'     => 'foo',
                'email'    => 'foo@email.com',
                'password' => 'password',
                'isAdmin' => true,
            ]
        )->create();

        $card =  Card::factory()->state(
            [
                'name'            => 'foo',
                'description'     => 'bar',
                'price'           => 100,
                'discount_amount' => 0.2,
            ]
        )->create();

        $this->actingAs($admin)
            ->delete('admin/cards/' . $card->id);

        $this->assertDatabaseMissing('cards', [
            'id' => $card->id,
        ]);
    }
}
