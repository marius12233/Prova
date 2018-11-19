<?php

use Faker\Generator as Faker;
use App\Model\Product;
use App\User;


$factory->define(App\Model\Review::class, function (Faker $faker) {
    return [
    	'product_id'=>function(){
    		return Product::all()->random();
    	},

    	'user_id'=>function(){
    		return User::all()->random();
    	},

        'customer'=>$faker->name,
        'review' => $faker->paragraph,
        'star' => $faker->numberBetween(0,5)
    ];
});
