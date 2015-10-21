<?php

namespace App;

use Illuminate\Database\Seeder;
use App\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

		\DB::table('categories')->delete();

		\DB::table('categories')->insert([
		 
			['name' => 'Script Kiddie'],
			['name' => 'Troll'],
			['name' => 'Swatter'],
			['name' => 'Hacktavist'],
			['name' => 'Journalist'],
			['name' => 'Researcher'],
			['name' => 'Pirate'],
			['name' => 'Tor'],
			['name' => 'Hacker'],
			['name' => 'Pen-tester'],
			['name' => 'Carder'],
			['name' => 'Developer'],
			['name' => 'Botnet']

		]);

    }
}
