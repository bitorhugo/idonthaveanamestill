<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AdminUsersTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_adminUsers_as_admin()
    {
        $admin = User::factory()->state(
            [
                'name'     => 'hugo',
                'email'    => 'email@email.com',
                'password' => 'secret',
                'isAdmin' => true,
            ]
        )->create();

        $response = $this->actingAs($admin)->get('/admin/users');
        $response->assertViewIs('admin.users.index');
        $response->assertStatus(200);
    
    }

    /**
     * test_adminHomePage_as_not_admin
     */
    public function test_adminUsers_as_not_admin()
    {
        $basic = User::factory()->state(
            [
                'name'     => 'hugo',
                'email'    => 'basic@email.com',
                'password' => 'secret',
                'isAdmin' => false,
            ]
        )->create();

        $response = $this->actingAs($basic)->get('/admin/users');
        $response->assertRedirectContains('home');
    
    }

    public function test_search_user()
    {
        $admin = User::factory()->state(
            [
                'name'     => 'hugo',
                'email'    => 'admin@email.com',
                'password' => 'secret',
                'isAdmin' => true,
            ]
        )->create();

        $response = $this->actingAs($admin)->call('GET', '/admin/users', [
            'q' => $admin->name
        ]);
        $response->assertStatus(200);
    }

    public function test_show_user()
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
             ->get('admin/users/' . $admin->id);
        
        $response->assertStatus(200);
        $response->assertSee($admin->id);
    }

    public function test_create_user()
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
                         ->get('/admin/users/create');
        $response->assertStatus(200);
    }

    public function test_store_user()
    {
        $admin = User::factory()->state(
            [
                'name'     => 'hugo',
                'email'    => 'admin@email.com',
                'password' => 'secret',
                'isAdmin' => true,
            ]
        )->create();

        Storage::fake('avatar');
        $file = UploadedFile::fake()->image('avatar.jpg')->size(100);

        $new =  User::factory()->state(
            [
                'name'     => 'new',
                'email'    => 'added@email.com',
                'password' => 'password',
                'isAdmin' => false,
            ]
        )->make();

        $response = $this->actingAs($admin)
            ->post('admin/users', [
                'name'     => $new->name,
                'email'    => $new->email,
                'password' => $new->password,
                'password_confirmation' => 'password',
                'isAdmin' => $new->isAdmin,
                'image' => $file
            ]);
        
        $response->assertRedirectContains('/admin/users');

        $this->assertDatabaseHas('users', [
            'name'     => 'new',
            'email'    => 'added@email.com',
            'isAdmin' => false,
        ]);        
    }

    public function test_edit_user()
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
                         ->get('/admin/users/' . $admin->id . '/edit');
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

        $name = 'bar';

        $this->actingAs($admin)
            ->patch('admin/users/' . $admin->id,  [
                'name' =>  $name,
            ]);

        $this->assertDatabaseHas('users', [
            'id' => $admin->id,
            'name' => 'bar',
            'email' => 'foo@email.com'
        ]);

        $this->assertDatabaseMissing('users', [
            'name' => 'foo',
            'email' => 'foo@email.com'
        ]);
    }

    public function test_delete_user()
    {
        $admin = User::factory()->state(
            [
                'name'     => 'foo',
                'email'    => 'foo@email.com',
                'password' => Hash::make('password'),
                'isAdmin' => true,
            ]
        )->create();

        $response = $this->actingAs($admin)
                         ->delete('admin/users/' . $admin->id);

        $this->assertDatabaseMissing('users', [
            'name'     => 'foo',
            'email'    => 'foo@email.com',
            'password' => Hash::make('password'),
            'isAdmin' => true, 
        ]);
        
        $response->assertRedirect('admin/users');
    }    



}
