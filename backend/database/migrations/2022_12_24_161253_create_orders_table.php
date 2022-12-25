<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_code');
            $table->string('order_status');
            $table->string('order_total');
            $table->string('order_date');
            $table->string('order_user');
            $table->string('order_address');
            $table->string('order_phone');
            $table->string('order_email');
            $table->string('order_note');
            $table->string('order_payment_status');
            $table->string('order_payment_amount');
            $table->string('order_payment_method');
            $table->string('order_shipping_status');
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
        Schema::dropIfExists('orders');
    }
};
