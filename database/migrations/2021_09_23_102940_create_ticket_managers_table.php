<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketManagersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket_managers', function (Blueprint $table) {
            $table->id();
            $table->string('ticket_number');
            $table->string('ticket_hash');
            $table->bigInteger('staff_user_id');
            $table->string('staff_user_model');
            $table->string('staff_name')->nullable();
            $table->string('staff_email');
            $table->bigInteger('vendor_user_id');
            $table->string('vendor_user_model');
            $table->string('vendor_name')->nullable();
            $table->string('vendor_email');
            $table->enum('msg_sender_id',['staff','vendor']);
            $table->text('msg_body');
            $table->enum('msg_receiver_id',['staff','vendor']);
            $table->timestamp('msg_read_at')->nullable();
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
        Schema::dropIfExists('ticket_managers');
    }
}
