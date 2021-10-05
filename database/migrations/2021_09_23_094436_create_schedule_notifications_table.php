<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScheduleNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedule_notifications', function (Blueprint $table) {
            $table->id();
            $table->enum('scheduler_type',['po_notifier','promotional'])->default('po_notifier');
            $table->string('subject');
            $table->bigInteger('user_id');
            $table->string('user_model');
            $table->string('table_type');
            $table->string('table_model');
            $table->bigInteger('filter_id')->nullable();
            $table->string('notifi_type')->nullable();
            $table->bigInteger('notifi_template_id')->nullable();
            $table->string('notifi_template_name')->nullable();
            $table->bigInteger('attempts')->default(0);
            $table->enum('year_recurrence',['off','on'])->default('off');
            $table->enum('month_recurrence',['off','on'])->default('off');
            $table->enum('day_recurrence',['off','on'])->default('off');
            $table->string('recurrent_days')->nullable();
            $table->date('execute_at_date')->nullable();
            $table->time('execute_at_time')->nullable();
            $table->timestamp('last_executed_at')->nullable();
            $table->dateTime('expires_at')->nullable();
            $table->string('option')->nullable();
            $table->text('meta')->nullable();
            $table->text('json_data')->nullable();
            $table->enum('schedule_status',['hold','await', 'complete', 'recurrence'])->default('await');
            $table->text('suspendReason')->nullable();
            $table->enum('status',['new','active', 'deactivated', 'suspended'])->default('active');
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
        Schema::dropIfExists('schedule_notifications');
    }
}
