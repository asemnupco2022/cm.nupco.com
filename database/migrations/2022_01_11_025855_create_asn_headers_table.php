<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateAsnHeadersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asn_headers', function (Blueprint $table) {
            $table->id();
            $table->string('unique_line')->index();
            $table->string('asn_id')->index();
            $table->string('plant')->index();
            $table->string('sloc');
            $table->string('vendor_no');
            $table->string('total_pallet_count');
            $table->string('truck_no');
            $table->string('delivery_date');
            $table->string('delivery_time');
            $table->string('asn_status');
            $table->string('nupco_po_no');
            $table->string('nupco_po_item');
            $table->string('nupco_material');
            $table->string('trade_code');
            $table->string('batch_no');
            $table->string('mfg_date');
            $table->string('expiry_date');
            $table->string('is_deleted');
            $table->text('json_data')->nullable();
            $table->enum('status',['new','active', 'deactivated', 'suspended'])->default('active');
            $table->text('suspendReason')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

    $this->createView();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asn_headers');
    }


    private function createView(): string
    {
        return DB::statement("CREATE
        OR REPLACE VIEW asn_master_header AS
        SELECT

        asn_id,
        plant,
        sloc,
        vendor_no,
        total_pallet_count,
        truck_no,
        delivery_date,
        delivery_time,
        asn_status
        FROM asn_headers
        GROUP by

        asn_id,
        plant,
        sloc,
        vendor_no,
        total_pallet_count,
        truck_no,
        delivery_date,
        delivery_time,
        asn_status

        ORDER BY  asn_id DESC;

        ");
    }

}
