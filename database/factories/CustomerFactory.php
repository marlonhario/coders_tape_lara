<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Customer;
use App\Company;
use Faker\Generator as Faker;

$factory->define(Customer::class, function (Faker $faker) {
    return [
		// 'company_id' => factory(Company::class)->create(),
		'company_id' => Company::all()->random()->id,
		'name' => $faker->name,
		'email' => $faker->unique()->safeEmail,
		'active' => rand(0,2),
    ];
});
