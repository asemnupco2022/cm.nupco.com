<?php
namespace rifrocket\LaravelCms\Database\seeders;

use Illuminate\Database\Seeder;

class LbsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(LbsModelProviderSeeder::class);
        $this->call(LbsAdminSeeder::class);
        $this->call(LbsMemberSeeder::class);
        $this->call(LbsSettingSeeder::class);
        $this->call(LbsLteSettingSeeder::class);
    }
}
