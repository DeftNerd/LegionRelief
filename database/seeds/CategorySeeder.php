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
		 
			['name' => 'Logging'],
			['name' => 'Eloquent'],
			['name' => 'Debugging'],
			['name' => 'Templates'],
			['name' => 'Blade'],
			['name' => 'CSS'],
			['name' => 'JavaScript'],
			['name' => 'Database'],
			['name' => 'Homestead'],
			['name' => 'Testing'],
			['name' => 'Deployment'],
			['name' => 'Relationships'],
			['name' => 'Forms'],
			['name' => 'Routing'],
			['name' => 'Performance'],
			['name' => 'Mail'],
			['name' => 'Authentication'],
			['name' => 'Queues'],
			['name' => 'Localization'],
			['name' => 'Elixir'],
			['name' => 'Views']

		]);

    }
}
