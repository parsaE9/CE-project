<?php

namespace App\Http\Controllers\V1;

use App\Helpers\NotificationHelper;
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

        return $user->requests()->paginate();

    }

    public function indexAll()
    {
        /** @var User $user */
        $user = Auth::user();

        return $user->requests()->get()->map(function($v){
            return [
                'id'=>$v->id,
                'resume_id' => $v->pivot->resume_id,
                'request_status'=>$v->request_status,
                'requested_at'=>$v->requested_at
            ];
        });

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

        dispatch(function () use ($request, $resume,$recruitment) {
            $userEmail = User::find($resume->user_id)->email;
            if ($userEmail) {
                NotificationHelper::createNotificationWithEmail($userEmail, $resume->user_id, 'ارسال درخواست', "درخواست شما با موفقیت برای شرکت $resume->name ارسال شد.");
            }

            $userReqruimentEmail = User::find($recruitment->user_id)->email;

            if ($userReqruimentEmail) {
                NotificationHelper::createNotificationWithEmail($userReqruimentEmail, $recruitment->user_id, 'درخواست جدید برای آگهی', "درخواست جدید برای کار شما ارسال شده است.");
            }


        })->afterResponse();


//        todo: 2 notifs has to be sent
//        todo 1=> resume->user id your request successfuly sent to karfarma
//        todo 2=> recruiment->user id darkhast baraye agahi shoma tvsote shakhse folan ersal shod
//
//

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
