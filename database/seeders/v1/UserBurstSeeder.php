<?php

namespace Database\Seeders\v1;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class UserBurstSeeder extends Seeder
{
    use WithoutModelEvents;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = public_path('sample-file/users.json');
        $data = json_decode(file_get_contents($path), true);
        $userList = [];
        foreach ($data as $key) {
            $userList[] = [
                'name' => Str::upper($key['name']),
                'username' => str::lower($key['username']),
                'email' => Str::lower($key['email']),
                'email_verified_at' => $key['email_verified_at'],
                'password' => $key['password'],
                'remember_token' => $key['remember_token'],
                'created_at' => $key['created_at'],
                'updated_at' => $key['updated_at'],
                'avatar' => $key['avatar'],
                'phone' => $key['phone'],
                'deleted_at' => $key['deleted_at'],
            ];
        }
        $chunks = array_chunk($userList, 1000);
        foreach ($chunks as $chunk) {
            User::upsert($chunk, ['username', 'phone', 'email'], null);
        }
    }
}
