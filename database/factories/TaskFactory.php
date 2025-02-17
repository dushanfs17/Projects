<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    public function definition(): array
    {
        return [
            'project_id' => \App\Models\Project::factory(),
            'category_id' => \App\Models\Category::factory(),
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'status' => $this->faker->randomElement(['pending', 'completed']),
            'due_date' => $this->faker->dateTimeBetween('now', '+1 year')->format('Y-m-d'),
        ];
    }
}
