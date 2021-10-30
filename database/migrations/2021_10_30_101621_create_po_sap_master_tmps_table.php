<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePoSapMasterTmpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('po_sap_master_tmps', function (Blueprint $table) {
            $table->id();
            $table->string('table_type');
            $table->bigInteger('po_number');
            $table->bigInteger('po_item');
            $table->string('unique_hash')->nullable();
            $table->enum('execution_done',['init','20','15', '5', '0','finish'])->default('init');
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
        Schema::dropIfExists('po_sap_master_tmps');
    }
}
