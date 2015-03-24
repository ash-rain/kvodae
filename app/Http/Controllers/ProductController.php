<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Product;
use App\Template;

class ProductController extends Controller {

	public function __construct()
	{
		$this->middleware('auth', ['only' => ['edit', 'update', 'destroy']]);
	}

	public function index()
	{
		$products = Product::all();
		return view('product.index', compact('products'));
	}

	public function create(Request $request)
	{
		$templateId = $request->input('template');
		$template = Template::find($templateId);
		return view('product.create', compact('template'));
	}
	
	public function store(Request $request)
	{
		$input = $request->only(['name', 'price', 'text', 'template_id']);
		$product = new Product;
		$product->fill($input);
		$product->user_id = Auth::user()->id;
		$product->save();
		return redirect(action('ProductController@edit', $product->id));
	}

	public function show(Product $product)
	{
		return view('product.show', compact('product'));
	}
	
	public function edit(product $product)
	{
		return view('product.edit', compact('product'));
	}
	
	public function update(Request $request, Product $product)
	{
		$input = $request->only(['name', 'price', 'text', 'description']);
		$product->fill($input);
		$product->save();
		return redirect(action('ProductController@show', $product->id));
	}

	public function destroy(Product $product)
	{
		$product->delete();
		return redirect(action('ProductController@index'));
	}
}
