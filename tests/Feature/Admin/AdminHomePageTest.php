<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminHomePageTest extends TestCase
{
    use RefreshDatabase;
    
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_adminHomePage_as_admin()
    {
        $admin = User::factory()->state(
            [
                'name'     => 'hugo',
                'email'    => 'email@email.com',
                'password' => 'secret',
                'isAdmin' => true,
            ]
        )->create();

        $response = $this->actingAs($admin)->get('/admin');
        $response->assertStatus(200);
    
    }

    /**
     * test_adminHomePage_as_not_admin
     */
    public function test_adminHomePage_as_not_admin()
    {
        $basic = User::factory()->state(
            [
                'name'     => 'hugo',
                'email'    => 'basic@email.com',
                'password' => 'secret',
                'isAdmin' => false,
            ]
        )->create();

        $response = $this->actingAs($basic)->get('/admin');
        $response->assertRedirectContains('home');
    
    }
}
