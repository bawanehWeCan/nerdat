<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
            'lname' => 'required|string',
			'phone' => 'required',
			'gender' => 'required|string',
			'classroom_id' => 'required|exists:App\Models\Classroom,id',
			'school_grade_id' => 'required|exists:App\Models\SchoolGrade,id',
			'user_id' => 'required|exists:App\Models\User,id',
        ];
    }
}
