<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketMasterHeadrsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket_master_headrs', function (Blueprint $table) {
            $table->id();
            $table->string('unique_hash');
            $table->string('unique_line')->unique();
            $table->string('message_type')->index();
            $table->string('tender_num')->index();
            $table->string('vendor_num')->index();
            $table->string('vendor_name_en')->nullable()->index();
            $table->string('vendor_name_er')->nullable()->index();
            $table->string('po_num')->index();
            $table->string('customer_name')->index();
            $table->string('cust_code')->index();
            $table->string('po_item_num')->index();
            $table->string('uom')->index();
            $table->string('plant')->index();
            $table->string('ordered_qty')->index();
            $table->string('open_qty')->index();
            $table->string('net_order_value')->index();
            $table->timestamp('delivery_date')->index();
            $table->string('item_desc')->index();
            $table->string('mat_num')->index();
            $table->string('tender_desc')->nullable()->index();
            $table->string('customer_po_no')->nullable()->index();
            $table->string('customer_po_item')->nullable()->index();
            $table->string('importance')->nullable()->default(0)->index();
            $table->string('delivery_address')->nullable()->index();
            $table->enum('line_status',['new','waiting for action', 'closed', 'other'])->default('new');
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
        Schema::dropIfExists('ticket_master_headrs');
    }
}
