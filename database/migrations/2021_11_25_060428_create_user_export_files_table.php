<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserExportFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_export_files', function (Blueprint $table) {
            $table->id();
            $table->double('admin_id');
            $table->string('model')->nullable();
            $table->string('taable_type')->nullable();
            $table->string('file_name');
            $table->string('file_path');
            $table->enum('status',['read','unread'])->default('unread');
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
        Schema::dropIfExists('user_export_files');
    }
}
