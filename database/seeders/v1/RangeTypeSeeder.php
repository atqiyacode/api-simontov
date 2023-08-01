<?php

namespace Database\Seeders\v1;

use App\Models\v1\RangeType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RangeTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 10; $i++) {
            $sample = fake()->userName();
            RangeType::create([
                'slug' => Str::slug($sample),
                'name' => $sample,
            ]);
        }
    }
}
