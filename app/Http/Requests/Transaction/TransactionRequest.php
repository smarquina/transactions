<?php
/**
 * Created for transactions.
 * User: Sergio Martin Marquina
 * Email: smarquina@zenos.es
 * Date: 15/04/2019
 * Time: 10:56
 */

namespace App\Http\Requests\Transaction;


use App\Http\Requests\ApiRequest;

/**
 * Class TransactionRequest
 * @package App\Http\Requests\Transaction
 */
class TransactionRequest extends ApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_to'  => 'required|integer|exists:users,id',
            'quantity' => 'required|integer',
            'subject'  => 'required|string|max:255',
            'comment'  => 'nullable|string|max:1000',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'user_to'  => 'Destinatario',
            'quantity' => 'Cantidad',
            'subject'  => 'Asunto',
            'comment'  => 'Comentario',
        ];
    }
}
