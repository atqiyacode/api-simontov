<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class GenerateApiModel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:api-model';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate API Model, Controller, FormRequest, Resource, Seeder, Filters Model';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $commands = [
            // // auth user
            // 'api:generate Role "name:string|guard_name:string" --all --routes --soft-delete',
            // 'api:generate Permission "name:string|guard_name:string" --all --routes --soft-delete',
            // // queue job
            // 'api:generate FailedJob --all --routes',
            // 'api:generate UserLogActivity --all --routes',

            'api:generate InvoiceTemplate "company_name:string|company_address:longText|phone:string:nullable|fax:string:nullable|npwp:string:nullable|additional_section:longText:nullable|manager_name:string|note:longText:nullbale" --all --routes',

        ];
        foreach ($commands as $command) {
            Artisan::call($command);
        }


        $this->info('Congratulation, All Command Finished Successfully!');
    }
}
