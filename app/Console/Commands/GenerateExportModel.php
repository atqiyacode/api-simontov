<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class GenerateExportModel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:export-model';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Export by Model';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $models = [
            // auth user
            'Role',
            'Permission',
            // features
            'Location',
            'RangeType',
            'RangeCost',
            'Flowrate',
            'StatusAlarm',
            'Tax',
            'User',
            'DashboardChart',
            // queue job
            'FailedJob',
            'UserLogActivity',

        ];
        foreach ($models as $model) {
            Artisan::call('make:export ' . $model . 'Export --model=' . $model);
        }


        $this->info('Congratulation, All Command Finished Successfully!');
    }
}