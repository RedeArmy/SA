<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDEPARTAMENTO extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('DEPARTAMENTO', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id_dpto');
            $table->string('nombre_dpto','100');
            $table->integer('id_pais')->unsigned();
            $table->timestamps();

            $table->foreign('id_pais')
                ->references('id_pais')->on('PAIS')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('DEPARTAMENTO');
    }
}
