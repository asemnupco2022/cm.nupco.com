<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLbsModelProvidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lbs_model_providers', function (Blueprint $table) {
            $table->id();
            $table->string('model')->unique();
            $table->string('model_path')->unique();
            $table->string('model_tb_name');
            $table->string('meta_path')->nullable();
            $table->string('meta_rel_key')->nullable();
            $table->string('model_unique')->nullable();
            $table->text('json_data')->nullable();
            $table->enum('status',['new','active', 'deactivated', 'suspended'])->default('active');
            $table->text('suspendReason')->nullable();
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
        Schema::dropIfExists('lbs_model_providers');
    }
}
