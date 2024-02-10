<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class InvoiceTemplateFactory extends Factory
{
    public function definition(): array
    {
        return [
            'company_name' => $this->faker->firstName(),
			'company_address' => $this->faker->text(),
			'phone' => $this->faker->firstName(),
			'fax' => $this->faker->firstName(),
			'npwp' => $this->faker->firstName(),
			'additional_section' => $this->faker->text(),
			'manager_name' => $this->faker->firstName(),
			'note' => $this->faker->text(),
        ];
    }
}
