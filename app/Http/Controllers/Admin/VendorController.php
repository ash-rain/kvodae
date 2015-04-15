<?php namespace App\Http\Controllers\Admin;

use Request;
use App\Vendor;
use App\Http\Controllers\Controller;

class VendorController extends Controller {

	function __construct(Vendor $vendor)
	{
		$this->vendor = $vendor;
	}

	public function index()
	{
		$vendors = $this->vendor->all();
		return view('admin.vendor.index', compact('vendors'));
	}

	public function create()
	{
		$vendor = $this->vendor;
		return view('admin.vendor.form', compact('vendor'));
	}

	public function store()
	{
		$input = Request::only(['name', 'phone', 'address', 'notes']);
		$this->vendor->fill($input);
		$this->vendor->save();
		return redirect(action('Admin\VendorController@index'));
	}

	public function edit(Vendor $vendor)
	{
		return view('admin.vendor.form', compact('vendor'));
	}
	
	public function update(Vendor $vendor)
	{
		$input = Request::only(['name', 'phone', 'address', 'notes']);
		$vendor->fill($input);
		$vendor->save();
		return redirect(action('Admin\VendorController@index'));
	}
}
