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
        Schema::create('discounts', function (Blueprint $table) {
            $table->id();
            $table->string('discount_name');
            $table->string('discount_description');
            $table->string('target_column');
            $table->string('target_condition');
            $table->string('target_value');
            $table->decimal('discount_amount', 8, 2);
            $table->boolean('discount_type');
            $table->boolean('discount_status');
            $table->date('discount_start_date');
            $table->date('discount_end_date');
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
        Schema::dropIfExists('discounts');
    }
};
