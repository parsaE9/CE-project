<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UserCreateRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "name" => 'required|min:2|max:50',
            "email" => 'required|email|unique:users,email',
            "role" => 'nullable|exists:roles,name',
            "status" => 'nullable|in:draft,pending,active,disable',
            "password" => ['required','min:8','max:20', Password::default()->letters() , Password::default()->mixedCase()]
        ];
    }
}
