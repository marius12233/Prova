<?php
use App\User;
use Faker\Generator as Faker;
$factory->define(App\Model\Product::class, function (Faker $faker) {
    return [
        'name'=>$faker->word,
        'detail'=>$faker->paragraph,
        'price' =>$faker->numberBetween(0,1000),
        'stock' =>$faker->randomDigit,
        'discount' => $faker->numberBetween(2,30),
        'user_id' => function(){
        	return App\User::all()->random();
        },
    ];
});
