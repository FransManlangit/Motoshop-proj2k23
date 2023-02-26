<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orderinfo', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id')->unsigned();
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->text('status');
            $table->timestamps();
        });

        Schema::create('orderline', function (Blueprint $table) {
            $table->integer('orderinfo_id')->unsigned();
            $table->foreign('orderinfo_id')->references('id')->on('orderinfo');
            $table->integer('product_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
       
        Schema::dropIfExists('orderinfo');
        Schema::dropIfExists('orderline');
    }
};
