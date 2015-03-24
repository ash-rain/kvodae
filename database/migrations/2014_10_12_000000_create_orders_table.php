<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration {

	public function up()
	{
		Schema::create('orders', function(Blueprint $table)
		{
			$table->increments('id');
			$table->float('total')->unsigned();
			$table->string('payment')->nullable();
			$table->integer('user_id')->unsigned();
			$table->boolean('processed')->nullable();
			$table->boolean('shipped')->nullable();
			$table->string('notes')->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('orders');
	}

}
