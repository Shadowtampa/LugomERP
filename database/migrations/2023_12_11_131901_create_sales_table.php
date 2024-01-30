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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('price_product_id');
            $table->enum('model', ['PP', 'PXLY']);
            $table->integer('trigger');
            $table->integer('negative');
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('price_product_id')->references('id')->on('product_prices');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
