<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RangeCostFactory extends Factory
{
    public function definition(): array
    {
        return [
            'range_type_id' => createOrRandomFactory(\App\Models\RangeType::class),
			'value' => $this->faker->firstName(),
        ];
    }
}
