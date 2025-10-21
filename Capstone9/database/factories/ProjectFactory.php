<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph,
            'nature_of_project' => $this->faker->randomElement(['research', 'prototype', 'applied']),
            'facility_id' => \App\Models\Facility::factory(),
            'program_id' => \App\Models\Program::factory(),
            'prototype_stage' => $this->faker->randomElement(['concept', 'prototype', 'mvp', 'market_launch']),
        ];
    }
}
