<?php namespace App\Services;

use Laravel\Socialite\AbstractUser;

class User extends AbstractUser
{
	public $token;

	public function setToken($token)
	{
		$this->token = $token;

		return $this;
	}
}