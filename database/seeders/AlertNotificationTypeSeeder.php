<?php

namespace Database\Seeders;

use App\Models\AlertNotificationType;
use Illuminate\Database\Seeder;

class AlertNotificationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        AlertNotificationType::updateOrCreate([
            'id' => 1,
            'name' => 'AlertDataFlowrateEvent',
            'job_event' => 'App\Events\AlertDataFlowrateEvent',
            'description' => 'Data tidak masuk dalam 3 menit',
        ]);
        AlertNotificationType::updateOrCreate([
            'id' => 2,
            'name' => 'AlertTotalizerEvent',
            'job_event' => 'App\Events\AlertTotalizerEvent',
            'description' => 'Nilai totalizer tidak ada perubahan dalam 12 jam',
        ]);
        AlertNotificationType::updateOrCreate([
            'id' => 3,
            'name' => 'AlertCodEvent',
            'job_event' => 'App\Events\AlertCodEvent',
            'description' => 'Nilai COD diatas 90 mg/l',
        ]);
        AlertNotificationType::updateOrCreate([
            'id' => 4,
            'name' => 'AlertPHEvent',
            'job_event' => 'App\Events\AlertPHEvent',
            'description' => 'Nilai PH dibawah 6 atau diatas 9',
        ]);
        AlertNotificationType::updateOrCreate([
            'id' => 5,
            'name' => 'AlertElectricityEvent',
            'job_event' => 'App\Events\AlertElectricityEvent',
            'description' => 'Listrik menggunkan UPS            ',
        ]);
    }
}