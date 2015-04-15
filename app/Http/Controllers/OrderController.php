<?php namespace App\Http\Controllers;

use App\Order;

class OrderController extends Controller {

	public function __construct()
	{
		$this->middleware('auth');
	}

	public function index(Order $order)
	{
		return view('order.index', compact($order->all()));
	}

}
