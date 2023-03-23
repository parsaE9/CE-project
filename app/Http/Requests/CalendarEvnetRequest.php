<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CalendarEvnetRequest extends FormRequest
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
            "summary" => ['string' , 'min:2' , 'max:256'],
            "location" => ['string' , 'min:2' , 'max:512'],
            "description" => ['string' , 'min:2' , 'max:512'],
            "start.dateTime" => ['required' , 'date'],
            'start.timeZone' => ['required' , 'string' , 'timezone'],
            "end.dateTime" => ['required' , 'date'],
            'end.timeZone' => ['required' , 'string' , 'timezone'],
        ];
    }
}
