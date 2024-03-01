<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuestionStoreRequest extends FormRequest
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
            "category_id" => 'required',
            "quiz_id" => 'required',
            "question_title" => 'required|max:30',
            "no_awnsers" => 'required|max:1',
            "question_status" => 'required',
            "question_description" => 'required|max:100',
        ];
    }
        public function messages()
        {
            return [
                'category_id.required' => 'Question Catagory is required kindly select this field',
                'quiz_id.required' => 'Question Quiz is required kindly select this field',
                'question_status.required' => 'Question Status is required kindly choose one option',
                'question_title.required'=>'Question title is required kindly fill this field',
                'question_title.max'=>'Question title cannot be greater then 30 characters',
                'no_awnsers.required'=>'No of Awnsers is required kindly fill this field',
                'no_awnsers.max'=>'Only 9 awnsers related to this question can be added',
                'question_description.required'=>'Question Description is required kindly fill this field',

            ];

}
}
