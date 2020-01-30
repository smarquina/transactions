<?php
/**
 * Created for transactions.
 * User: Sergio Martin Marquina
 * Email: smarquina@zenos.es
 * Date: 15/04/2019
 * Time: 10:42
 */

namespace App\Http\Resources\User;


use App\Models\User\User;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class UserResource
 * @package App\Http\Resources\User
 * @OA\Schema(schema="User", type="object")
 */
class UserResource extends JsonResource
{

    /**
     * @OA\Property(
     *   property="id",
     *   type="integer",
     *   nullable=false,
     * )
     */

    /**
     * @OA\Property(
     *   property="name",
     *   type="string",
     *   nullable=false,
     * )
     */

    /**
     * @OA\Property(
     *   property="email",
     *   type="string",
     *   nullable=true,
     * )
     */

    /**
     * @OA\Property(
     *   property="amount",
     *   type="double",
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
        /** @var User $user */
        $user = clone $this;

        return array('id'     => $user->id,
                     'name'   => $user->name,
                     'email'  => $this->when($user->id == \Auth::id(), $user->email),
                     'amount' => $this->when($user->id == \Auth::id(), $user->amount),
        );
    }
}
