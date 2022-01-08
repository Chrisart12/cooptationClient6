<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('region_id')->unsigned();
            $table->foreign('region_id')->references('id')->on('regions');
            $table->foreign('responsible_id')->unsigned()->references('id')->on('responsibles');
            $table->string('role')->nullable();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('institution');
            $table->string('job');
            $table->string('department');
            $table->string('email')->unique();
            $table->string('token')->unique();
            $table->string('password', 60)->nullable()->default(null);
            $table->rememberToken();
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
        Schema::drop('users');
    }
}
