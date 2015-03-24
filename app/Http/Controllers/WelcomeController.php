<?php namespace App\Http\Controllers;

use App\Product;

class WelcomeController extends Controller {

	public function __construct()
	{
		$this->middleware('guest');
	}

	public function index()
	{
		$latest = Product::orderBy('created_at', 'desc')->take(4)->get();
		return view('welcome')->with(compact('latest'));
	}

}
