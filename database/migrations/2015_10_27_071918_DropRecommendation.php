<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropRecommendation extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::drop('recommendations');
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::create('recommendations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('category');
            $table->text('body');
            $table->string('author');
            $table->timestamps();
            $table->softDeletes();
        });
	}

}
