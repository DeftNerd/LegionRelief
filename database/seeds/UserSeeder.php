<?php

namespace App;

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

		\DB::table('users')->delete();

		$user = new User();
		$user->name = 'Regular User';
		$user->username = 'regularuser';
		$user->email = 'regularuser@legionrelief.com';
		$user->password = bcrypt('password');
		$user->is_admin = false;
		$user->save();

		$user = new User();
		$user->name = 'Adam Brown';
		$user->username = 'deftnerd';
		$user->email = 'adam@deftnerd.com';
		$user->password = bcrypt('password');
		$user->is_admin = true;
		$user->save();

    }
}
