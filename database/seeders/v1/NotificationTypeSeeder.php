<?php

namespace Database\Seeders\v1;

use App\Models\v1\NotificationType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class NotificationTypeSeeder extends Seeder
{
    // use WithoutModelEvents;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        NotificationType::create([
            'name' => 'whatsapp notification',
            'slug' => Str::slug('whatsapp notification'),
            'status' => (bool) false,
        ]);
        NotificationType::create([
            'name' => 'email notification',
            'slug' => Str::slug('email notification'),
            'status' => (bool) true,
        ]);
        NotificationType::create([
            'name' => 'global notification',
            'slug' => Str::slug('global notification'),
            'status' => (bool) true,
        ]);
    }
}
