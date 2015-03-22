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
			$table->float('price')->unsigned();
			$table->boolean('multiline')->nullable();
			$table->string('specs', 200)->nullable();
			$table->string('draw_data', 200)->default('{}');
		});

		Schema::create('products', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->string('description')->nullable();
			$table->float('price')->unsigned()->nullable();
			$table->string('text')->nullable();
			$table->boolean('for_sale')->nullable();
			$table->integer('template_id')->unsigned();
			$table->integer('user_id')->unsigned();
			$table->timestamps();
		});

		Schema::create('images', function(Blueprint $table)
		{
			$table->increments('id');
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
