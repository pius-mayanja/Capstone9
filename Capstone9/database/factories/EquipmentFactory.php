<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Equipment>
 */
class EquipmentFactory extends Factory
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
            'Type' => $this->faker->randomElement(['Tool', 'Machine', 'Device']),
            'Capability' => $this->faker->word(),
            'Domain' => $this->faker->optional()->word(),
            'Description' => $this->faker->optional()->sentence(),
        ];
    }
}