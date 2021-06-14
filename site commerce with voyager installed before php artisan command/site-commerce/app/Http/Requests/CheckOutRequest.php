<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckOutRequest extends FormRequest
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
        //this checks if you are logged in then email is required but if you're not logged in then
        //it will check for you are previously registered or not.
        $emailValidation = auth()->user() ? 'required|email' : 'required|email|unique:users';

        return [
            'name' => 'required',
            'email' => $emailValidation,
            'address' => 'required',
            'city' => 'required',
            'province' => 'required',
            'postalcode' => 'required',
            'phone' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'email.unique' => 'You already have an account with this email address.Please <a href="/login">login</a> to continue.'
        ]
    }
}
