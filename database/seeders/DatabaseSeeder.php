<?php

namespace Database\Seeders;

use Database\Seeders\v1\FlowrateSeeder;
use Database\Seeders\v1\RangeCostSeeder;
use Database\Seeders\v1\RangeTypeSeeder;
use Database\Seeders\v1\StatusAlarmSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Laravolt\Indonesia\Seeds\CitiesSeeder;
use Laravolt\Indonesia\Seeds\DistrictsSeeder;
use Laravolt\Indonesia\Seeds\ProvincesSeeder;
use Laravolt\Indonesia\Seeds\VillagesSeeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Artisan::call('passport:install');

        $this->call([
            PermissionSeeder::class,
            RoleSeeder::class,
            SampleUserSeeder::class,
        ]);

        if (app()->isProduction()) {
            $this->call([
                ProvincesSeeder::class,
                CitiesSeeder::class,
                DistrictsSeeder::class,
                VillagesSeeder::class,
            ]);
        }

        $this->call([
            StatusAlarmSeeder::class,
            FlowrateSeeder::class,
            RangeTypeSeeder::class,
            RangeCostSeeder::class,
        ]);
    }
}
