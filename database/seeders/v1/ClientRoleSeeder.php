<?php

namespace Database\Seeders\v1;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class ClientRoleSeeder extends Seeder
{
    use WithoutModelEvents;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superadminRole = Role::where('name', 'superadmin')->first();
        $adminRole = Role::where(['name' => 'admin'])->first();
        $employeeRole = Role::where('name', 'employee')->first();

        $users = User::select(['id', 'username', 'email'])->withTrashed()->get();

        foreach ($users as $user) {
            if ($user->username !== 'atqiyacode' || $user->username !== 'jeksi') {
                if ($user->email === 'arisoma.nugraha@adityabirla.com') {
                    $user->syncRoles([$adminRole, $employeeRole]);
                } elseif ($user->email === 'iwan.tresna@adityabirla.com') {
                    $user->syncRoles([$adminRole, $employeeRole]);
                } elseif ($user->email === 'rikki.herlambang@adityabirla.com') {
                    $user->syncRoles([$adminRole, $employeeRole, $superadminRole]);
                } else {
                    $user->syncRoles($employeeRole);
                }
            }
        }
    }
}
