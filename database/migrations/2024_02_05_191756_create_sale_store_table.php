<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sale_store', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            // Foreign key for products table
            $table->foreignId('sale_id')->constrained();

            // Foreign key for stores table
            $table->foreignId('store_id')->constrained();

            // Additional columns, if needed
            // $table->string('additional_column');

            // Unique constraint to ensure no duplicate combinations
            $table->unique(['sale_id', 'store_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sale_store');
    }
};
