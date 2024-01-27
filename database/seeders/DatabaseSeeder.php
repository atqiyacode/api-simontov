<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Artisan::call('passport:install');

        $this->call([
            PermissionSeeder::class,
            RoleSeeder::class,
            LocationSeeder::class,
            StatusAlarmSeeder::class,
            TaxSeeder::class,
            RangeTypeSeeder::class,
            RangeCostSeeder::class,
            // FlowrateSeeder::class,
            DashboardChartSeeder::class,
            TopicSeeder::class,
            AlertNotificationTypeSeeder::class,

            UserSeeder::class,
        ]);
    }
}
