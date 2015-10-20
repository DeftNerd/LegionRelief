<?php

namespace App;

use Illuminate\Database\Seeder;

use App\Tip;
use App\User;
use App\Category;

class TipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

		\DB::table('tips')->delete();

    	$tip = new Tip();
    	$tip->name = 'Debugging output with Laravel Debugbar';
        $tip->oneline = 'Easily view log messages in the browser alongside your web application.';
    	$tip->description = <<<TIP
The [Laravel Debugbar](https://github.com/barryvdh/laravel-debugbar) 
is an indispensable tool for debugging Laravel applications. You can
send log messages directly to the `Messages` tab in the Debugbar
interface using the following syntax:

    \Debugbar::info("Some log message");
TIP;
		$tip->user_id = User::whereUsername('wjgilmore')->first()->id;
		$tip->save();
		$categories = [];
		$categories[] = Category::whereName('Logging')->first();
		$categories[] = Category::whereName('Debugging')->first();
        $tip->categories()->saveMany($categories);



    }
}
