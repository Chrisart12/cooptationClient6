<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoricsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historics', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('admin_id')->unsigned();//Fait référence à l'id dans la table users(role admin)
            $table->string('admin_lastname', 60);
            $table->string('admin_firstname', 60);
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')
                                      ->on('users')
                                      ->onDelete('restrict')
                                      ->onUpdate('restrict');
            $table->integer('candidat_id')->unsigned();
            $table->foreign('candidat_id')->references('id')
                                      ->on('candidats')
                                      ->onDelete('restrict')
                                      ->onUpdate('restrict');
            $table->integer('step_id')->unsigned();
            $table->foreign('step_id')->references('id')
                                      ->on('steps')
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
        Schema::drop('historics');
    }
}
