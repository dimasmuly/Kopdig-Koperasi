<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Stash>
 */
class StashFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 40),
            'beginning_balance' => $this->faker->numberBetween(900000, 60000000),
            'ending_balance' => $this->faker->numberBetween(900000, 60000000),
            'stash_date' => $this->faker->dateTimeBetween('-1 years', 'now'),
            'stash_amount' => $this->faker->numberBetween(100000, 200000)
        ];
    }
}
