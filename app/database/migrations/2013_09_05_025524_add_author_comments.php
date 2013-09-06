<?php

use Illuminate\Database\Migrations\Migration;

class AddAuthorComments extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
                Schema::table('comments', function($table){
                    $table->string('author', 30)->after('post_id');
                });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('comments', function($table){
                    $table->dropColumn('author');
                });
	}

}