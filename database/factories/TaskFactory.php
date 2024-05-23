<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'task' => fake()->words(rand(4, 9), true),
            'status' => fake()->randomElement(['new', 'started', 'completed']),
            'ownerId' => User::all()->random()->id,
            'authorId' => User::all()->random()->id,
        ];
    }
}
