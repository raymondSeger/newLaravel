<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// Raymond. User model
        Schema::create('users', function($table){
            $table->bigIncrements('id')->unsigned();
            $table->string('username');
            $table->string('name');
            $table->string('email');
            $table->string('password');
            $table->date('birthday');
            $table->text('validate_user'); // When they register, they will receive an email link
            $table->enum('user_status', ['available', 'banned']);
            $table->timestamps();
            $table->rememberToken();
            $table->softDeletes();
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('users');
	}

}
