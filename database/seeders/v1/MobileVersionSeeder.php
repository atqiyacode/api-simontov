<?php

namespace Database\Seeders\v1;

use App\Models\v1\MobileBuildType;
use App\Models\v1\MobileDeviceType;
use App\Models\v1\MobileStatus;
use App\Models\v1\MobileVersion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MobileVersionSeeder extends Seeder
{
    // use WithoutModelEvents;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MobileVersion::updateOrCreate([
            // android
            'mobile_device_type_id' => MobileDeviceType::whereName('android')->first()->id,
            'mobile_build_type_id' => MobileBuildType::whereName('release')->first()->id,
            'mobile_status_id' => MobileStatus::whereName('active')->first()->id,
            'code' => 5,
            'name' => '5.1',
            'slug' => '5.1',
            'note' => 'New Features',
            'app_file' => null,
            'release_url' => 'https://play.google.com/store/apps/details?id=com.payroll.ibr.app&pcampaignid=pcampaignidMKT-Other-global-all-co-prtnr-py-PartBadge-Mar2515-1',
        ]);

        MobileVersion::updateOrCreate([
            // ios
            'mobile_device_type_id' => MobileDeviceType::whereName('ios')->first()->id,
            'mobile_build_type_id' => MobileBuildType::whereName('beta')->first()->id,
            'mobile_status_id' => MobileStatus::whereName('inactive')->first()->id,
            'code' => 5,
            'name' => '5.1',
            'slug' => '5.1',
            'note' => 'New Features',
            'app_file' => null,
            'release_url' => '',
        ]);
    }
}
