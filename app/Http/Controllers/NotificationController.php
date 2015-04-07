<?php namespace App\Http\Controllers;

use Response;
use View;
use App\Product;

class NotificationController extends Controller {

	public function getRss()
	{
		$product = Product::take(1)->first();
		$view = View::make('livetile', compact('product'));
		return Response::make($view, 200, ['Content-type' => 'application/rss+xml; charset=utf-8']);
	}

}