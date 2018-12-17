<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDPI extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('DPI', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id_dpi');
            $table->bigInteger('cui_persona')->unsigned();
            $table->date('fecha_vence');
            $table->timestamps();

            $table->foreign('cui_persona')
                ->references('cui')->on('PERSONA')
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
        Schema::dropIfExists('DPI');
    }
}
