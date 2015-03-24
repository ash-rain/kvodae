<?php namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Socialite;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Database\QueryException;
use Redirect;
use App\Services\UserProvider;

class AuthController extends Controller
{

	private function socialite()
	{
		Socialite::extend('microweber', function($app) {
			$config = $app['config']['services.microweber'];
			return Socialite::buildProvider('App\Services\MicroweberProvider', $config);
		});
	}

	function getIndex()
	{
		$this->socialite();
		return Socialite::driver('microweber')->redirect();
	}

	function getCallback() {
		$this->socialite();
        $user = Socialite::driver('microweber')->user();
        $user = UserProvider::findOrCreate($user, 'microweber');
        $this->auth->login($user);
		return Redirect::intended('/');
	}

	function getLogout()
	{
		$this->auth->logout();
		return redirect('/');
	}

	function __construct(Guard $auth)
	{
		$this->auth = $auth;
		$this->middleware('guest', [
			'except' => ['getLogout', 'me']
			]);
	}

}
