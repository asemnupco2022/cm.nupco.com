<?php

namespace rifrocket\LaravelCms\Database\seeders;

use rifrocket\LaravelCms\Models\LbsAdmin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class LbsAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LbsAdmin::truncate();
        DB::table('lbs_admins')->insert([
            'employee_num'=>rand(10,10),
            'first_name' => 'super',
            'last_name' => 'admin',
            'username' => 'administrator',
            'display_name' => 'administrator',
            'email' => 'admin@nupco.com',
            'password' => Hash::make('123456789'),
            'email_verified_at' => now(),
            'role' => LbsAdmin::LBS_CONST_SUPER_ADMIN,
            'avatar' => null,
            'url' => null,
            'remember_token' => Str::random(30),
        ]);
    }
}
