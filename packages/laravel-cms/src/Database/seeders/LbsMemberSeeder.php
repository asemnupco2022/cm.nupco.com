<?php
namespace rifrocket\LaravelCms\Database\seeders;


use rifrocket\LaravelCms\Helpers\Classes\LbsConstants;
use rifrocket\LaravelCms\Models\LbsMember;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class LbsMemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LbsMember::truncate();
        // DB::table('lbs_members')->insert([
        //     'first_name' => 'super',
        //     'last_name' => 'admin',
        //     'username' => 'administrator',
        //     'display_name' => 'administrator',
        //     'email' => 'developer@gmail.com',
        //     'password' => Hash::make('123456789'),
        //     'email_verified_at' => now(),
        //     'role' => LbsConstants::MEMBER_ROLE,
        //     'contact' => null,
        //     'avatar' => null,
        //     'url' => null,
        //     'remember_token' => Str::random(30),
        // ]);
    }
}
