<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::connection('mongodb')->collection('orders')->raw(function ($collection) {
            return $collection->updateMany(
                ['items' => ['$type' => 'string']], // Find only documents where items is a string
                [
                    ['$set' => [
                        'items' => ['$jsonParse' => '$items'],
                        'shipping_address' => ['$jsonParse' => '$shipping_address'],
                        'total_amount' => ['$toDecimal' => '$total_amount']
                    ]]
                ]
            );
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
