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
           $table->string("document_type")->nullable();
           $table->string("document_type_desc")->nullable();
           $table->bigInteger("po_number")->nullable();
           $table->bigInteger("po_item")->nullable();
           $table->bigInteger("material_number")->nullable();
           $table->string("mat_description")->nullable();
           $table->date("po_created_on")->nullable();
           $table->bigInteger("purchasing_organization")->nullable();
           $table->bigInteger("purchasing_group")->nullable();
           $table->string("currency")->nullable();
           $table->bigInteger("customer_no")->nullable();
           $table->string("customer_name")->nullable();
           $table->string("tender_no")->nullable();
           $table->string("tender_desc")->nullable();
           $table->string("vendor_code")->nullable();
           $table->string("vendor_name_en")->nullable();
           $table->string("vendor_name_er")->nullable();
           $table->string("plant")->nullable();
           $table->string("storage_location")->nullable();
           $table->string("uo_m")->nullable();
           $table->string("net_price")->nullable();
           $table->string("price_unit")->nullable();
           $table->string("net_value")->nullable();
           $table->string("nupco_trade_code")->nullable();
           $table->date("nupco_delivery_date")->nullable();
           $table->string("ordered_quantity")->nullable();
           $table->string("open_quantity")->nullable();
           $table->string("item_status")->nullable();
           $table->string("delivery_address")->nullable();
           $table->string("delivery_no")->nullable();
           $table->string("cust_cont_trade_numb")->nullable();
           $table->bigInteger("cust_gen_code")->nullable();
           $table->bigInteger("generic_mat_code")->nullable();
           $table->string("old_new_po_number")->nullable();
           $table->bigInteger("old_po_item")->nullable();
           $table->string("gr_quantity")->nullable();
           $table->string("gr_amount")->nullable();
           $table->float("supply_ratio")->nullable();
           $table->string("uniue_line")->unique()->index();
           $table->string("uniue_line_date")->unique()->index();
           $table->enum("notified",['no','yes'])->default('no');
           $table->enum("asn",['no','new','approved','rejected','delivered','not_delivered'])->default('no');
           $table->text('asn_json')->nullable();
           $table->enum("expediting_request",['no','new','approved','rejected','delivered','not_delivered'])->default('no');
           $table->text('expediting_json')->nullable();
           $table->string("unique_hash")->nullable();
           $table->string("supplier_comment")->nullable();
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
        Schema::dropIfExists('po_sap_masters');
    }
}
