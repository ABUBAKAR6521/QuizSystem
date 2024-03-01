<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuizStoreRequest extends FormRequest
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
            "quiz_status" => 'required',
            "quiz_title" => 'required',
            "quiz_duration" => 'required',
            "no_questions" => 'required|max:2',
            "quiz_description" => 'required|max:50',
        ];
    }
        public function messages()
        {
            return [
                'category_id.required' => 'Quiz Catagory is required kindly select this field',
                'quiz_status.required' => 'Quiz Status is required kindly choose one option',
                'quiz_title.required'=>'Quiz title is required kindly fill this field',
                'no_questions.required'=>'Number of questions are required kindly fill this field',
                'no_questions.max'=>'Max 10 questions can be added under this Quiz',
                'quiz_duration.required'=>'Quiz Duration is required kindly fill this field',
                'quiz_description.required'=>'Quiz Description is required kindly fill this field',

            ];

}
}
