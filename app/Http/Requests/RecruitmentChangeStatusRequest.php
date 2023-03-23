<?php

namespace App\Http\Requests;

use App\Models\Recruitment;
use Illuminate\Foundation\Http\FormRequest;

class RecruitmentChangeStatusRequest extends FormRequest
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
            'status' => ['required' , 'in:'.implode("," , [
                    Recruitment::STATUS_PENDING,
                    Recruitment::STATUS_DRAFT,
                    Recruitment::STATUS_PUBLISH,
                    Recruitment::STATUS_CLOSE
                ])]
        ];
    }
}
