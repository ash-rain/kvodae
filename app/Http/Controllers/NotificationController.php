<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use View;
use App\Product;

class NotificationController extends Controller {

	public function getRss(Request $request)
	{
		$products = Product::take(3)->get();
		$i = $request->input('id', 0);
		if($i >= count($products)) $i = count($products) - 1;
		$product = $products[$i];
		$view = View::make('livetile', compact('product'));
		return Response::make($view, 200, ['Content-type' => 'application/rss+xml; charset=utf-8']);
	}

}