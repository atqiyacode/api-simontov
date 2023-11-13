<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $data = [
            ['code' => 1, 'name' => 'Location 1', 'lattitude' => -6.177915895055959, 'longitude' => 106.8185290963413],
            ['code' => 2, 'name' => 'Location 2', 'lattitude' => -6.108207992963954, 'longitude' => 106.74207467873244],
            ['code' => 3, 'name' => 'Location 3', 'lattitude' => -6.222922395250962, 'longitude' => 107.0014495385344],
            ['code' => 4, 'name' => 'Location 4', 'lattitude' => -6.238810559661402, 'longitude' => 106.62829264026414],
            ['code' => 5, 'name' => 'Location 5', 'lattitude' => -6.363196561684572, 'longitude' => 107.1800666894639],
            ['code' => 6, 'name' => 'Location 6', 'lattitude' => -6.012011665026983, 'longitude' => 106.06053287198343]
        ];
        Location::insert($data);
    }
}
