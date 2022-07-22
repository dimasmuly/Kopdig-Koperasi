<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mail>
 */
class MailFactory extends Factory
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
            'subject' => $this->faker->sentence,
            'body' => $this->faker->paragraph,
            'is_read' => $this->faker->boolean,
            'status' => $this->faker->randomElement(['unread', 'read', 'approved', 'rejected']),
        ];
    }
}
