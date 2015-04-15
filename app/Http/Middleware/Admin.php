<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class Admin {

	protected $auth;

	public function __construct(Guard $auth)
	{
		$this->auth = $auth;
	}

	public function handle($request, Closure $next)
	{
		if (!$this->auth->check() || !$this->auth->user()->isAdmin)
		{
			if ($request->ajax()) {
				return response('Unauthorized.', 401);
			}
			else {
				return redirect('/');
			}
		}

		return $next($request);
	}

}
