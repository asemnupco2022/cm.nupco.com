<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHosPostHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hos_post_histories', function (Blueprint $table) {
            $table->id();
            $table->string('mail_unique')->index();
            $table->string('mail_hash')->index();
            $table->string('message_type')->index();
            $table->string('unique_hash')->unique();
            $table->string('tender_num')->index();
            $table->string('vendor_num')->index();
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
            $table->string('importance')->nullable()->index();
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
        Schema::dropIfExists('hos_post_histories');
    }
}
