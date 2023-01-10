<?php

namespace Tests\Feature\Admin;

use App\Models\Card;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminCards extends TestCase
{
    use RefreshDatabase;
    
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_adminCards_as_admin()
    {
        $admin = User::factory()->state(
            [
                'name'     => 'hugo',
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
                'name'     => 'hugo',
                'email'    => 'basic@email.com',
                'password' => 'secret',
                'isAdmin' => false,
            ]
        )->create();

        $response = $this->actingAs($basic)->get('/admin/cards');
        $response->assertRedirectContains('home');
    
    }

    public function test_create_card()
    {
        $admin = User::factory()->state(
            [
                'name'     => 'hugo',
                'email'    => 'admin@email.com',
                'password' => 'secret',
                'isAdmin' => true,
            ]
        )->create();

        $response = $this->actingAs($admin)
                         ->get('/admin/cards/create');
        $response->assertStatus(200);

        $new =  Card::factory()->state(
            [
                'name'     => 'new',
                'description' => 'd',
                'price' => 100,
                'discount_amount' => 0.2,
                'quantity' => 10,
            ]
        )->make();

        $Storeresponse = $this->actingAs($admin)
            ->post('admin/cards', [
                'name'     => 'new',
                'description' => 'd',
                'price' => 100,
                'discount_amount' => 0.2,
                'quantity' => 10,
                'categories[]' => ['0' => 1],
            ]);
        $Storeresponse->dump();
        // $this->assertDatabaseHas('users', [
        //     'name'     => 'new',
        //     'email'    => 'added@email.com',
        //     'password' => 'secret',
        //     'isAdmin' => false,
        // ]);
        
    }
}
