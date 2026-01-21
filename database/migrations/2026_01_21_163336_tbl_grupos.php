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
        Schema::create('tbl_grupos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->boolean('estatus')->default(true);
            $table->foreignId('materia_id')->constrained('tbl_materias')->onDelete('restrict');
            $table->foreignId('profesor_id')->constrained('tbl_profesores')->onDelete('restrict');
            $table->foreignId('periodo_academico_id')->constrained('tbl_periodos_academicos')->onDelete('restrict');
            $table->unique(['periodo_academico_id', 'materia_id', 'nombre'], 'unique_grupo_periodo_materia');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_grupos');
    }
};
