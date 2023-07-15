<?php

namespace Database\Seeders\v1;

use App\Models\v1\MobileAppServerStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MobileAppServerStatusSeeder extends Seeder
{
    // use WithoutModelEvents;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MobileAppServerStatus::updateOrCreate([
            'status' => 'online',
        ]);
    }
}
