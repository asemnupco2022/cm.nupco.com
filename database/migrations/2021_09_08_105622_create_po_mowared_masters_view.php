<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreatePoMowaredMastersView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement($this->createView());
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement($this->dropView());
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    private function createView(): string
    {
        return
          " CREATE VIEW mowared_views
            AS
              SELECT tender_no,
                     item_code,
                     vendor_number,
                     vendor_name,
                     SUM(pending_qty + total_recived_qty) Ordered_quantity,
                     SUM(pending_qty)                     pending_qty,
                     SUM(total_recived_qty)               total_recived_qty
              FROM   po_mowared_masters
              GROUP  BY item_code
              ORDER  BY item_code DESC;";

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    private function dropView(): string
    {
        return

            "DROP VIEW IF EXISTS `mowared_views`;
            SQL;";
    }
}
