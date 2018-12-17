<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableNACIMIENTO extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('NACIMIENTO', function (Blueprint $table) {
            
            $table->engine = 'InnoDB';
            $table->increments('acta_nac');
            $table->bigInteger('cui')->unsigned();
            
            $table->bigInteger('cui_padre')->unsigned();
            $table->bigInteger('cui_madre')->unsigned();
            $table->integer('id_muni')->unsigned();
            $table->date('fecha');
            $table->string('direccion_nac',200)->nullable();
            $table->timestamps();

            $table->foreign('cui')
                ->references('cui')->on('PERSONA')
                ->onDelete('cascade');

            $table->foreign('cui_padre')
                ->references('cui')->on('PERSONA')
                ->onDelete('cascade');

            $table->foreign('cui_madre')
                ->references('cui')->on('PERSONA')
                ->onDelete('cascade');

            $table->foreign('id_muni')
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
        Schema::dropIfExists('NACIMIENTO');
    }
}
