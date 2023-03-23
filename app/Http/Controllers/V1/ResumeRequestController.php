<?php

namespace App\Http\Controllers\V1;

use App\Helpers\PermissionHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\ResumeListRequest;
use App\Http\Requests\ResumeRequestSendRequest;
use App\Models\Recruitment;
use App\Models\Resume;
use App\Models\User;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;

class ResumeRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
        /** @var User $user */
        $user = Auth::user();

        return $user->requests()->advancedFilter();

//        $ids = $user->resumes()->pluck('id');
//
//        $query = Recruitment::query()->whereHas('requests' , function ($q) use ($ids){
//            return $q->whereIn('id' , $ids);
//        })->with('user');
//
//        if (! PermissionHelper::check_permission('resume_request_list')){
//            $query = $query->where('id' , Auth::id());
//        }
//
//        return $query->advancedFilter(\Illuminate\Support\Facades\Request::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ResumeRequestSendRequest $request)
    {
        $resume = Resume::query()->findOrFail($request->get('resume_id'));
        PermissionHelper::abort_if_unless_admin_or_permmition_with_own_model('resume_request_request' , 'resume_request_request_own' , $resume);

        /** @var Recruitment $recruitment */
        $recruitment = Recruitment::query()->find($request->get('recruitment_id'));

        $recruitment->requests()->syncWithoutDetaching([$resume->id => ['user_id' => $resume->user_id , 'created_at' => now()]]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ResumeRequestSendRequest $request , $id)
    {
        $resume = Resume::query()->find($request->get('resume_id'));
        PermissionHelper::abort_if_unless_admin_or_permmition_with_own_model('resume_request_delete_request' , 'resume_request_delete_request_own' , $resume);

        /** @var Recruitment $recruitment */
        $recruitment = Recruitment::query()->find($request->get('recruitment_id'));

        $recruitment->requests()->detach($resume->id);
    }
}
