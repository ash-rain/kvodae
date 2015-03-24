<?php namespace App\Services;

use App\User as AppUser;

class UserProvider
{
	static function findOrCreate(User $payload, $provider)
	{
		$user = AppUser::find($payload->id);
		if(is_null($user)) {
			$user = new AppUser([
				'mw_id' => $payload->id,
				'email' => $payload->email,
				'token' => $payload->token,
				'data_raw' => json_encode($payload->user),
				'name' => $payload->name,
				'avatar' => $payload->avatar
			]);
			$user->save();
		}
		return $user;
	}
}
