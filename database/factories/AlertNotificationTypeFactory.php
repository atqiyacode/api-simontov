<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AlertNotificationTypeFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->firstName(),
            'job_event' => $this->faker->firstName(),
            'description' => $this->faker->text(),
        ];
    }
}
