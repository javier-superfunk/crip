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
        Schema::create('proveedores', function (Blueprint $table) {
            $table->id();
            
            $table->string('nombre', 50);
            $table->string('descripcion', 500);
            $table->string('email')->unique();
            $table->boolean('activo');

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
        Schema::dropIfExists('proveedores');
    }
};
