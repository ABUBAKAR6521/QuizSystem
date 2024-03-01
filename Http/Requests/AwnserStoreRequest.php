<?php

namespace App\Http\Requests;

use App\Rules\UniqueCorrectAnswer;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class AwnserStoreRequest extends FormRequest
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
        // $questionId = $this->input('question_id');
    return [
        "category_id" => 'required',
        "quiz_id" => 'required',
        "question_id" => 'required',
        "status" => 'required',
        "title" => 'required|max:35',
        "description" => 'required|max:100',
    ];
}
    public function messages()
    {
        return [
            'category_id.required' => 'Awnser Catagory is required kindly select this field',
            'quiz_id.required' => 'Awnser Quiz is required kindly select this field',
            'question_id.required' => ' This field is required kindly select this field',
            'status.required' => 'Awnser Status is required kindly choose one option',
            'title.required'=>'Awnser title is required kindly fill this field',
            'description.required'=>'Awnser Description is required kindly fill this field',
            'is-correct' => 'only one awnser can be correct related to this question'

        ];
}

}
