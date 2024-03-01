<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CatagoryStoreRequest extends FormRequest
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
                "catagory_name" => 'required',
                "catagory_status" => 'required',
            ];
        }
            public function messages()
            {
                return [
                    'catagory_name.required' => 'Catagory name is required kindly fill this field',
                    'catagory_status.required' => 'Catagory Status is required kindly choose one option',

                ];

    }
}
