<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */

/**
 * @param \Faker\Generator $faker
 * @return array
 */
$factory->define(
    App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'email' => $faker->unique()->safeEmail,
        'password' => bcrypt('password'),
        'remember_token' => null,

    ];
});

/**
 * Creates a firm entry into the database
 *
 * @param \Faker\Generator $faker
 * @return array
 */
$factory->define(App\Firm::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->company,
    ];
});

/**
 * Creates an Admin entry into the database
 *
 * @param \Faker\Generator $faker
 * @return array
 */
$factory->define(App\Admin::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'billing_info' => $faker->address,
        'firm_id' => function () {
            return factory(App\Firm::class)->create()->id;
        },
        'user_id' => function() {
            // create user, attach admin role
            $user = factory(App\User::class)->create();
            $user->roles()->attach(2);
            return $user->id;   // set user_id to the id of the user created
        },

    ];
});

/**
 * Creates an Employee entry into the database
 * !!!!!!MAKE SURE TO SET THE FIRM_ID GENERATOR TO A NUMBER BETWEEN THE NUMBER OF FIRMS CREATED!!!!!!!
 * @param \Faker\Generator $faker
 * @return array
 */
$factory->define(App\Employee::class, function (Faker\Generator $faker) {
    return [
        'fname' => $faker->firstName,
        'lname' => $faker->lastName,
        'sin' => $faker->unique()->randomNumber(9),
        'phone_number' => $faker->phoneNumber,
        'address' => $faker->address,
        'wage' => $faker->numberBetween(14, 100),
        'firm_id' => 1,
        'user_id' => function () {
            // create user, attach the employee role
            $user = factory(App\User::class)->create();
            $user->roles()->attach(3);
            return $user->id;   // set user_id to the id of the user created
        },
    ];
});

/**
 * Creates an Supplies entry into the database
 * !!!!!!MAKE SURE TO SET THE FIRM_ID GENERATOR TO A NUMBER BETWEEN THE NUMBER OF FIRMS CREATED!!!!!!!
 * @param \Faker\Generator $faker
 * @return array
 */
$factory->define(App\Supplies::class, function (Faker\Generator $faker) {
    return [
        'type' => $faker->word,
        'total_stock' => $faker->randomNumber(3),
        'cost' => $faker->randomFloat($nbMaxDecimals = 2, $min = 0.01, $max = 999.99),
        'in_stock' => $faker->randomNumber(3),
        'num_ordered' => $faker->randomNumber(3),
        'firm_id' => $faker->numberBetween(1,5),
    ];
});

$factory->define(App\Role::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word,
    ];
});