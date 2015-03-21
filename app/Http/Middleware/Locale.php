<?php namespace App\Http\Middleware;

use App;
use Closure;
use Session;

class Locale {

	public function handle($request, Closure $next)
	{
		$locale = Session::get('lang', config('app.default_locale'));
		
		if(!is_null($locale)) {
			App::setLocale($locale);
		}
		
		return $next($request);
	}

}

