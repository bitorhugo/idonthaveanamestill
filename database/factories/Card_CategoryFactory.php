<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class Card_CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'category_id' => $this->faker->numberBetween(1, 10),
            'card_id' => $this->faker->unique()->numberBetween(1, 1000),
        ];
    }
}
