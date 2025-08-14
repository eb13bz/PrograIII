<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void
    {
      Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo_unico')->unique(); 
            $table->string('nombre');
            $table->decimal('precio_unitario', 8, 2)->unsigned(); 
            $table->integer('stock_actual')->unsigned(); 

            $table->foreignId('id_categoria')
                  ->constrained('categorias') 
                  ->onDelete('cascade'); 

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
