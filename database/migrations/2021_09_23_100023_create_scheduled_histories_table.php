<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScheduledHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scheduled_histories', function (Blueprint $table) {
            $table->id();
            $table->string('ticket_number')->unique();
            $table->string('ticket_hash')->unique();
            $table->bigInteger('sender_user_id')->nullable();
            $table->string('sender_user_model')->nullable();
            $table->string('sender_name')->nullable();
            $table->string('sender_email');
            $table->string('sender_role')->nullable();
            $table->string('sender_category')->nullable();
            $table->bigInteger('recipient_user_id')->nullable();
            $table->bigInteger('recipient_user_model')->nullable();
            $table->string('recipient_name')->nullable();
            $table->string('recipient_email');
            $table->string('recipient_role')->nullable();
            $table->string('recipient_category')->nullable();
            $table->bigInteger('scheduler_id')->nullable();
            $table->char('msg_hash', 32)->unique();
            $table->text('msg_headers')->nullable();
            $table->string('msg_message_id')->nullable();
            $table->enum('msg_type',['EMAIL','NOTIFICATION','SMS'])->default('EMAIL');
            $table->string('msg_subject')->nullable();
            $table->string('msg_body')->nullable();
            $table->enum('year_recurrence',['off','on'])->default('off');
            $table->enum('month_recurrence',['on','off'])->default('off');
            $table->enum('day_recurrence',['off','on'])->default('off');
            $table->text('execute_at_date')->nullable();
            $table->date('execute_at_time')->nullable();
            $table->timestamp('last_executed_at')->nullable();
            $table->dateTime('expires_at')->nullable();
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
        Schema::dropIfExists('scheduled_histories');
    }
}
