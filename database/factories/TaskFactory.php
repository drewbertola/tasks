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
            'priority' => fake()->randomElement([1, 2, 3, 4]),
            'status' => fake()->randomElement([1, 2, 3]),
            'ownerId' => User::all()->random()->id,
            'authorId' => User::all()->random()->id,
        ];
    }
}
