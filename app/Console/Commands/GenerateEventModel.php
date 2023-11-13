<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class GenerateEventModel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:event-model';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Event by Model';

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
            Artisan::call('make:observer ' . $model . 'Observer --model=' . $model);
            Artisan::call('make:event ' . $model . 'Event');
            Artisan::call('make:policy ' . $model . 'Policy --model=' . $model);
        }


        $this->info('Congratulation, All Command Finished Successfully!');
    }
}
