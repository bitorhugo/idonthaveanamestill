<?php

namespace Tests\Feature\Admin;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminCategories extends TestCase
{
    use RefreshDatabase, WithFaker;
    
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

    public function test_show_category()
    {
        $admin = User::factory()->state(
            [
                'name'     => 'hugo',
                'email'    => 'admin@email.com',
                'password' => 'secret',
                'isAdmin' => true,
            ]
        )->create();

        $cat =  Category::factory()->state(
            [
                'name'     => 'new',
                'description' => 'd',
            ]
        )->create();

        $response = $this->actingAs($admin)
             ->get('admin/categories/' . $cat->id);
        
        $response->assertStatus(500);
    }

    public function test_create_category()
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
        $response->assertSee('ADD CARD');
        $response->assertStatus(200);
        
    }

    public function test_store_category()
    {
        $admin = User::factory()->state(
            [
                'name'     => 'hugo',
                'email'    => 'admin@email.com',
                'password' => 'secret',
                'isAdmin' => true,
            ]
        )->create();

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

    public function test_edit_category()
    {
        $admin = User::factory()->state(
            [
                'name'     => 'hugo',
                'email'    => 'admin@email.com',
                'password' => 'secret',
                'isAdmin' => true,
            ]
        )->create();

        $cat =  Category::factory()->state(
            [
                'name'     => 'new',
                'description' => 'd',
            ]
        )->create();        
        
        $response = $this->actingAs($admin)
                         ->get('/admin/categories/' . $cat->id . '/edit');
        
        $response->assertStatus(200);
    }

    public function test_update_user()
    {
        $admin = User::factory()->state(
           [
                'name'     => 'foo',
                'email'    => 'foo@email.com',
                'password' => 'password',
                'isAdmin' => true,
            ]
        )->create();

        $cat = Category::factory()->state(
            [
                'name'     => 'foo',
                'description' => 'd',
            ]
        )->create();        

        $name = 'bar';

        $this->actingAs($admin)
            ->patch('admin/categories/' . $cat->id,  [
                'name' =>  $name,
            ]);

        $this->assertDatabaseHas('categories', [
            'name' => 'bar',
        ]);

        $this->assertDatabaseMissing('categories', [
            'name' => 'foo',
        ]);
    }

    public function test_delete_user()
    {
        $admin = User::factory()->state(
            [
                'name'     => 'hugo',
                'email'    => 'admin@email.com',
                'password' => 'secret',
                'isAdmin' => true,
            ]
        )->create();

        $cat = Category::factory()->state(
            [
                'name'     => 'foo',
                'description' => 'd',
            ]
        )->create();        

        $response = $this->actingAs($admin)
            ->delete('admin/categories/' . $cat->id);

        $this->assertDatabaseMissing('categories', [
            'name'     => 'foo',
        ]);

        $response->assertRedirect('admin/categories');
    }    

}
