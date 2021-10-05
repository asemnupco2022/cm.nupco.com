<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreatePoSapMastersView extends Migration
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


    private function createView(): string
    {
        return
          "

                CREATE OR replace VIEW sap_views
                AS
              SELECT tender_no,
                     purchasing_document,
                     customer_name,
                     vendor_code,
                     vendor_name,
                     SUM(ordered_quantity)                 Ordered_quantity,
                     SUM(open_quantity)                    pending_qty,
                     SUM(ordered_quantity - open_quantity) total_recived_qty,
                     SUM(net_order_value)                  order_total
              FROM   po_sap_masters
              GROUP  BY purchasing_document
              ORDER  BY purchasing_document;";
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    private function dropView(): string
    {
        return
           " DROP VIEW IF EXISTS `sap_views`;
            SQL;";
    }
}
