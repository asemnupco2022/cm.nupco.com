<?php
namespace rifrocket\LaravelCms\Database\seeders;


use rifrocket\LaravelCms\Models\LbsModelProvider;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LbsModelProviderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        LbsModelProvider::truncate();

        DB::table('lbs_model_providers')->insert([
            ['model'=>'lbs_admin', 'model_tb_name'=>'lbs_admins', 'model_path'=>'rifrocket\\LaravelCms\\Models\\LbsAdmin', 'meta_path'=>'rifrocket\\LaravelCms\\Models\\LbsUserMeta', 'meta_rel_key'=>'user_id', 'model_unique'=>'true'],
            ['model'=>'lbs_member', 'model_tb_name'=>'lbs_members', 'model_path'=>'rifrocket\\LaravelCms\\Models\\LbsMember', 'meta_path'=>'rifrocket\\LaravelCms\\Models\\LbsUserMeta', 'meta_rel_key'=>'user_id', 'model_unique'=>'true'],
            ['model'=>'lbs_user_meta', 'model_tb_name'=>'lbs_user_metas', 'model_path'=>'rifrocket\\LaravelCms\\Models\\LbsUserMeta', 'meta_path'=>null,' meta_rel_key'=>null, 'model_unique'=>null],
            ['model'=>'lsb_setting', 'model_tb_name'=>'lsb_settings', 'model_path'=>'rifrocket\\LaravelCms\\Models\\LbsSetting', 'meta_path'=>null, 'meta_rel_key'=>null, 'model_unique'=>null],
            ['model'=>'lsb_lte_setting', 'model_tb_name'=>'lbs_lte_settings', 'model_path'=>'rifrocket\\LaravelCms\\Models\\LbsLteSetting', 'meta_path'=>'rifrocket\\LaravelCms\\Models\\LbsLteSettingMeta', 'meta_rel_key'=>'lbs_lte_setting_id', 'model_unique'=>null],
            ['model'=>'lbs_lte_setting_meta', 'model_tb_name'=>'lbs_lte_setting_metas', 'model_path'=>'rifrocket\\LaravelCms\\Models\\LbsLteSettingMeta', 'meta_path'=>null, 'meta_rel_key'=>null, 'model_unique'=>null],
            ['model'=>'lbs_model_provider', 'model_tb_name'=>'lbs_model_providers', 'model_path'=>'rifrocket\\LaravelCms\\Models\\LbsModelProvider', 'meta_path'=>null, 'meta_rel_key'=>null, 'model_unique'=>null],
            ['model'=>'lbs_reset_password', 'model_tb_name'=>'lbs_reset_passwords', 'model_path'=>'rifrocket\\LaravelCms\\Models\\LbsResetPassword', 'meta_path'=>null, 'meta_rel_key'=>null, 'model_unique'=>null],
            ['model'=>'lbs_master_taxonomie', 'model_tb_name'=>'lbs_master_taxonomies', 'model_path'=>'rifrocket\\LaravelCms\\Models\\LbsMasterTaxonomy', 'meta_path'=>null, 'meta_rel_key'=>null, 'model_unique'=>null],
            ['model'=>'lbs_media', 'model_tb_name'=>'lbs_media', 'model_path'=>'rifrocket\\LaravelCms\\Models\\LbsMedia', 'meta_path'=>'rifrocket\\LaravelCms\\Models\\LbsMediaMeta', 'meta_rel_key'=>'lbs_media_id', 'model_unique'=>null],
        ]);
    }
}
