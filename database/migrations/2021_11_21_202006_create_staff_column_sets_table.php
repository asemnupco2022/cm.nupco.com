<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffColumnSetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff_column_sets', function (Blueprint $table) {
            $table->id();
            $table->string('unique_line')->unique();
            $table->bigInteger('user_id');
            $table->string('table_type');
            $table->longText('columns')->nullable();
            $table->string('filter_tm1')->nullable();
            $table->string('filter_tm2')->nullable();
            $table->string('make_fav')->nullable();
            $table->text('json_data')->nullable();
            $table->enum('status',['new','active', 'deactivated', 'suspended'])->default('active');
            $table->text('suspendReason')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('staff_column_sets');
    }
}
