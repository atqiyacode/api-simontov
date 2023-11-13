<?php

namespace Database\Seeders;

use App\Models\FailedJob;
use Illuminate\Database\Seeder;

class FailedJobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        FailedJob::factory(10)->create();
    }
}
