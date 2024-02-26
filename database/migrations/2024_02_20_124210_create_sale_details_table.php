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
        Schema::create('sale_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sale_id');
            $table->integer('trigger')->nullable();
            $table->integer('negative')->nullable();
            $table->unsignedBigInteger('product_price_id')->nullable();
            $table->unsignedBigInteger('trigger_id')->nullable();
            $table->unsignedBigInteger('negative_id')->nullable();

            $table->timestamps();

            // Chaves estrangeiras
            $table->foreign('sale_id')->references('id')->on('sales')->onDelete('cascade');
            $table->foreign('trigger_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('negative_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('product_price_id')->references('id')->on('product_prices')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sale_details');
    }
};
