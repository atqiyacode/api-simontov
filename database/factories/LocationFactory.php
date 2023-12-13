<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class LocationFactory extends Factory
{
    public function definition(): array
    {
        return [
            'code' => $this->faker->firstName(),
            'name' => $this->faker->firstName(),
            'longitude' => $this->faker->firstName(),
            'lat' => $this->faker->firstName(),
            'description' => $this->faker->text(),
        ];
    }
}
