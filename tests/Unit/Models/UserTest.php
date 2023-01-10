<?php

namespace Tests\Unit\Models;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_create_user()
    {
        $user = User::factory()->make(
            [
                'name'     => 'hugo',
                'email'    => 'email@email.com',
                'password' => 'secret',
            ]
        );
        
        $this->assertSame('hugo', $user->name);
        $this->assertSame('email@email.com', $user->email);
        $this->assertSame('secret', $user->password);
    }

    public function test_edit_user()
    {
        $user = User::factory()->make(
            [
                'name'     => 'hugo',
                'email'    => 'email@email.com',
                'password' => 'secret',
            ]
        );

        $user->name = 'h';
        $user->email = 'e';
        $user->password = 'p';
        
        $this->assertSame('h', $user->name);
        $this->assertSame('e', $user->email);
        $this->assertSame('p', $user->password);
    }

}
