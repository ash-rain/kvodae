<?php namespace App\Http\Controllers;

use Response;
use View;
use App\Product;

class NotificationController extends Controller {

	public function getRss()
	{
		$products = Product::take(3)->get();
		$view = View::make('livetile', compact('products'));
		return Response::make($view, 200, ['Content-type' => 'application/rss+xml; charset=utf-8']);
	}

}