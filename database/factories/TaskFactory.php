<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Task;
use App\Models\User;
use App\Enums\Priority;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
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
            'title' => fake()->word(),
            'description' =>  fake()->text(),
            'completed' => fake()->randomElement([0, 1]),
            'order' => 0,
            'priority' => fake()->randomElement(Priority::cases()),
            'due_date' =>  fake()->dateTimeBetween('+1 month', '+5 months'),
        ];
    }
}
