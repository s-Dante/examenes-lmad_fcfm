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
        Schema::create('tbl_examenes', function (Blueprint $table) {
            $table->id();
            $table->enum('tipo', ['parcial_1', 'parcial_2', 'parcial_3', 'parcial_4', 'ordinario', 'extraordinario']);
            $table->dateTime('fecha_hora');
            $table->boolean('estatus')->default(true);
            $table->foreignId('grupo_id')->constrained('tbl_grupos')->onDelete('restrict');
            $table->foreignId('salon_id')->nullable()->constrained('tbl_salones')->onDelete('restrict');
            $table->foreignId('creado_por_id')->constrained('tbl_usuarios')->onDelete('restrict');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_examenes');
    }
};
