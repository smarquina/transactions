<?php
/**
 * Created for transactions.
 * User: Sergio Martin Marquina
 * Email: smarquina@zenos.es
 * Date: 15/04/2019
 * Time: 10:17
 */

namespace App\Http\Controllers\Admin\Transaction;


use App\Http\Controllers\Controller;
use App\Models\Transaction\Transaction;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Transaction::select(["transaction.id",
                                          "userFrom.name as user_from_name",
                                          "userTo.name as user_to_name",
                                          'transaction.quantity',
                                          'transaction.subject',
                                         ])
                                ->leftJoin('users as userFrom', 'transaction.user_from', 'userFrom.id')
                                ->leftJoin('users as userTo', 'transaction.user_to', 'userTo.id')
                                ->orderBy("id", "DESC")
                                ->get();

            return DataTables::collection($query)
                             ->setRowId('id')
                             ->make(true);

        } else return view('transaction.list');
    }

    public function show(Transaction $transaction)
    {
        return view('transaction.list', compact('transaction'));
    }
}
