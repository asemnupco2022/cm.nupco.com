<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNupAutoSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nup_auto_settings', function (Blueprint $table) {
            $table->id();
            $table->string('setting_for_table');
            $table->string('first_notification');
            $table->string('second_notification')->nullable();
            $table->string('thired_notification')->nullable();
            $table->string('fourth_notification')->nullable();
            $table->string('supply_ratio')->nullable();
            $table->enum('setting_switch', ['production', 'quality'])->default('quality');
            $table->string('test_email');
            $table->text('json_data')->nullable();
            $table->enum('status', ['new', 'active', 'deactivated', 'suspended'])->default('active');
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
        Schema::dropIfExists('nup_auto_settings');
    }
}
