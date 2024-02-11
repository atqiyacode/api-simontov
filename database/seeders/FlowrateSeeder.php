<?php

namespace Database\Seeders;

use App\Models\Flowrate;
use Illuminate\Database\Seeder;

class FlowrateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $files = glob(public_path('flowrates_backup/flowrates_*.json'));

        foreach ($files as $file) {
            $data = json_decode(file_get_contents($file), true);

            if ($data && isset($data['flowrates'])) {
                $chunkedData = array_chunk($data['flowrates'], 200); // Adjust the chunk size as needed

                foreach ($chunkedData as $chunk) {
                    Flowrate::insert($chunk);
                }

                $this->command->info("Data from $file seeded successfully.");
            } else {
                $this->command->error("Invalid JSON file format: $file");
            }
        }
    }
}
