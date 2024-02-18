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
        Schema::create('store_user', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            // Foreign key for products table
            $table->foreignId('user_id')->constrained();

            // Foreign key for stores table
            $table->foreignId('store_id')->constrained();

            $table->boolean('favourite')->default(false);

            // Additional columns, if needed
            // $table->string('additional_column');

            // Unique constraint to ensure no duplicate combinations
            $table->unique(['user_id', 'store_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_store');
    }
};
