<?php

use Faker\Generator as Faker;
use App\Model\Product;

$factory->define(App\Model\Detail::class, function (Faker $faker) {
    return [
        'product_id'=>function(){
    		return Product::all()->random();
    	},

        'category'=>$faker->word,
        'brand' => $faker->company,
        'man' => $faker->numberBetween(0,2),
        'color'=> $faker->word
    ];
});
