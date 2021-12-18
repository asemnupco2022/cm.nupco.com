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
           $table->string("document_type")->nullable()->index();
           $table->string("document_type_desc")->nullable()->index();
           $table->bigInteger("po_number")->nullable()->index();
           $table->bigInteger("po_item")->nullable()->index();
           $table->bigInteger("material_number")->nullable()->index();
           $table->string("mat_description")->nullable()->index();
           $table->date("po_created_on")->nullable()->index();
           $table->bigInteger("purchasing_organization")->nullable()->index();
           $table->bigInteger("purchasing_group")->nullable()->index();
           $table->string("currency")->nullable()->index();
           $table->bigInteger("customer_no")->nullable()->index();
           $table->string("customer_name")->nullable()->index();
           $table->string("tender_no")->nullable()->index();
           $table->string("tender_desc")->nullable()->index();
           $table->string("vendor_code")->nullable()->index();
           $table->string("vendor_name_en")->nullable()->index();
           $table->string("vendor_name_er")->nullable()->index();
           $table->string("plant")->nullable()->index();
           $table->string("storage_location")->nullable()->index();
           $table->string("uo_m")->nullable()->index();
           $table->string("net_price")->nullable()->index();
           $table->string("price_unit")->nullable()->index();
           $table->string("net_value")->nullable()->index();
           $table->string("nupco_trade_code")->nullable()->index();
           $table->date("nupco_delivery_date")->nullable()->index();
           $table->string("ordered_quantity")->nullable()->index();
           $table->string("open_quantity")->nullable()->index();
           $table->string("item_status")->nullable()->index();
           $table->string("delivery_address")->nullable()->index();
           $table->string("delivery_no")->nullable()->index();
           $table->string("cust_cont_trade_numb")->nullable()->index();
           $table->bigInteger("cust_gen_code")->nullable()->index();
           $table->bigInteger("generic_mat_code")->nullable()->index();
           $table->string("old_new_po_number")->nullable()->index();
           $table->bigInteger("old_po_item")->nullable()->index();
           $table->string("gr_quantity")->nullable()->index();
           $table->string("gr_amount")->nullable()->index();
           $table->string("customer_po_no")->nullable()->index();
           $table->string("customer_po_item")->nullable()->index();
           $table->string("pur_grp_name")->nullable()->index();
           $table->float("supply_ratio")->nullable()->index();
           $table->string("unique_line")->unique()->index();
           $table->string("unique_line_date")->unique()->index();
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
