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
            $table->string('mail_unique');
            $table->string('mail_hash');
            $table->string('message_type');
            $table->string('unique_hash');
            $table->string('tender_num');
            $table->string('vendor_num');
            $table->string('po_num');
            $table->string('customer_name');
            $table->string('cust_code');
            $table->string('po_item_num');
            $table->string('uom');
            $table->string('plant');
            $table->string('ordered_qty');
            $table->string('open_qty');
            $table->string('net_order_value');
            $table->timestamp('delivery_date');
            $table->string('item_desc');
            $table->string('mat_num');
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
