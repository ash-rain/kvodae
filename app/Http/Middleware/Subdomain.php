<?php namespace App\Http\Middleware;

use Closure;
use Session;
use App\User;

class Subdomain {

	public function handle($request, Closure $next)
	{
		$http_pieces = explode('.', app()->request->server('HTTP_HOST'));

		$subdomain = count($http_pieces) > 2 ? array_shift($http_pieces) : null;
		
		if($subdomain) {
			
			$user = User::whereSubdomain($subdomain)->first();
			
			if($user) {
				Session::put('store_user', $user->id);
			}
		}
		
		return $next($request);
	}

}
