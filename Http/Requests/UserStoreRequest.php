<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
        return [
            "user_first_name" => 'required',
            "user_last_name" => 'required',
            "user_email" => 'required|email|unique:users,email',
            "user_password"=>'required|max:8',
            "user_phone" => 'required',
            "user_adress" => 'required'

        ];
    }
        public function messages()
        {

            return [

                'user_first_name.required' => 'First name is required kindly fill this field',
                'user_last_name.required' => 'Last name is required kindly fill this field',
                'user_email.required' => 'Your EmailAdress is required kindly fill this field',
                'user_email.unique' => 'This email is already taken',
                'user_password.required' => 'Password is required kindly fill this field',
                'user_phone.required' => 'Your phone number is required kindly fill this field',
                'user_adress.required' => 'Your adress is required kindly fill this field',
            ];
            }


}
