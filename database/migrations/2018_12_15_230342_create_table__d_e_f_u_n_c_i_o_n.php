<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDEFUNCION extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('DEFUNCION', function (Blueprint $table) {

            /* corregidos */
            $table->engine = 'InnoDB';
            $table->increments('no_acta');
            $table->bigInteger('cui_difunto')->unsigned();
            $table->bigInteger('cui_compareciente')->unsigned();
            $table->integer('muni_defuncion')->unsigned();
            $table->string('direccion_defuncion',200)->nullable();
            $table->datetime('fecha_hora');
            $table->string('causa',200)->nullable();
            $table->timestamps();

            $table->foreign('cui_difunto')
                ->references('cui')->on('PERSONA')
                ->onDelete('cascade');

            $table->foreign('cui_compareciente')
                ->references('cui')->on('PERSONA')
                ->onDelete('cascade');

            $table->foreign('muni_defuncion')
                ->references('id_muni')->on('MUNICIPIO')
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
        Schema::dropIfExists('DEFUNCION');
    }
}
