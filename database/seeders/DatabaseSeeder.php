<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        //disable foreign key check for this connection before running seeders
        // DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Artisan::call('passport:install');

        $this->call([
            PermissionSeeder::class,
            RoleSeeder::class,
            DeveloperSeeder::class,
        ]);
    }
}
