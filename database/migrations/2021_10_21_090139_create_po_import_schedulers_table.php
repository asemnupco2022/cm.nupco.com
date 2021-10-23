<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePoImportSchedulersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('po_import_schedulers', function (Blueprint $table) {
            $table->id();
            $table->string('table_type');
            $table->string('path');
            $table->bigInteger('total_files')->default(0);
            $table->bigInteger('total_records')->default(0);
            $table->bigInteger('total_ex_files')->default(0);
            $table->bigInteger('total_ex_records')->default(0);
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->text('meta')->nullable();
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
        Schema::dropIfExists('po_import_schedulers');
    }
}
