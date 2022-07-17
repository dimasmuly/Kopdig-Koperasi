<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Loan>
 */
class LoanFactory extends Factory
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
            'loan_date' => $this->faker->dateTimeBetween('-1 month', 'now'),
            'amount' => $this->faker->randomFloat(400000, 5000000),
            'installment_principal' => $this->faker->numberBetween(400000, 2000000),
            'installment_interest' => $this->faker->numberBetween(400000, 2000000),
            'total_installment' => $this->faker->numberBetween(400000, 2000000),
            'installment_remaining' => $this->faker->numberBetween(1, 10),
            'loan_type_id' => $this->faker->numberBetween(1, 3),
            'installment_period' => $this->faker->randomElement([30, 60]),
        ];
    }
}
