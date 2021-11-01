<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHosResponseLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hos_response_logs', function (Blueprint $table) {
            $table->id();
            $table->string('request');
            $table->text('request_type');
            $table->string('brodcast_type');
            $table->string('rs_status');
            $table->string('rs_mesg');
            $table->text('rs_body')->nullable();
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
        Schema::dropIfExists('hos_response_logs');
    }
}
