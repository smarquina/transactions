<?php
/**
 * Created for transactions.
 * User: Sergio Martin Marquina
 * Email: smarquina@zenos.es
 * Date: 15/04/2019
 * Time: 2:40
 */

namespace App\Http\Controllers\Admin\User;


use App\Http\Controllers\Controller;
use App\Models\User\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = User::select(["id",
                                   "name",
                                   "email",
                                   "amount",
                                  ])
                         ->orderBy("id", "DESC")
                         ->get();

            return DataTables::collection($query)
                             ->setRowId('id')
                             ->make(true);

        } else return view('user.list');
    }
}
