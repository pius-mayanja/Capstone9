<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Program>
 */
class ProgramFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'Name' => $this->faker->words(3, true),
            'Description' => $this->faker->paragraph,
            'NationalAlignment' => $this->faker->sentence(4),
            'FocusAreas' => [$this->faker->word, $this->faker->word],
            'Phases' => [$this->faker->word, $this->faker->word],
        ];
    }
}
