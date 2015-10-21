<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(App\CategorySeeder::class);
        $this->call(App\UserSeeder::class);
        $this->call(App\LegionnaireSeeder::class);

        Model::reguard();
    }
}
