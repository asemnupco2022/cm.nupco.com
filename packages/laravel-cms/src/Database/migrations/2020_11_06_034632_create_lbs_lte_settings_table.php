<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLbsLteSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lbs_lte_settings', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('admin_id');
            $table->text('provider')->nullable();
            $table->string('NavbarVariants')->nullable();
            $table->string('AccentColorVariants')->nullable();
            $table->string('DarkSidebarVariants')->nullable();
            $table->string('LightSidebarVariants')->nullable();
            $table->string('BrandLogoVariants')->nullable();
            $table->string('CardGradientVariants')->nullable();
            $table->string('side_dark_mode')->nullable();
            $table->string('dark_mode')->nullable();
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
        Schema::dropIfExists('lbs_lte_settings');
    }
}
