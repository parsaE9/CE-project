<?php

namespace App\Http\Requests;

use App\Helpers\PermissionHelper;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;

class UserCompletionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (Auth::user()->type){
            $this->replace(['type' => Auth::user()->type]);
        }

        if ($this->has('status')){
            PermissionHelper::abort_if_unless_permission('user_completion_change_status');
        }
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, array>
     */
    public function rules()
    {
        $main = [
            'type' => ['required' , 'in:user,employer,company'],
            'name' => ['string' , 'min:2' , 'max:256'],
            'status' => ["in:draft,pending,active,disable",],
        ];

        $user = [
            'nationalCode' => ['required' , 'nationalCode'],
            'phone' => ['required' , 'phone'],
            'certificates' => ['required' , 'array'],
            'certificates.*.field' => ['required' , 'in:diploma,associate,bachelor,doctor,post'],
            'certificates.*.name' => ['min:3' , 'max:256'],
            'certificates.*.place' => ['min:3' , 'max:256'],
            'about' => ['required' , 'min:3' , 'max:256'],
            'avatar' => ['required' , 'max:4096'],
            'skills' => ['array'],
            'skills.*' => ['exists:skills,id'],
            'city' => ['required' , 'exists:cities,id'],
            'province' => ['required' , 'exists:provinces,id'],
        ];

        $company = [
            'phones' => ['required', 'array'],
            'phones.*' => ['phone'],
            'code' => ['required', 'string'],
            'address' => ['required' , 'string' , 'min:5' , 'max:1024'],
            'avatar' => ['required', 'max:4096'],
            'background' => ['array' , 'required', 'string' , 'min:2' , 'max:256']
        ];

        $employer = [
            'nationalCode' => ['required' , 'nationalCode'],
            'phones' => ['required', 'array'],
            'phones.*' => ['phone'],
            'licence_code' => ['required' , 'string' , 'min:2' , 'max:20'],
            'licence_document' => ['required' , 'max:4096'],
            'background' => ['array' , 'required', 'string' , 'min:2' , 'max:256']
        ];

        return match ($this->get('type')) {
            "user" => array_merge($main, $user),
            "employer" => array_merge($main, $employer),
            "company" => array_merge($main, $company),
            default => array_merge($main),
        };

    }
}
