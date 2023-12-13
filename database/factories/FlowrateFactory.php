<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class FlowrateFactory extends Factory
{
    public function definition(): array
    {
        return [
            'location_id' => createOrRandomFactory(\App\Models\Location::class),
			'flowrate' => $this->faker->firstName(),
        ];
    }
}
