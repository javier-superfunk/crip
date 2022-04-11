<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('referencias_generales', function (Blueprint $table) {
            $table->id();

            $table->string('dominio', 50);
            $table->string('descripcion', 250);
            $table->string('val_minimo', 150)->nullable();
            $table->string('val_maximo', 150)->nullable();
            $table->string('codigo', 150)->nullable();
            $table->string('referencia', 150)->nullable();
            $table->boolean('env_correo', true);

            $table->foreignId('usu_insercion')->constrained(table: 'users');
            $table->foreignId('usu_modificacion')->nullable()->constrained(table: 'users');
            $table->foreignId('usu_eliminacion')->nullable()->constrained(table: 'users');
            
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('referencias_generales');
    }
};
