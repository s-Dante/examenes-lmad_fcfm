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
        Schema::create('tbl_materias_por_planes_academicos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('plan_academico_id')->constrained('tbl_planes_academicos')->onDelete('cascade');
            $table->foreignId('materia_id')->constrained('tbl_materias')->onDelete('restrict');
            $table->unique(['plan_academico_id', 'materia_id'], 'unique_materia_plan_academico');
            $table->integer('semestre');
            $table->integer('creditos');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_materias_por_planes_academicos');
    }
};
