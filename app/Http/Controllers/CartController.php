<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;
use Session;
use App\Product;

class CartController extends Controller {

	public function index()
	{
		$cart = Cart::getContent();
		
		if(count($cart)) {
			foreach ($cart as $item) {
				$item['product'] = Product::find($item['id']);
			}
		}

		return view('cart', compact('cart'));
	}

	public function store(Request $request)
	{
		$id = $request->input('id');
		$product = Product::find($id);
		Cart::add($id, $product->name, $product->finalPrice, 1);
	}
	
	public function update($id, Request $request)
	{
		$quantity = $request->input('quantity');
		Cart::update($id, array('quantity' => $quantity));
	}

	public function destroy($id)
	{
		Cart::remove($id);
	}
}