<?php

namespace Database\Seeders;

use Database\Seeders\v1\AnnualTaxFileSeeder;
use Database\Seeders\v1\AuthVerificationMethodSeeder;
use Database\Seeders\v1\ClientRoleSeeder;
use Database\Seeders\v1\CompanyInformationSeeder;
use Database\Seeders\v1\DemoEmployeeSeeder;
use Database\Seeders\v1\DepartmentSeeder;
use Database\Seeders\v1\DesignationSeeder;
use Database\Seeders\v1\DeveloperNoteSeeder;
use Database\Seeders\v1\EmployeeCurrencyTypeSeeder;
use Database\Seeders\v1\EmployeeSeeder;
use Database\Seeders\v1\EmployeeTypeSeeder;
use Database\Seeders\v1\FAQSeeder;
use Database\Seeders\v1\GradeSeeder;
use Database\Seeders\v1\HomeSliderSeeder;
use Database\Seeders\v1\MobileAppMenuSeeder;
use Database\Seeders\v1\MobileAppServerStatusSeeder;
use Database\Seeders\v1\MobileBuildTypeSeeder;
use Database\Seeders\v1\MobileDeviceTypeSeeder;
use Database\Seeders\v1\MobileStatusSeeder;
use Database\Seeders\v1\MobileVersionSeeder;
use Database\Seeders\v1\NotificationTypeSeeder;
use Database\Seeders\v1\PayrollMonthSeeder;
use Database\Seeders\v1\PermissionSeeder;
use Database\Seeders\v1\PrivateAccessSeeder;
use Database\Seeders\v1\RoleSeeder;
use Database\Seeders\v1\ThrFileSeeder;
use Database\Seeders\v1\UserBurstSeeder;
use Database\Seeders\v1\VerificationCodeTypeSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        //disable foreign key check for this connection before running seeders
        // DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Artisan::call('passport:install');

        $this->call([
            PermissionSeeder::class,
            RoleSeeder::class,
            VerificationCodeTypeSeeder::class,
            AuthVerificationMethodSeeder::class
        ]);

        $this->call([
            MobileAppServerStatusSeeder::class,
            HomeSliderSeeder::class,
            CompanyInformationSeeder::class,
        ]);

        $this->call([
            MobileDeviceTypeSeeder::class,
            MobileBuildTypeSeeder::class,
            MobileStatusSeeder::class,
            MobileVersionSeeder::class,
        ]);

        $this->call([
            FAQSeeder::class,
            DeveloperNoteSeeder::class,
            NotificationTypeSeeder::class,
            MobileAppMenuSeeder::class,
        ]);

        if (app()->isProduction()) {

            $this->call([
                IndonesiaSeeder::class,
            ]);
        }

        $this->call([
            UserBurstSeeder::class,
            ClientRoleSeeder::class,
            PrivateAccessSeeder::class,
        ]);


        // DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
