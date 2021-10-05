<?php
namespace rifrocket\LaravelCms\Database\seeders;

use rifrocket\LaravelCms\Models\LbsMedia;
use rifrocket\LaravelCms\Models\LbsSetting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LbsSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LbsSetting::truncate();


        DB::table('lbs_settings')->insert([
            ['setting_meta_key'=>'app_company','setting_meta_value'=>'Laravel-CMS'],
            ['setting_meta_key'=>'app_domain','setting_meta_value'=>'laravel.com'],
            ['setting_meta_key'=>'app_url','setting_meta_value'=>'https://laravel.com'],
            ['setting_meta_key'=>'app_local','setting_meta_value'=>'en'],
            ['setting_meta_key'=>'app_guest_login','setting_meta_value'=>'false'],
            ['setting_meta_key'=>'app_logo','setting_meta_value'=>null],
            ['setting_meta_key'=>'app_favicon','setting_meta_value'=>null],
            ['setting_meta_key'=>'app_title','setting_meta_value'=>'laravel'],
            ['setting_meta_key'=>'app_email','setting_meta_value'=>null],
            ['setting_meta_key'=>'app_mailer_host','setting_meta_value'=>'smtp.mailtrap.io'],
            ['setting_meta_key'=>'app_mailer_login','setting_meta_value'=>'3b76d480ffde79'],
            ['setting_meta_key'=>'app_mailer_pass','setting_meta_value'=>'b417a09d319f2c'],
            ['setting_meta_key'=>'app_mailer_mail','setting_meta_value'=>'example@laravel.com'],
            ['setting_meta_key'=>'app_mailer_port','setting_meta_value'=>'2525'],
            ['setting_meta_key'=>'app_mailer_encrypt','setting_meta_value'=>'tls'],
            ['setting_meta_key'=>'app_recaptcha','setting_meta_value'=>'false'],
            ['setting_meta_key'=>'app_recaptcha_key','setting_meta_value'=>null],
            ['setting_meta_key'=>'app_recaptcha_secret','setting_meta_value'=>null],
            ['setting_meta_key'=>'app_google_api','setting_meta_value'=>null],
            ['setting_meta_key'=>'app_meta_key','setting_meta_value'=>null],
            ['setting_meta_key'=>'app_meta_disruption','setting_meta_value'=>null],
            ['setting_meta_key'=>'app_version','setting_meta_value'=>'1.0'],
            ['setting_meta_key'=>'app_media_resize','setting_meta_value'=>LbsMedia::MEDIA_RESIZE],
            ['setting_meta_key'=>LbsMedia::MEDIA_THUMBNAIL,'setting_meta_value'=>'150x150'],
            ['setting_meta_key'=>LbsMedia::MEDIA_MINI,'setting_meta_value'=>'300x169'],
            ['setting_meta_key'=>LbsMedia::MEDIA_MEDIUM,'setting_meta_value'=>'768x432'],
            ['setting_meta_key'=>LbsMedia::MEDIA_LARGE,'setting_meta_value'=>'1568x882'],
        ]);
    }
}
