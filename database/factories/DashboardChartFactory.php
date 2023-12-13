<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DashboardChartFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->firstName(),
            'status' => $this->faker->boolean(),
        ];
    }
}
