<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMarkRequest extends FormRequest
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
            'is_correct' => 'required|numeric',
			'question_id' => 'required|exists:App\Models\Question,id',
			'answer_id' => 'required|exists:App\Models\Answer,id',
			'result_id' => 'required|exists:App\Models\Result,id',
			'user_id' => 'required|exists:App\Models\User,id',
        ];
    }
}
