<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AddTextIndexToOrdersCollection extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::connection('mongodb')
            ->getCollection('orders')  
            ->createIndex([
                'items.product_name' => 'text',
                'shipping_address.city' => 'text',
            ], ['name' => 'order_text_search']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::connection('mongodb')
            ->getMongoDB()
            ->orders
            ->dropIndex('order_text_search');
    }
}
