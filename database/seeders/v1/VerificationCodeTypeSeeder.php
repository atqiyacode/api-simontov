<?php

namespace Database\Seeders\v1;

use App\Models\v1\VerificationCodeType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class VerificationCodeTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $list = [
            [
                'name' => 'login',
                'slug' => Str::slug('login')
            ],
            [
                'name' => 'register',
                'slug' => Str::slug('register')
            ],
            [
                'name' => 'forgot password',
                'slug' => Str::slug('forgot password')
            ],
            [
                'name' => 'confirmation',
                'slug' => Str::slug('confirmation')
            ],
            [
                'name' => 'resend login',
                'slug' => Str::slug('resend login')
            ],
            [
                'name' => 'resend register',
                'slug' => Str::slug('resend register')
            ],
            [
                'name' => 'resend forgot password',
                'slug' => Str::slug('resend forgot password')
            ],
            [
                'name' => 'resend confirmation',
                'slug' => Str::slug('resend confirmation')
            ],

        ];

        // $chunks = array_chunk($list, 100);
        foreach ($list as $chunk) {
            VerificationCodeType::updateOrCreate($chunk);
        }
    }
}
