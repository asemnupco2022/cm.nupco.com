<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLbsUserSearchSetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lbs_user_search_sets', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->string('template_name');
            $table->string('template_for_table');
            $table->string('pages')->nullable();
            $table->string('filter_tm1')->nullable();
            $table->string('filter_tm2')->nullable();
            $table->string('make_fav')->nullable();
            $table->text('json_data')->nullable();
            $table->enum('status',['new','active', 'deactivated', 'suspended'])->default('active');
            $table->text('suspendReason')->nullable();
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lbs_user_search_sets');
    }
}
