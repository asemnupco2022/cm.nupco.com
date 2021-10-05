<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLbsMasterTaxonomiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lbs_master_taxonomies', function (Blueprint $table) {
            $table->id();
            $table->string('category_name');
            $table->string('is_parent')->default('parent');
            $table->string('category_parents')->nullable();
            $table->string('slug')->unique();
            $table->string('taxonomies_owner_model');
            $table->text('taxonomies_meta')->nullable();
            $table->text('taxonomies_options')->nullable();
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
        Schema::dropIfExists('lbs_master_taxonomies');
    }
}
