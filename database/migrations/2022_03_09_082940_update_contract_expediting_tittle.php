<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateContractExpeditingTittle extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*
          UPDATE `lbs_settings` 
          SET `setting_meta_value` = 'Contracts Expediting system', 
          `deleted_at` = NULL, 
          `created_at` = NULL, 
          `updated_at` = NULL 
          WHERE 
          `lbs_settings`.`id` = 1;
          /**/
        DB::table('lbs_settings')->where('id','1')->update([
                                                            "setting_meta_value" => "Contracts Expediting system",
                                                            "deleted_at" =>NULL,
                                                            "created_at" =>NULL,
                                                            "updated_at" =>NULL          
                                                            ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
