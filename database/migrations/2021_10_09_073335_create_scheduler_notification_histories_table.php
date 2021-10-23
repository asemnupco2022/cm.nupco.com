<?php

use App\Models\LbsUserSearchSet;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulerNotificationHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scheduler_notification_histories', function (Blueprint $table) {
            $table->id();
            $table->enum('broadcast_type',['automation','manual', 'other'])->default('manual');
            $table->string('mail_ticket_number')->unique();
            $table->string('mail_ticket_hash')->unique();
            $table->enum('mail_type',['enquiry-email','expedite-email', 'warning-email','penalty-email'])->default('enquiry-email');
            $table->enum('table_type',[LbsUserSearchSet::TEMPLATE_SAP_LINE_ITEM,LbsUserSearchSet::TEMPLATE_MOWARED_LINE_ITEM])->nullable();
            $table->bigInteger('sender_user_id')->nullable();
            $table->string('sender_user_model')->nullable();
            $table->string('sender_name')->nullable();
            $table->string('sender_email');
            $table->string('sender_role')->nullable();
            $table->string('sender_category')->nullable();
            $table->bigInteger('recipient_user_id')->nullable();
            $table->string('recipient_user_model')->nullable();
            $table->string('recipient_name')->nullable();
            $table->string('recipient_email');
            $table->string('recipient_role')->nullable();
            $table->string('recipient_category')->nullable();
            $table->text('msg_headers')->nullable();
            $table->enum('msg_type',['EMAIL','NOTIFICATION','SMS'])->default('EMAIL');
            $table->string('msg_subject')->nullable();
            $table->text('msg_body')->nullable();
            $table->date('execute_at_date')->nullable();
            $table->time('execute_at_time')->nullable();
            $table->timestamp('last_executed_at')->nullable();
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
        Schema::dropIfExists('notification_histories');
    }
}
