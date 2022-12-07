<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CardFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->numerify('card-###'),
            'description' => $this->faker->text(),
            'price' => $this->faker->numberBetween(10, 100),
            'discount_amount' => $this->faker->randomFloat(2, 0.05, 0.75),
        ];
    }
}
