<?php
/**
 * Created for transactions.
 * User: Sergio Martin Marquina
 * Email: smarquina@zenos.es
 * Date: 09/04/2019
 * Time: 15:46
 */

namespace App\Models\Transaction;


use App\Models\BaseModel;
use App\Models\User\User;

/**
 * App\Models\Transaction\Transaction
 *
 * @property int                             $id
 * @property int                             $user_from
 * @property int                             $user_to
 * @property string                          $subject
 * @property string|null                     $comment
 * @property mixed                           $quantity
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User\User      $userFrom
 * @property-read \App\Models\User\User      $userTo
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction\Transaction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction\Transaction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction\Transaction query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction\Transaction whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction\Transaction whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction\Transaction whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction\Transaction whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction\Transaction whereSubject($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction\Transaction whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction\Transaction whereUserFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction\Transaction whereUserTo($value)
 * @mixin \Eloquent
 */
class Transaction extends BaseModel
{
    protected $table = 'transaction';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'subject', 'quantity', 'comment', 'user_from', 'user_to',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'user_from' => 'integer',
        'user_to'   => 'integer',
        'subject'   => 'string',
        'quantity'  => 'numeric',
        'comment'   => 'string',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function userFrom()
    {
        return $this->belongsTo(User::class, 'user_from');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function userTo()
    {
        return $this->belongsTo(User::class, 'user_to');
    }
}
