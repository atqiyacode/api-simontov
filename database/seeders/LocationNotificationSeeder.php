<?php

namespace Database\Seeders;

use App\Models\LocationNotification;
use Illuminate\Database\Seeder;

class LocationNotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        LocationNotification::factory(10)->create();
    }
}
