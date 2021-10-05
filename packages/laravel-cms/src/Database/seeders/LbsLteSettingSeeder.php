<?php
namespace rifrocket\LaravelCms\Database\seeders;

use rifrocket\LaravelCms\Models\LbsLteSetting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LbsLteSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LbsLteSetting::truncate();

        DB::table('lbs_lte_settings')->insert([
            'admin_id'=>1,
            'provider'=>'admin',
            'NavbarVariants'=>null,
            'AccentColorVariants'=>null,
            'DarkSidebarVariants'=>null,
            'LightSidebarVariants'=>null,
            'BrandLogoVariants'=>null,
            'CardGradientVariants'=>null,
            'side_dark_mode'=>null,
            'dark_mode'=>null,
        ]);
    }
}
