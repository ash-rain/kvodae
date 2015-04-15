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
			$table->text('specs')->nullable();
			$table->integer('vendor_id')->nullable();
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

		Schema::create('orders', function(Blueprint $table)
		{
			$table->increments('id');
			$table->float('total')->unsigned();
			$table->string('payment')->nullable();
			$table->text('shipping_address')->nullable();
			$table->boolean('processed')->nullable();
			$table->boolean('shipped')->nullable();
			$table->string('notes')->nullable();
			$table->integer('user_id')->unsigned();
			$table->timestamps();
		});

		Schema::create('vendors', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->string('phone')->nullable();
			$table->string('address')->nullable();
			$table->text('notes')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('templates');
		Schema::drop('products');
		Schema::drop('images');
		Schema::drop('orders');
		Schema::drop('vendors');
	}

}
