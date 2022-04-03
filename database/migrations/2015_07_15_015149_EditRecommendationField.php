<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditRecommendationField extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('recommendations', function($table)
		{
			$table->integer('user_id')->after('id');
			$table->string('img')->after('body');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('recommendations', function($table)
		{
		    $table->dropColumn('user_id');
		    $table->dropColumn('img');
		});
	}

}
