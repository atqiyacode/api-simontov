<?php

namespace App\Console\Commands;

use App\Jobs\v1\FlowrateMqttJob;
use Carbon\Carbon;
use Illuminate\Console\Command;

class GenerateDummyFlowrateData extends Command
{
    protected $signature = 'generate:dummy-data {count}';
    protected $description = 'Generate and dispatch dummy data with a 5-second delay between batches';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $count = $this->argument('count');
        $batchSize = 1; // Adjust the batch size as needed

        for ($i = 0; $i < $count; $i += $batchSize) {
            $batchCount = min($batchSize, $count - $i);

            for ($j = 0; $j < $batchCount; $j++) {
                $randpattern = '';
                while (strlen($randpattern) < fake()->numberBetween($min = 0, $max = 14))
                    $randpattern .= rand(0, 1);
                // Generate dummy data and dispatch it as a job with a 5-second delay
                dispatch(new FlowrateMqttJob([
                    'mag_date' => Carbon::now()->format('Y-m-d H:i'),
                    'mag_date_time' => Carbon::now()->timestamp,
                    'flowrate' => fake()->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = 50),
                    'unit_flowrate' => 'm3/h',
                    'totalizer_1' => fake()->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = 100),
                    'totalizer_2' => fake()->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = 100),
                    'totalizer_3' => fake()->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = 100),
                    'unit_totalizer' => 'm3',
                    'analog_1' => fake()->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = 5),
                    'analog_2' => fake()->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = 5),
                    'status_battery' => fake()->numberBetween($min = 10, $max = 100),
                    'alarm' => fake()->numberBetween($min = 10, $max = 150),
                    'bin_alarm' => $randpattern,
                    // 'file_name' => 'FILE-' . fake()->numberBetween($min = 1, $max = 5),
                    'file_name' => 'FILE-1',
                    'created_at' => now(),
                    'updated_at' => now(),

                    'ph' => fake()->numberBetween($min = 1, $max = 10),
                    'cod' => fake()->numberBetween($min = 1, $max = 10),
                ]))->delay(5);
            }

            // Output a message (optional)
            $this->info("Dispatched $batchCount dummy data sets.");

            // Sleep for 5 seconds
            sleep(5);
        }
    }
}