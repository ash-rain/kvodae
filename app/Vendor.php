<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model {

	public $timestamps = false;
	
	protected $guarded = ['id'];

	public function templates() {
		return $this->hasMany('App\Template');
	}

}
