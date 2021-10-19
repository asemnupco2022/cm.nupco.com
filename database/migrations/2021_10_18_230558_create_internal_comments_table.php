<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInternalCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('internal_comments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('admin_id');
            $table->string('name');
            $table->string('table_type');
            $table->string('purchasing_doc_no');
            $table->string('line_item_no');
            $table->text('msg_body');
            $table->string('attachment')->nullable();
            $table->bigInteger('reply_id')->nullable();
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
        Schema::dropIfExists('internal_comments');
    }
}
