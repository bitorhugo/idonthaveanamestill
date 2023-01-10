<?php

namespace Tests\Feature\Admin;

use App\Http\Controllers\Admin\AdminCategoryController;
use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminCategories extends TestCase
{
    use RefreshDatabase;
    
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_adminCategories_as_admin()
    {
        $admin = User::factory()->state(
            [
                'name'     => 'hugo',
                'email'    => 'email@email.com',
                'password' => 'secret',
                'isAdmin' => true,
            ]
        )->create();

        $response = $this->actingAs($admin)->get('/admin/categories');
        $response->assertStatus(200);
    
    }

    /**
     * test_adminHomePage_as_not_admin
     */
    public function test_adminCategories_as_not_admin()
    {
        $basic = User::factory()->state(
            [
                'name'     => 'hugo',
                'email'    => 'basic@email.com',
                'password' => 'secret',
                'isAdmin' => false,
            ]
        )->create();

        $response = $this->actingAs($basic)->get('/admin/categories');
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

        $new =  Category::factory()->state(
            [
                'name'     => 'new',
                'description' => 'd',
            ]
        )->make();

        $response = $this->actingAs($admin)
            ->post('admin/categories', [
                'name'     => $new->name,
                'description' => $new->description
            ]);

        $response->assertRedirect();

        $this->assertDatabaseHas('categories', [
            'name'     => $new->name,
            'description' => $new->description
        ]);
        
    }

}
