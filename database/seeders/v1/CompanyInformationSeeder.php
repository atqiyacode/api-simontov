<?php

namespace Database\Seeders\v1;

use App\Models\v1\CompanyInformation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanyInformationSeeder extends Seeder
{
    use WithoutModelEvents;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CompanyInformation::truncate();
        for ($i = 1; $i < 5; $i++) {
            CompanyInformation::updateOrCreate([
                'title' => 'Information Demo',
                'title_en' => fake('en_EN')->text(20),
                'description' => 'Information Demo Description',
                'description_en' => 'Information Demo Description',
                'status' => false,
            ]);
        }
    }
}
