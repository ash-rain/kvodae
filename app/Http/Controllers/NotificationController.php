<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use View;
use App\Product;

class NotificationController extends Controller {

	public function getRss(Request $request)
	{
		$products = Product::take(3)->get();
		
		$i = $request->input('id', 1);
		if($i > count($products)) $i = count($products);
		
		$product = $products[$i - 1];
		
		$notifications  = \Auth::check() ? 7 : 0;

		$view = View::make('livetile', compact('product', 'notifications'));

		return Response::make($view, 200, ['Content-type' => 'application/rss+xml; charset=utf-8']);
	}

}