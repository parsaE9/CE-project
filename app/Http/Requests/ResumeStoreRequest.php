<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ResumeStoreRequest extends FormRequest
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
            'name' => ['required' , 'min:2' , 'max:50'],
            'status' => ['required' , 'in:draft,publish,disable,redirect'],
            'data' => ['required'],
            'redirect_to' => [Rule::requiredIf(function (){return $this->get('status' , 'draft') === 'redirect';}) , 'exists:resumes,id']
        ];
    }
}
