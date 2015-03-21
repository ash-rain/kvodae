<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use File;

class Image extends Model {

	protected $guarded = ['id'];

	public function imageable() {
		return $this->morphTo();
	}

	public function storageFile() {
		return storage_path('images/' . $this->attributes['id']);
	}

	public function getDataAttribute() {
		if(File::exists($this->storageFile())) {
			return base64_encode(File::get($this->storageFile()));
		}
		return null;
	}
	
	public function setDataAttribute($value) {
		return file_put_contents($this->storageFile(), base64_decode($value));
	}

}