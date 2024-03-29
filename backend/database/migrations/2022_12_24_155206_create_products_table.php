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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_name');
            $table->string('product_description');
            $table->decimal('product_price', 8, 2);
            $table->bigInteger('product_quantity');
            $table->bigInteger('category_id');
            $table->bigInteger('product_stock');
            $table->smallInteger('product_status');
            $table->string('product_slug');
            $table->string('product_code');
            $table->string('product_tags');
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
        Schema::dropIfExists('products');
    }
};
