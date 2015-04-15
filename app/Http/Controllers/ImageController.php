<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use File;
use Image as Intervention;
use App\Image;

class ImageController extends Controller {

	public function __construct()
	{
		$this->middleware('auth', ['except' => 'show']);
	}

	public function show(Image $image, Request $request)
	{
		$file = storage_path('images/' . $image->id);
		
		if(!is_null($request->input('original'))) {
			$img = Intervention::cache(function($image) use ($file) {
				return Intervention::make($file);
			});
			return $img->response('jpg');
		}

		$img = Intervention::cache(function($image) use ($file) {
			return $image->make($file)->limitColors(8)->fit(600, 400);
		}, 3600, true);
		
		return $img->response('jpg', 60);
	}

	public function store(Request $request)
	{
		$file = $request->file('file');

		if(!is_null($file)) {
			$filePath = $file->getRealPath();
			$data = File::get($filePath);
			$size = getimagesize($filePath);
			$mime = $file->getMimeType();
		}
		else {
			$data = $request->input('data');
			$mime = substr($data, 0, strpos($data, ';'));
			$mime = substr($mime, 5);
			$data = substr($data, 1 + strpos($data, ','));
			$size = base64_decode($data);
			$size = getimagesizefromstring($size);
		}

		$imageableType = $request->input('imageable', 'product');
		$imageableModel = 'App\\' . studly_case($imageableType);
		$imageable = $imageableModel::find($request->input('imageable_id'));

		if($imageableType == 'template') {
			if($size[0] < 400 || $size[1] < 300) {
				throw new \Exception(trans('template.upload_too_small'), 1);
			}
		}

		if(count($imageable->images)) {
			$image = $imageable->images[0];
		}
		else {
			$image = new Image;
		}
		
		$image->type = $mime;
		$image->width = $size[0];
		$image->height = $size[1];
			
		$imageable->images()->save($image);
		
		$image->data  = $data;
		
		return view('image.show', compact('image'));
	}

	public function update(Image $image, Request $request)
	{
		$file = $request->file('file');

		if(!is_null($file)) {
			$filePath = $file->getRealPath();
			$data = base64_encode(File::get($filePath));
			$size = getimagesize($filePath);
			$mime = $file->getMimeType();
		}
		else {
			$data = $request->input('data');
			$mime = substr($data, 0, strpos($data, ';'));
			$mime = substr($mime, 4);
			$data = substr($data, 1 + strpos($data, ','));
			$size = base64_decode($data);
			$size = getimagesizefromstring($size);
		}

		$image->data  = $data;
		$image->type = $mime;
		$image->width = $size[0];
		$image->height = $size[1];
		$image->save();
		return view('image.show', compact('image'));
	}

}
