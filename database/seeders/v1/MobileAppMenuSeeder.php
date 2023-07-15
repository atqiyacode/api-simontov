<?php

namespace Database\Seeders\v1;

use App\Models\v1\MobileAppMenu;
use App\Models\v1\MobileStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class MobileAppMenuSeeder extends Seeder
{
    // use WithoutModelEvents;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $active = MobileStatus::active()->first();
        $inactive = MobileStatus::inactive()->first();
        MobileAppMenu::truncate();
        MobileAppMenu::updateOrCreate([
            'code' => 'payslip',
            'name' => 'Slip Gaji',
            'slug' => Str::slug('Slip Gaji'),
            'name_en' => 'Payslip',
            'description' => 'description',
            'description_en' => 'description en',
            'icon' => config('app.url') . '/images/icon/payslip-01.svg',
            'mobile_status_id' => $active->id,
        ]);
        MobileAppMenu::updateOrCreate([
            'code' => 'tax',
            'name' => 'Pajak',
            'slug' => Str::slug('Pajak'),
            'name_en' => 'Tax',
            'description' => 'description',
            'description_en' => 'description en',
            'icon' => config('app.url') . '/images/icon/tax-01.svg',
            'mobile_status_id' => $active->id,
        ]);
        MobileAppMenu::updateOrCreate([
            'code' => 'thr',
            'name' => 'THR',
            'slug' => Str::slug('THR'),
            'name_en' => 'THR',
            'description' => 'description',
            'description_en' => 'description en',
            'icon' => config('app.url') . '/images/icon/thr-01.svg',
            'mobile_status_id' => $active->id,
        ]);
        MobileAppMenu::updateOrCreate([
            'code' => 'contact',
            'name' => 'Kontak',
            'slug' => Str::slug('Kontak'),
            'name_en' => 'Contact',
            'description' => 'description',
            'description_en' => 'description en',
            'icon' => config('app.url') . '/images/icon/contact-01.svg',
            'mobile_status_id' => $active->id,
        ]);
        // coming soon
        MobileAppMenu::updateOrCreate([
            'code' => 'attandence',
            'name' => 'Absensi',
            'slug' => Str::slug('Absensi'),
            'name_en' => 'Attendence',
            'description' => 'description',
            'description_en' => 'description en',
            'icon' => config('app.url') . '/images/icon/attandence-01.svg',
            'mobile_status_id' => $inactive->id,
        ]);
        MobileAppMenu::updateOrCreate([
            'code' => 'leave',
            'name' => 'Cuti',
            'slug' => Str::slug('Cuti'),
            'name_en' => 'Paid Leave',
            'description' => 'description',
            'description_en' => 'description en',
            'icon' => config('app.url') . '/images/icon/leave-01.svg',
            'mobile_status_id' => $inactive->id,
        ]);
        MobileAppMenu::updateOrCreate([
            'code' => 'reimburst',
            'name' => 'Reimburst',
            'slug' => Str::slug('Reimburst'),
            'name_en' => 'Repayments',
            'description' => 'description',
            'description_en' => 'description en',
            'icon' => config('app.url') . '/images/icon/reimburs-01.svg',
            'mobile_status_id' => $inactive->id,
        ]);
        MobileAppMenu::updateOrCreate([
            'code' => 'dana',
            'name' => 'Dana',
            'slug' => Str::slug('Dana'),
            'name_en' => 'Fund',
            'description' => 'description',
            'description_en' => 'description en',
            'icon' => config('app.url') . '/images/icon/dana-01.svg',
            'mobile_status_id' => $inactive->id,
        ]);
        // MobileAppMenu::updateOrCreate([
        //     'code' => 'koperasi',
        //     'name' => 'Koperasi',
        //     'slug' => Str::slug('Koperasi'),
        //     'name_en' => 'Cooperative',
        //     'description' => 'description',
        //     'description_en' => 'description en',
        //     'icon' => config('app.url') . '/images/icon/koperasi-01.svg',
        //     'mobile_status_id' => $inactive->id,
        // ]);
    }
}
