<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testClassConstructor()
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
}
