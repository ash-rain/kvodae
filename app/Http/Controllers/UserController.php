<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use Response;
use File;
use App\User;

class UserController extends Controller {

	public function __construct(Guard $auth)
	{
		$this->middleware('auth');
		$this->auth = $auth;
	}

	public function index()
	{
		$user = $this->auth->user();
		return view('me', compact('user'));
	}

	public function show(User $user)
	{

	}

	public function store(Request $request)
	{
	}

	public function update(User $user, Request $request)
	{
	}

}
