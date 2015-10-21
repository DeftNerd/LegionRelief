<?php

namespace App;

use Illuminate\Database\Seeder;

use App\Legionnaire;
use App\User;
use App\Category;

class LegionnaireSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

		\DB::table('legionnaires')->delete();

    	$legionnaire = new Legionnaire();
    	$legionnaire->name = 'Test Name';
	$legionnaire->handle = 'Nickname';
        $legionnaire->oneline = 'Test Legionnaire listing';
    	$legionnaire->description = <<<END
This person did something. Blah Blah
END;
	$legionnaire->user_id = User::whereUsername('deftnerd')->first()->id;
	$legionnaire->save();
	$categories = [];
	$categories[] = Category::whereName('Pirate')->first();
	$categories[] = Category::whereName('Developer')->first();
        $legionnaire->categories()->saveMany($categories);



    }
}
