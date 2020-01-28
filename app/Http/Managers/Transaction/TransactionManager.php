<?php
/**
 * Created for transactions.
 * User: Sergio Martin Marquina
 * Email: smarquina@zenos.es
 * Date: 20/01/2020
 * Time: 20:15
 */

namespace App\Http\Managers\Transaction;


use App\Models\Transaction\Transaction;
use App\Models\User\User;

class TransactionManager
{
    /**
     * Save new transaction
     * @param User  $userFrom
     * @param array $transactionData
     * @return Transaction
     */
    function makeTransaction(User $userFrom,array $transactionData): Transaction
    {
        $transaction            = new Transaction($transactionData);
        $transaction->user_from = $userFrom->id;
        $transaction->save();

        $userFrom->amount -= $transaction->quantity;
        $userFrom->save();

        $userTo         = $transaction->userTo;
        $userTo->amount += $transaction->quantity;
        $userTo->save();

        return $transaction;
    }
}
