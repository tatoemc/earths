<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys extends Migration {

	public function up()
	{
		Schema::table('earths', function(Blueprint $table) {
            $table->foreign('square_id')->references('id')->on ('squares')->onUpdate('cascade')->onDelete('cascade');
		});

	}

	public function down()
	{
		Schema::table('earths', function(Blueprint $table) {
			$table->dropForeign('earths_square_id_foreign');
		});
	}
}
