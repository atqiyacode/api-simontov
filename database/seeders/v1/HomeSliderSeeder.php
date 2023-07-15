<?php

namespace Database\Seeders\v1;

use App\Models\v1\HomeSlider;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HomeSliderSeeder extends Seeder
{
    use WithoutModelEvents;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        HomeSlider::truncate();
        for ($i = 1; $i < 5; $i++) {
            HomeSlider::updateOrCreate([
                'title' => fake('id_ID')->text(20),
                'title_en' => fake('en_EN')->text(20),
                'description' => fake('id_ID')->realText(),
                'description_en' => fake('en_EN')->realText(),
                'cover' => config('app.url') . '/images/home-slider-01.png',
                'url' => fake('id_ID')->url(),
                'status' => false,
            ]);
        }
    }
}
