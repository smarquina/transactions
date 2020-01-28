<?php
/**
 * Created for bet4g.
 * User: Sergio Martin Marquina
 * Email: smarquina@zenos.es
 * Date: 16/09/2018
 * Time: 19:15
 */

namespace App\Http\Requests\Auth;


use App\Http\Requests\ApiRequest;

class ResetPasswordRequest extends ApiRequest
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
        return ['token'    => 'required',
                'email'    => 'required|email|exists:users,email',
                'password' => 'required|confirmed|min:6',];
    }
}