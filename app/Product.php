<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model {

	protected $guarded = ['id'];

	public function template() {
		return $this->belongsTo('App\Template');
	}

	public function images() {
		return $this->morphMany('App\Image', 'imageable');
	}

}
