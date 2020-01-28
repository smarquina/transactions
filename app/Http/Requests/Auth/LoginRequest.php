<?php
/**
 * Created for bet4g.
 * User: Sergio Martin Marquina
 * Email: smarquina@zenos.es
 * Date: 14/11/2018
 * Time: 23:42
 */

namespace App\Http\Requests\Auth;


use App\Http\Requests\ApiRequest;

class LoginRequest extends ApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return ['email'    => 'required|email|max:45',
                'password' => 'required|max:100',
        ];
    }
}