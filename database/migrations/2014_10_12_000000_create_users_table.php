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
            $table->increments('id');
            $table->integer('scheme_id')->unsigned()->index()->nullable();
            $table->foreign('scheme_id')->references('id')->on('schemes')->onDelete('cascade');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->enum('status', ['pending', 'active','suspend']);
            $table->enum('user', [0, 1]);
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
