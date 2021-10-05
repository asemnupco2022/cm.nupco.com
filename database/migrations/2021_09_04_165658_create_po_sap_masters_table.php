<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePoSapMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('po_sap_masters', function (Blueprint $table) {
            $table->id();
            $table->string('po_type')->nullable();
            $table->string('po_type_description')->nullable();
            $table->string('pur_group')->nullable();
            $table->string('customer_name')->nullable();
            $table->string('tender_no')->nullable();
            $table->string('vendor_code')->nullable();
            $table->string('vendor_name')->nullable();
            $table->string('contact_no')->nullable();
            $table->string('contract_item_no')->nullable();
            $table->string('purchasing_document')->nullable();
            $table->bigInteger('po_item')->nullable();
            $table->string('generic_mat_code')->nullable();
            $table->string('nupco_trade_code')->nullable();
            $table->string('cust_gen_code')->nullable();
            $table->string('mat_description')->nullable();
            $table->string('uom')->nullable();
            $table->string('ordered_quantity')->nullable();
            $table->string('gr_qty')->nullable();
            $table->string('supply_ration')->nullable();
            $table->bigInteger('open_quantity')->nullable();
            $table->string('net_price_per_unit_1')->nullable();
            $table->float('net_order_value')->nullable();
            $table->string('gr_amount')->nullable();
            $table->string('currency')->nullable();
            $table->string('delivery_address')->nullable();
            $table->string('nupco_delivery_date')->nullable();
            $table->string('delivery_no')->nullable();
            $table->string('item_status')->nullable();
            $table->string('plant')->nullable();
            $table->string('storage_location')->nullable();
            $table->string('old_new_po_number')->nullable();
            $table->string('old_po_item')->nullable();
            $table->string('old_p_o1')->nullable();
            $table->string('old_po_item1')->nullable();
            $table->string('on_behalf_of_po')->nullable();
            $table->string('on_behalf_of_po_item')->nullable();
            $table->string('the_testimonial')->nullable();
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
        Schema::dropIfExists('po_sap_masters');
    }
}
