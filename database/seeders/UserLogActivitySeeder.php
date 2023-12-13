<?php

namespace Database\Seeders;

use App\Models\UserLogActivity;
use Illuminate\Database\Seeder;

class UserLogActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        UserLogActivity::factory(10)->create();
    }
}
