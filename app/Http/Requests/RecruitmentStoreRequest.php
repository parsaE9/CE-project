<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RecruitmentStoreRequest extends FormRequest
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
            'title' => ['required' , 'string' , 'min:2' , 'max:200'],
            'position' => ['required' , 'string' , 'min:2' , 'max:200'],
            'description' => ['required' , 'string' , 'min:10' , 'max:50000'],
            'skills' => ['required' , 'array' , 'min:1'],
            'skills.*' => ['exists:skills,id'],
            'picture' => ['file' , 'image','max:5120'],
            'salary' => ['required' , 'integer' , 'min:0' , 'max:999999999'],
            'categories' => ['required' , 'array' , 'min:1'],
            'categories.*' => ['exists:categories,id'],
            'province' => ['required' , 'array' , 'min:1'],
            'province.*' => ['exists:provinces,id'],
            'contract' => ['required' , 'string' , 'min:2' , 'max:200'],
            'experience' => ['required' , 'string' , 'min:2' , 'max:200'],

        ];
    }
}
