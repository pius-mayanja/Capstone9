<?php

namespace Database\Factories;

use App\Models\Facility;
use Illuminate\Database\Eloquent\Factories\Factory;

class FacilityFactory extends Factory
{
    protected $model = Facility::class;

    public function definition(): array
    {
        return [
            'FacilityType' => $this->faker->randomElement(['Lab', 'Clinic', 'Office', 'Center']),
            'Name' => $this->faker->company . ' Facility',
            'Location' => $this->faker->city,
            'Description' => $this->faker->paragraph,
            'PartnerOrganization' => $this->faker->company,
            'Capabilities' => $this->faker->words(3, true),
        ];
    }
}
