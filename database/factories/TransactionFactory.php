<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Transaction\Transaction;
use Faker\Generator as Faker;
use App\Models\User\User;

$factory->define(Transaction::class, function (Faker $faker) {
    $users = User::inRandomOrder()->limit(2)->get();
    /** @var User $userFrom */
    $userFrom = $users->first();
    /** @var User $userTo */
    $userTo = $users->last();

    return [
        'subject'   => $faker->text(random_int(5, 50)),
        'quantity'  => random_int(1, $userFrom->amount),
        'comment'   => random_int(0, 1) ? $faker->realText(random_int(10, 100)) : null,
        'user_from' => $userFrom->id,
        'user_to'   => $userTo->id,
    ];
});
