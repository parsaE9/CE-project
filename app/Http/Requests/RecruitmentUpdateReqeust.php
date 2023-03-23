<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RecruitmentUpdateReqeust extends FormRequest
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
            'title' => [ 'string' , 'min:2' , 'max:200'],
            'position' => ['string' , 'min:2' , 'max:200'],
            'description' => ['string' , 'min:10' , 'max:50000'],
            'skills' => ['array' , 'min:1'],
            'skills.*' => ['exists:skills,id'],
            'picture' => ['file' , 'image' , 'max:5120'],
            'salary' => ['integer' , 'min:0' , 'max:999999999'],
            'categories' => ['array' , 'min:1'],
            'categories.*' => ['exists:categories,id'],
            'province' => ['array' , 'min:1'],
            'province.*' => ['exists:provinces,id'],
            'contract' => ['string' , 'min:2' , 'max:200'],
            'experience' => [ 'string' , 'min:2' , 'max:200'],

        ];
    }
}
