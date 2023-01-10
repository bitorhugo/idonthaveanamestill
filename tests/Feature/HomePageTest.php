<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HomePageTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    function test_index()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    function test_home()
    {
        $response = $this->get('/home');
        $response->assertStatus(200);
    }
    
}
