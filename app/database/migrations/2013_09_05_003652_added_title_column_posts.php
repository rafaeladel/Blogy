<?php

use Illuminate\Database\Migrations\Migration;

class AddedTitleColumnPosts extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
                Schema::table('posts', function($table){
                    $table->string('title', 100)->after('author');
                });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
                Schema::table('posts', function($table){
                    $table->dropColumn('title');
                });
	}

}