<?php

namespace App\Http\Controllers\V1\Resume;

use App\Http\Controllers\Controller;
use App\Http\Resources\ResumeResource;
use App\Models\Resume;
use Illuminate\Http\Request;

class ResumeShowController extends Controller
{
    public function index(Resume $resume){

        for ($i = 0 ; $i < 5 ; $i++){
            switch ($resume->status){
                case Resume::STATUS_PUBLISH:
                    return new ResumeResource($resume);
                case Resume::STATUS_REDIRECT:
                    $resume = Resume::query()->findOrFail($resume->extras->redirecto_to);
                    break;
                default:
                    abort(404);
            }
        }

        abort(404);
    }
}
