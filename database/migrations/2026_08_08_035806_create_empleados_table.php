<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('empleados', function (Blueprint $table) {
            $table->increments('id_empleado');
            $table->string('codigo', 20)->unique();
            $table->string('nombres', 60);
            $table->string('apellidos', 60);
            $table->string('direccion', 100)->nullable();
            $table->string('telefono', 12)->nullable();
            $table->date('fecha_nacimiento');
            $table->unsignedSmallInteger('id_puesto');
            $table->timestamps();

            $table->foreign('id_puesto')->references('id_puesto')->on('puestos')->cascadeOnUpdate();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('empleados');
    }
};
