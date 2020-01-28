<?php
/**
 * Created for transactions.
 * User: Sergio Martin Marquina
 * Email: smarquina@zenos.es
 * Date: 09/04/2019
 * Time: 15:21
 */

namespace App\Response;

use App\Emuns\HttpErrors;

class ApiResponse
{
    /**
     * @param integer $code
     * @param string  $msg
     * @param array   $errors
     * @return \Illuminate\Http\JsonResponse
     */
    public static final function responseWithError(int $code, $msg = null, $errors = null)
    {
        return response()->json(array(
                                    'message'     => $msg ?? HttpErrors::$messages[$code],
                                    'code'        => $code,
                                    'status_code' => $code,
                                    'status'      => HttpErrors::$messages[$code],
                                ), $code);
    }

    /**
     * @param string $msg
     * @return \Illuminate\Http\JsonResponse
     */
    public static final function responseOK($msg = null)
    {
        return response()->json(array(
                                    'message'     => empty($msg) ? 'OK' : $msg,
                                    'status_code' => HttpErrors::HTTP_OK,
                                    'status'      => HttpErrors::$messages[200],
                                ), HttpErrors::HTTP_OK);
    }
}
