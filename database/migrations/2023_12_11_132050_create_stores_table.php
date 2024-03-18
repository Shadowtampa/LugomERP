<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('stores', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('official_name'); // Nome da Loja
            $table->string('alias')->nullable(); // Pseudônimo (Alias) da Loja
            $table->string('address'); // Endereço
            $table->text('description'); // Descrição
            $table->string('contact'); // Contato
            $table->string('owner'); // Proprietário
            $table->string('location')->nullable(); // Localização
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stores');
    }
};
