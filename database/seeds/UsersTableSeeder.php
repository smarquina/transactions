<?php

use Illuminate\Database\Seeder;
use App\Models\User\User;
use App\Models\Transaction\Transaction;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class)->make([
                                       'name'     => 'Admin',
                                       'email'    => 'admin@zenos.es',
                                       'password' => bcrypt('admin'),
                                   ])->save();

        factory(User::class, 10)->create()->each(function (User $user) {
            $user->sentTransactions()
                 ->save(factory(Transaction::class)
                            ->make([
                                       'user_to'  => User::inRandomOrder()->where('id', '<>', $user->id)->first()->id,
                                       'quantity' => random_int(1, $user->amount),
                                   ]));
        });
    }
}
