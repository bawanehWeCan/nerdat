<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateQuestionRequest extends FormRequest
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
            'question' => 'required|string',
			'description' => 'required|string',
			'subject_id' => 'required|exists:App\Models\Subject,id',
			'lesson_id' => 'required|exists:App\Models\Lesson,id',
			'unit_id' => 'required|exists:App\Models\Unit,id',
        ];
    }
}
