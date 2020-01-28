<?php
/**
 * Created for transactions.
 * User: Sergio Martin Marquina
 * Email: smarquina@zenos.es
 * Date: 15/04/2019
 * Time: 10:48
 */

namespace App\Http\Resources\Transacion;


use App\Models\Transaction\Transaction;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class TransactionResource
 * @package App\Http\Resources\Transacion
 * @OA\Schema(schema="Transaction", type="object")
 */
class TransactionResource extends JsonResource
{

    /**
     * @OA\Property(
     *   property="id",
     *   type="integer"
     * )
     */

    /**
     * @OA\Property(
     *   property="user_from",
     *   ref="#/components/schemas/User",
     * )
     */

    /**
     * @OA\Property(
     *   property="user_to",
     *   ref="#/components/schemas/User",
     * )
     */

    /**
     * @OA\Property(
     *   property="quantity",
     *   type="float"
     * )
     */

    /**
     * @OA\Property(
     *   property="subject",
     *   type="string"
     * )
     */

    /**
     * @OA\Property(
     *   property="description",
     *   type="comment",
     *   nullable=true,
     * )
     */

    /**
     * Transform the resource into an array.
     *
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        /** @var Transaction $transaction */
        $transaction = clone $this;

        return array('id'        => $transaction->id,
                     'user_from' => $transaction->userFrom,
                     'user_to'   => $transaction->userTo,
                     'quantity'  => $transaction->quantity,
                     'subject'   => $transaction->subject,
                     'comment'   => $transaction->comment,
        );
    }
}
