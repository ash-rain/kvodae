<?php namespace App\Http\Controllers;

use Auth;
use App\Product;

class HomeController extends Controller {

	public function index()
	{
		if(Auth::user()->isAdmin) {
			return redirect(action('Admin\VendorController@index'));
		}

		return redirect(action('TemplateController@index'));
	}

	public function welcome()
	{
		$latest = Product::orderBy('created_at', 'desc')->take(4)->get();
		
		return view('welcome')->with(compact('latest'));
	}

}
