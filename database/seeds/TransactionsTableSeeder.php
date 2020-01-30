<?php

use Illuminate\Database\Seeder;
use App\Models\Transaction\Transaction;
use App\Models\User\User;

class TransactionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Transaction::class, 50)->create();
//        ->each(function (Transaction $transaction) {});
    }
}
