<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RangeTypeFactory extends Factory
{
    public function definition(): array
    {
        return [
            'slug' => $this->faker->firstName(),
			'label' => $this->faker->firstName(),
			'lower_limit' => $this->faker->firstName(),
			'upper_limit' => $this->faker->firstName(),
			'description' => $this->faker->text(),
        ];
    }
}
