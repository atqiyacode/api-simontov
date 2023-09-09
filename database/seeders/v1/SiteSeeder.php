<?php

namespace Database\Seeders\v1;

use App\Models\v1\Site;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['code' => 1, 'name' => 'Location 1', 'lat' => -6.177915895055959, 'lng' => 106.8185290963413],
            ['code' => 2, 'name' => 'Location 2', 'lat' => -6.108207992963954, 'lng' => 106.74207467873244],
            ['code' => 3, 'name' => 'Location 3', 'lat' => -6.222922395250962, 'lng' => 107.0014495385344],
            ['code' => 4, 'name' => 'Location 4', 'lat' => -6.238810559661402, 'lng' => 106.62829264026414],
            ['code' => 5, 'name' => 'Location 5', 'lat' => -6.363196561684572, 'lng' => 107.1800666894639],
            ['code' => 6, 'name' => 'Location 6', 'lat' => -6.012011665026983, 'lng' => 106.06053287198343]
        ];
        foreach ($data as $key => $value) {
            Site::create($value);
        }
    }
}
