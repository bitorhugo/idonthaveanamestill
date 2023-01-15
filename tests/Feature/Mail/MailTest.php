<?php

namespace Tests\Feature\Mail;

use App\Mail\PaymentFulfilled;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class MailTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_payment_mail()
    {
        Mail::fake();
        Mail::assertNotSent(PaymentFulfilled::class);
    }
}
