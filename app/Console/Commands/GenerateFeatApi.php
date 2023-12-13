<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

class GenerateFeatApi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:feat-api';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Feat API by Model File Name';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $model = $this->getModelName();

        $modelPath = app_path('Models') . '/' . $model . '.php';

        // Check if the 'model' argument is provided and if the model file exists
        if ($model && File::exists($modelPath)) {
            $commands = [
                'make:observer ' . $model . 'Observer --model=' . $model,
                'make:event ' . $model . 'Event',
                'make:policy ' . $model . 'Policy --model=' . $model,
                'make:import ' . $model . 'Import --model=' . $model,
                'make:export ' . $model . 'Export --model=' . $model,
                'make:service ' . $model . 'Service --api --repository',
            ];

            foreach ($commands as $command) {
                Artisan::call($command);
            }

            $this->info('Commands executed successfully.');
        } else {
            $this->error('Please provide a valid model name.');
        }
    }

    /**
     * Get a valid model name from the user.
     *
     * @return string
     */
    private function getModelName()
    {
        $model = null;

        while (empty($model)) {
            $model = $this->ask('What is the model name?');
        }

        return $model;
    }
}
