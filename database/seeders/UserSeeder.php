<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // seed one admin user
        \App\Models\User::factory()->state(['name' => 'admin', 'password' => Hash::make('adminadmin'), 'email' => 'admin@email.com', 'isAdmin' => true])->create();
        \App\Models\User::factory(1000)->create();
    }
}
