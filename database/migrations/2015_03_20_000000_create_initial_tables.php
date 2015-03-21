<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInitialTables extends Migration {

	public function up()
	{
		Schema::create('templates', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->float('price');
			$table->string('draw_data', 200)->default('{}');
		});

		Schema::create('products', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->float('price')->nullable();
			$table->string('text')->nullable();
			$table->integer('template_id')->unsigned();
			$table->timestamps();
		});

		Schema::create('images', function(Blueprint $table)
		{
			$table->increments('id');
			$table->binary('data');
			$table->smallInteger('width');
			$table->smallInteger('height');
			$table->string('type');
			$table->integer('imageable_id');
			$table->string('imageable_type');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('templates');
		Schema::drop('products');
		Schema::drop('images');
	}

}
