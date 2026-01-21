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
        Schema::table('tbl_usuarios', function (Blueprint $table) {
            $table->string('nombre')->after('name');
            $table->string('apellido_paterno')->after('nombre');
            $table->string('apellido_materno')->after('apellido_paterno')->nullable();
            $table->string('llave_acceso')->unique()->nullable()->after('password');
            $table->enum('rol', ['admin', 'coordinador', 'academias', 'director'])->default('admin')->index()->after('llave_acceso');
            $table->boolean('estatus')->default(true)->after('rol');
            $table->foreignId('carrera_id')->after('estatus')
                ->nullable()
                ->constrained('tbl_programas_academicos') 
                ->onDelete('restrict');
            $table->softDeletes();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_usuarios', function (Blueprint $table) {
            $table->dropForeign(['carrera_id']);
            $table->dropColumn([
                'nombre', 
                'apellido_paterno', 
                'apellido_materno', 
                'llave_acceso',
                'rol', 
                'estatus',
                'carrera_id',
                'deleted_at'
            ]);
        });
    }
};
