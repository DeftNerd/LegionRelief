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
		$user->name = 'Burt McGriddle';
		$user->username = 'burtmc';
		$user->email = 'burt@example.com';
		$user->password = bcrypt('secret');
		$user->is_admin = false;
		$user->save();

		$user = new User();
		$user->name = 'Jason Gilmore';
		$user->username = 'wjgilmore';
		$user->email = 'wj@wjgilmore.com';
		$user->password = bcrypt('secret');
		$user->is_admin = true;
		$user->save();

    }
}
