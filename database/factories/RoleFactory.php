<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RoleFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->firstName(),
			'guard_name' => $this->faker->firstName(),
        ];
    }
}
