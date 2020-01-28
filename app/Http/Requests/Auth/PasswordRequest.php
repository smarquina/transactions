<?php
/**
 * Created for bet4g.
 * User: Sergio Martin Marquina
 * Email: smarquina@zenos.es
 * Date: 29/08/2018
 * Time: 20:35
 */

namespace App\Http\Requests\Auth;


use App\Http\Requests\ApiRequest;

class PasswordRequest extends ApiRequest
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
        return ['email' => 'required|exists:users,email',];
    }
}