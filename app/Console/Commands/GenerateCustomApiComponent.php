<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class GenerateCustomApiComponent extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:api';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate API Model, Controller, FormRequest, Resource, Seeder';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $versionName = $this->ask('version code api?', 1);
        $this->info('The Folder path version is : v' . $versionName);

        if ($this->confirm('Do you want to generate model with migration table?', true)) {
            $modelName = $this->ask('What is model name?');
            Artisan::call('make:model ' . 'v' . $versionName . '/' . $modelName . ' -m');
        } else {
            $modelName = $this->ask('What is model name?');
            Artisan::call('make:model ' . 'v' . $versionName . '/' . $modelName);
        }
        $this->info('The Model and Migration was Created');

        if ($this->confirm('Do you want to generate controller?', true)) {
            $folderName = $this->ask('Name of folder path?');
            if ($folderName == null) {
                Artisan::call(
                    'make:controller ' . '
                Api/v' . $versionName . '/' . $modelName . 'Controller
                --model=' . 'v' . $versionName . '/' . $modelName .
                        ' --api'
                );
            } else {
                Artisan::call(
                    'make:controller ' . '
                Api/v' . $versionName . '/' . $folderName . '/' . $modelName . 'Controller
                --model=' . 'v' . $versionName . '/' . $modelName .
                        ' --api'
                );
            }
            $this->info('The Controller was Created');
        }

        if ($this->confirm('Do you want to generate form request?', true)) {
            Artisan::call('make:request ' . 'v' . $versionName . '/' . $modelName . '/Store' . $modelName . 'Request');
            Artisan::call('make:request ' . 'v' . $versionName . '/' . $modelName . '/Update' . $modelName . 'Request');
            $this->info('The Form Request was Created');
        }

        if ($this->confirm('Do you want to generate resource?', true)) {
            Artisan::call('make:resource ' . 'v' . $versionName . '/' . $modelName . 'Resource');
            $this->info('The Resource was Created');
        }

        if ($this->confirm('Do you want to generate seeder?', true)) {
            Artisan::call('make:seeder ' . 'v' . $versionName . '/' . $modelName . 'Seeder');
            $this->info('The Seeder was Created');
        }

        if ($this->confirm('Do you want to generate observer?', true)) {
            Artisan::call('make:observer ' . 'v' . $versionName . '/' . $modelName . 'Observer --model=v' . $versionName . '/' . $modelName);
            $this->info('The Observer was Created');
        }

        if ($this->confirm('Do you want to generate event?', true)) {
            Artisan::call('make:event ' . 'v' . $versionName . '/' . $modelName . 'Event');
            $this->info('The Event was Created');
        }

        if ($this->confirm('Do you want to generate policy?', true)) {
            Artisan::call('make:policy ' . 'v' . $versionName . '/' . $modelName . 'Policy --model=v' . $versionName . '/' . $modelName);
            $this->info('The Policy was Created');
        }


        $this->info('Congratulation, All Command Finished Successfully!');
    }
}
