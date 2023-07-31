<?php

namespace Database\Seeders\v1;

use App\Models\v1\StatusAlarm;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class StatusAlarmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        StatusAlarm::insert([
            ['name' => 'Insulation Fault', 'slug' => Str::slug('Insulation Fault')],
            ['name' => 'Coil Current Fault', 'slug' => Str::slug('Coil Current Fault')],
            ['name' => 'Amplifier Overload', 'slug' => Str::slug('Amplifier Overload')],
            ['name' => 'Data Checksum Fault', 'slug' => Str::slug('Data Checksum Fault')],
            ['name' => 'Low Power', 'slug' => Str::slug('Low Power')],
            ['name' => 'Flow Overload', 'slug' => Str::slug('Flow Overload')],
            ['name' => 'Pulse A Overload', 'slug' => Str::slug('Pulse A Overload')],
            ['name' => 'Pulse B Overload', 'slug' => Str::slug('Pulse B Overload')],
            ['name' => 'Consumption Interval Over Limit', 'slug' => Str::slug('Consumption Interval Over Limit')],
            ['name' => 'Leakage', 'slug' => Str::slug('Leakage')],
            ['name' => 'Empty Pipe', 'slug' => Str::slug('Empty Pipe')],
            ['name' => 'Low Impedance', 'slug' => Str::slug('Low Impedance')],
            ['name' => 'Flow Over Limit', 'slug' => Str::slug('Flow Over Limit')],
        ]);
    }
}
