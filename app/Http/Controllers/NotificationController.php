<?php namespace App\Http\Controllers;

use App\Product;

class NotificationController {

	public function getRss()
	{
		$product = Product::take(1)->get();
		return view('livetile', compact('product'));
	}

}