<?php

use Faker\Generator as Faker;
use App\Model\Product;


$factory->define(App\Model\Tail::class, function (Faker $faker) {
    return [
        'product_id'=>function(){
    		return Product::all()->random();
    	},

        'tail'=>$faker->word,
        'quantity' => $faker->numberBetween(0,2),
    ];
});
