<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use File;
use Response;
use Image as Intervention;
use App\Image;
use App\Product;

class ImageController extends Controller {

	public function __construct()
	{
		$this->middleware('auth', ['except' => 'show']);
	}

	public function show(Image $image, Request $request)
	{
		$file = storage_path('images/' . $image->id);
		
		if(!is_null($request->input('original'))) {
			return Intervention::make($file)->response('jpg');
		}

		$img = Intervention::cache(function($intervention) use ($file) {
			return $intervention->make($file);
		}, 3600, true);
		
		return $img->response('jpg', 60);
	}

	public function store(Request $request)
	{
		$imageableType = $request->input('imageable', 'product');
		$imageableModel = 'App\\' . studly_case($imageableType);
		$imageable = $imageableModel::find($request->input('imageable_id'));

		if(count($imageable->images)) {
			$image = $imageable->images[0];
		}
		else {
			$image = new Image;
		}
		return $this->update($image, $request);
	}

	public function update(Image $image, Request $request)
	{
		if(!isset($image->id)) {
			$image->save();
		}

		$file = $request->file('file');
		$storagePath = storage_path("images/$image->id");

		$source = !is_null($file) ? $file : $request->input('data');
		if(!is_null($file)) {
			$file->move(storage_path('images'), $image->id);
			$source = $storagePath;
		}
		$img = Intervention::make($source);
		
		$imageableType = $request->input('imageable', 'product');
		$imageableModel = 'App\\' . studly_case($imageableType);
		$imageable = $imageableModel::find($request->input('imageable_id'));

		if($imageableType == 'template' && $img->width() < 700) {
			$img->resize(700, null, function ($constraint) {
				$constraint->aspectRatio();
			});
		}
		
		$image->type = $img->mime();
		$image->width = $img->width();
		$image->height = $img->height();
		$image->save();

		$imageable->images()->save($image);
		
		$img->save($storagePath);

		if($image) {
			return view('image.show', compact('image'));
		}

		return 'error';
	}

}
