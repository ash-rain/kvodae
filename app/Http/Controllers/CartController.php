<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Product;

class CartController extends Controller {

	public function index()
	{
		return Session::get('cart', []);
	}

	public function store(Request $request)
	{
		$input = $request->only(['product_id', 'quantity']);
		Session::push('cart', $input);
	}
	
	public function update(Request $request)
	{
		$input = $request->only(['product_id', 'quantity']);
		$cart = Session::get('cart');
		foreach ($cart as $key => $value) {
			
		}
	}
}
\