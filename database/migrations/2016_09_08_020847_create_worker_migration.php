<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkerMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('key');
            $table->string('first_name');
            $table->string('middle_name');
            $table->string('last_name');
            $table->date('date_of_birth');
            $table->enum('gender', ['m', 'f']);
            $table->string('email');
            $table->string('phone');
            $table->string('type_of_residence');
            $table->string('marital_status');
            $table->string('education');
            $table->string('employment');
            $table->text('address');
            $table->string('lga');
            $table->string('state');
            $table->string('bvn');
            $table->string('account_number');
            $table->string('account_name');
            $table->enum('status', ['pending', 'active','suspend']);
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
        Schema::drop('workers');
    }
}
