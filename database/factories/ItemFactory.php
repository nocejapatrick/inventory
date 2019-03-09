<?php

use Faker\Generator as Faker;

$factory->define(App\Item::class, function (Faker $faker) {
    return [
        //
        'item_id'=>$faker->numberBetween($min = 100000, $max = 999999) ,
        'item_name'=>$faker->name,
        'item_stock'=>$faker->randomFloat(10),
        'item_unit'=>$faker->randomElement($array = array ('m','Kg','g','cm','mm','in','ft','yd','l','ml','pcs')),
        'item_classification'=>$faker->randomElement($array = array ('Equipment','Materials')),
        'item_skill'=>$faker->randomElement($array = array ('Electronics','Web Design','Welding'))
    ];
    
});
