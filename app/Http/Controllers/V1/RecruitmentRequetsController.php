<?php

namespace App\Http\Controllers\V1;

use App\Helpers\NotificationHelper;
use App\Helpers\PermissionHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\RecruitmentRequestStoreRequest;
use App\Mail\ResumeMail;
use App\Models\Recruitment;
use App\Models\Resume;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class RecruitmentRequetsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return Resume
     */
    public function store(RecruitmentRequestStoreRequest $request)
    {
        $recruitment = Recruitment::query()->find($request->get('recruitment_id'));
        PermissionHelper::abort_if_unless_admin_or_permmition_with_own_model('recruitment_request_change_status', 'recruitment_request_change_status_own', $recruitment);

        /** @var Resume $resume */
        $resume = Resume::query()->find($request->get('resume_id'));

        $resume->requests()->updateExistingPivot($recruitment->id, ['status' => $request->get('status'), 'updated_at' => now()]);

        dispatch(function () use ($request, $resume) {
            $userEmail = User::find($resume->user_id)->email;
            if ($userEmail) {
                if ($request->input('status') == "accept") {
                    NotificationHelper::createNotificationWithEmail($userEmail, $resume->user_id, 'تاییدیه برای مصاحبه!', "درخواست شما از شرکت $resume->name تایید شده و میتوانید در اولین فرصت برای مصاحبه اقدام کنید. ");
                } else if($request->input('status') == "reject"){
                    NotificationHelper::createNotificationWithEmail($userEmail, $resume->user_id, 'رد درخواست کار!', "درخواست شما از طرف شرکت $resume->name رد شده شده. ");
                }
            }
        })->afterResponse();


        return $resume;
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function show(Recruitment $recruitmentRequest)
    {
        PermissionHelper::check_admin_or_permmition_with_own_model('recruitment_request_list', 'recruitment_request_list_own', $recruitmentRequest);
        return $recruitmentRequest->requests()->with('user')->paginate();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
