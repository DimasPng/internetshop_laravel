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
        Schema::create('product_product_characteristics', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('product_characteristic_id');

            $table->index('product_id', 'product_product_characteristics_product_idx');
            $table->index('product_characteristic_id', 'product_product_characteristics_product_characteristic_idx');

            $table->foreign('product_id', 'product_product_characteristics_product_fk')->on('products')->references('id');
            $table->foreign('product_characteristic_id', 'product_product_characteristics_product_characteristic_fk')->on('product_characteristics')->references('id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_product_characteristics');
    }
};
