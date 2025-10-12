<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Service>
 */
class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'facility_id' => $this->faker->randomNumber(),
            'Name' => $this->faker->word(),
            'Description' => $this->faker->sentence(),
            'Category' => $this->faker->word(),
            'SkillType' => $this->faker->word(),
        ];
    }
}
