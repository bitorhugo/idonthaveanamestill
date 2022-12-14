<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class Card_CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Card_Category::factory(1000)->create();
    }
}
