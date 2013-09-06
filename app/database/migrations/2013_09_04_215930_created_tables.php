<?php

use Illuminate\Database\Migrations\Migration;

class CreatedTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('posts', function($table){
                    $table->increments('id');
                    $table->string('author', 50);
                    $table->text('body');
                    $table->timestamps();
                });
                
                Schema::create('comments', function($table){
                    $table->increments('id');
                    $table->integer('post_id')->foreign()->references('id')->on('posts')->onDelete('cascade');
                    $table->text('body');
                    $table->timestamps();
                });
                
                Schema::create('users', function($table){
                    $table->increments('id');
                    $table->string('username', 50);
                    $table->string('password', 100);
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
		Schema::dropIfExists('posts');
                Schema::dropIfExists('comments');
                Schema::dropIfExists('users');
	}

}