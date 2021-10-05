<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePoMowaredMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('po_mowared_masters', function (Blueprint $table) {
            $table->id();
            $table->string('item_code')->nullable();
            $table->string('desc')->nullable();
            $table->string('pur_group')->nullable();
            $table->string('region_qtye')->nullable();
            $table->string('recived')->nullable();
            $table->string('initial_recived')->nullable();
            $table->string('unit_price')->nullable();
            $table->string('pending_qty')->nullable();
            $table->string('total_recived_qty')->nullable();
            $table->string('initial_reciving_value')->nullable();
            $table->string('item_total_value')->nullable();
            $table->string('final_reciving_value')->nullable();
            $table->string('value_of_delivered')->nullable();
            $table->string('available_qty_for_main_store')->nullable();
            $table->string('available_qty_for_all_locations')->nullable();
            $table->string('monthly_consumption')->nullable();
            $table->string('tender_no')->nullable();
            $table->string('contract_no')->nullable();
            $table->string('tender_name')->nullable();
            $table->string('vendor_number')->nullable();
            $table->string('vendor_name')->nullable();
            $table->string('country_of_origion')->nullable();
            $table->string('manfacturing_co')->nullable();
            $table->string('contract_start_date')->nullable();
            $table->string('contract_start_hijri')->nullable();
            $table->string('contract_end_date')->nullable();
            $table->string('contract_end_date_hijri')->nullable();
            $table->string('region_code')->nullable();
            $table->string('store')->nullable();
            $table->string('shipments')->nullable();
            $table->string('trade_date')->nullable();
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
        Schema::dropIfExists('po_mowared_masters');
    }
}
