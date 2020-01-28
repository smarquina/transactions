<?php namespace App\Http\Requests;


use Dingo\Api\Exception\ValidationHttpException;
use Illuminate\Contracts\Validation\Validator;

abstract class ApiRequest extends \Dingo\Api\Http\FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return \Auth::check();
    }

    protected function failedValidation(Validator $validator)
    {
        if ($this->ajax()) {
            throw new ValidationHttpException($validator->errors());

        } else {
            parent::failedValidation($validator);
        }
    }

}
