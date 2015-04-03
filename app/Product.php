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

	public function getFinalPriceAttribute() {
		return $this->template->price + $this->price;
	}

	public function setFinalPriceAttribute($price) {
		$this->attributes['price'] = $price - $this->template->price;
	}

	public function newQuery($excludeDeleted = true) {
		
		if(session('store_user')) {
			return parent::newQuery()->where('user_id', '=', session('store_user'));
		}

		return parent::newQuery();
	}
}
