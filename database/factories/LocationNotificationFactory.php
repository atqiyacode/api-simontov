<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class LocationNotificationFactory extends Factory
{
    public function definition(): array
    {
        return [
            'location_id' => createOrRandomFactory(\App\Models\Location::class),
			'alert_notification_type_id' => createOrRandomFactory(\App\Models\AlertNotificationType::class),
        ];
    }
}
