<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('score');
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
            $table->boolean('is_done');
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
        Schema::drop('accounts');
    }
}
