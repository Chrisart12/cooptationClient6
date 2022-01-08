<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCandidatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidats', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('lastName', 60);
            $table->string('firstName', 60);
            $table->string('poste', 255);
            $table->string('reference', 255);
            $table->integer('offre_id')->unsigned();
            $table->foreign('offre_id')->references('id')
                                      ->on('offres')
                                      ->onDelete('restrict')
                                      ->onUpdate('restrict');
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
        Schema::drop('candidats');
    }
}
