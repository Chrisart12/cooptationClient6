<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOffresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offres', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('poste', 255);
            $table->string('lieu');
            $table->string('reference', 255);
            $table->string('description');
            $table->integer('categorie_id')->unsigned();
            $table->foreign('categorie_id')->references('id')
                                       ->on('categories')
                                       ->onDelete('restrict')
                                       ->onUpdate('restrict');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')
                                           ->on('users')
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
        Schema::drop('offres');
    }
}
