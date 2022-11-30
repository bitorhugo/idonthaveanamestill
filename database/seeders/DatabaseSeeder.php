<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory()->state(['name' => 'admin', 'password' => Hash::make('adminadmin'), 'email' => 'admin@email.com', 'isAdmin' => true])->create();
        \App\Models\User::factory(10)->create();
        \App\Models\Card::factory(10)->create();
    }
}
