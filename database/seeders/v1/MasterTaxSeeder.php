<?php

namespace Database\Seeders\v1;

use App\Models\v1\MasterTax;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MasterTaxSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MasterTax::create([
            'value' => 10000000
        ]);
    }
}
