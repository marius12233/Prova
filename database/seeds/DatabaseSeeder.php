<?php

use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
    	factory(App\User::class,5)->create();
        factory(App\Model\Product::class,50)->create();
        factory(App\Model\Review::class,300)->create();
        factory(App\Model\Detail::class,50)->create();
        factory(App\Model\Tail::class,90)->create();


    }
}
