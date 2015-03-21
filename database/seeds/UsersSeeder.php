<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersSeeder extends Seeder {

    public function run() {
        \DB::table('users')->truncate();
        $user = new User(['name' => 'Ash', 'email' => 'ash@rain.com', 'password' => 'dadada']);
        $user->save();
    }

}