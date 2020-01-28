<?php
/**
 * Created for transactions.
 * User: Sergio Martin Marquina
 * Email: smarquina@zenos.es
 * Date: 15/04/2019
 * Time: 10:54
 */

namespace App\Http\Controllers\Api\Transaction;


use App\Emuns\HttpErrors;
use App\Http\Controllers\Api\ApiBaseController;
use App\Http\Managers\Transaction\TransactionManager;
use App\Http\Requests\Transaction\TransactionRequest;
use App\Http\Resources\Transacion\TransactionResource;
use App\Models\Transaction\Transaction;
use App\Models\User\User;
use App\Response\ApiResponse;
use Dingo\Api\Exception\ResourceException;
use Dingo\Api\Exception\ValidationHttpException;

/**
 * Class TransactionController
 * @package App\Http\Controllers\Api\Transaction
 */
class TransactionController extends ApiBaseController
{
    /**
     * @param TransactionRequest $request
     * @return TransactionResource|\Illuminate\Http\JsonResponse
     *
     * @throws \Exception
     * @OA\Post(
     *   path="/api/transaction/create",
     *   summary="Store new transaction",
     *   tags={"transaction"},
     *   operationId="createTransaction",
     *   @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/x-www-form-urlencoded",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="user_to",
     *                     type="required|exists:users,id",
     *                 ),
     *                 @OA\Property(
     *                     property="quantity",
     *                     type="required|numeric|min:0"
     *                 ),
     *                 @OA\Property(
     *                     property="subject",
     *                     type="required|string|max:255"
     *                 ),
     *                 @OA\Property(
     *                     property="comment",
     *                     type="nullable|string|max:1000"
     *                 ),
     *             )
     *         ),
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Transaction data",
     *     @OA\JsonContent(type="array",
     *       @OA\Items(ref="#/components/schemas/Transaction"),
     *     ),
     *   ),
     *   @OA\Response(
     *     response=422,
     *     description="Reqest validarion errors",
     *     @OA\JsonContent(type="object",
     *      @OA\Items(title="message", description="message", type="string"),
     *      @OA\Items(title="errors", description="array with errors", type="array"),
     *      @OA\Items(title="status_code", description="error code", type="integer"),
     *     ),
     *   ),
     *   @OA\Response(
     *     response=550,
     *     description="Cant store data",
     *     ),
     *   ),
     * )
     */
    public function createTransaction(TransactionRequest $request)
    {
        try {
            \DB::beginTransaction();
            /** @var User $user */
            $user = \Auth::user();
            if ($user->amount >= $request->input('quantity')) {

                $transaction = (new TransactionManager())->makeTransaction($user, $request->all());
                \DB::commit();
                return new TransactionResource($transaction);
            } else {
                throw new ValidationHttpException([
                                                      'quantity' => trans('general.transaction.not_enough'),
                                                  ]);
            }
        } catch (ValidationHttpException $exception) {
            throw new ResourceException('422 Unprocessable Entity', $exception->getErrors(), null, [],
                                        HttpErrors::CANT_COMPLETE_VALIDATION);
        } catch (ResourceException $exception) {
            \DB::rollBack();
            \Log::error($exception);
            return ApiResponse::responseWithError(HttpErrors::CANT_COMPLETE_REQUEST, $exception->getMessage(), $exception->getErrors());
        } catch (\Exception $exception) {
            \DB::rollBack();

            \Log::error($exception);
            $msg = config('app.debug') ? $exception->getMessage() : trans('general.transaction.save_error');
            return ApiResponse::responseWithError(HttpErrors::CANT_COMPLETE_REQUEST, $msg);
        }
    }

    /**
     * Get sent transactions.
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Resources\Json\AnonymousResourceCollection
     *
     * @OA\Get(
     *   path="/api/transaction/sent",
     *   summary="Sent transactions",
     *   tags={"transaction"},
     *   operationId="sentTransactions",
     *
     *   @OA\Response(
     *     response=200,
     *     description="A list of my transactions",
     *     @OA\JsonContent(type="array",
     *       @OA\Items(ref="#/components/schemas/Transaction")
     *   ),
     *  )
     * )
     *
     */
    public function sentTransactions()
    {
        try {
            $transactions = Transaction::whereUserFrom(\Auth::id())
                                       ->get();

            return TransactionResource::collection($transactions);
        } catch (\Exception $exception) {
            \Log::error($exception);
            $msg = config('app.debug') ? $exception->getMessage() : trans('general.model.find.error');
            return ApiResponse::responseWithError(HttpErrors::CANT_COMPLETE_REQUEST, $msg);
        }
    }

    /**
     * Get income transactions.
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Resources\Json\AnonymousResourceCollection
     *
     * @OA\Get(
     *   path="/api/transaction/income",
     *   summary="Income transactions",
     *   tags={"transaction"},
     *   operationId="incomeTransactions",
     *
     *   @OA\Response(
     *     response=200,
     *     description="A list of my transactions",
     *     @OA\JsonContent(type="array",
     *       @OA\Items(ref="#/components/schemas/Transaction")
     *   ),
     *  )
     * )
     *
     */
    public function incomeTransactions()
    {
        try {
            $transactions = Transaction::whereUserTo(\Auth::id())
                                       ->get();

            return TransactionResource::collection($transactions);
        } catch (\Exception $exception) {
            \Log::error($exception);
            $msg = config('app.debug') ? $exception->getMessage() : trans('general.model.find.error');
            return ApiResponse::responseWithError(HttpErrors::CANT_COMPLETE_REQUEST, $msg);
        }
    }
}
