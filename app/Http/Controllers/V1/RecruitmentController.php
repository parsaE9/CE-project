<?php

namespace App\Http\Controllers\V1;

use App\Helpers\FileHelper;
use App\Helpers\PermissionHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\RecruitmentChangeStatusRequest;
use App\Http\Requests\RecruitmentStoreRequest;
use App\Http\Requests\RecruitmentUpdateReqeust;
use App\Models\Recruitment;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecruitmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function index(Request $request)
    {
//        TODO: apply filters for skills and categories
//        $skills = @json_decode($request->input('skills'));

        return Recruitment::query()
            ->when($request->input('created_at'), function ($query, $created_at) {
                /** @var Builder $query */
                $query->whereDate('created_at', '=', $created_at);
            })
            ->when($request->input('updated_at'), function ($query, $updated_at) {
                /** @var Builder $query */
                $query->whereDate('updated_at', '=', $updated_at);
            })
            ->when($request->input('salaryFrom'), function ($query, $salaryFrom) {
                /** @var Builder $query */
                $query->where('salary', '>=', $salaryFrom);
            })
            ->when($request->input('salaryTo'), function ($query, $salaryTo) {
                /** @var Builder $query */
                $query->where('salary', '<=', $salaryTo);
            })
            ->when($request->input('status'), function ($query, $status) {
                /** @var Builder $query */
                $query->where('status', '=', $status);
            })
            ->when($request->input('province'), function ($query, $province) {
                /** @var Builder $query */
                $query->where('province', '=', $province);
            })
            ->with('user')->advancedFilter();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(RecruitmentStoreRequest $request)
    {
        PermissionHelper::abort_if_unless_permission('recruitment_create');
        FileHelper::UploadAllowFields($request, ['picture']);

        return Recruitment::create($request->merge(['user_id' => Auth::id(), 'status' => Recruitment::STATUS_DRAFT])->only([
            'user_id',
            'title',
            'description',
            'skills',
            'picture',
            'salary',
            'status',
            'categories',
            'province',
            'contract',
            'position',
            'experience'
        ]));
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Recruitment $recruitment
     * @return Recruitment
     */
    public function show(Recruitment $recruitment)
    {
        return $recruitment;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Recruitment $recruitment
     * @return Recruitment
     */
    public function update(RecruitmentUpdateReqeust $request, Recruitment $recruitment)
    {
        PermissionHelper::abort_if_unless_admin_or_permmition_with_own_model('recruitment_update', 'recruitment_update_own', $recruitment);

        FileHelper::UploadAllowFields($request, ['picture']);
        $status = $recruitment->status == Recruitment::STATUS_DRAFT ? Recruitment::STATUS_DRAFT : Recruitment::STATUS_PENDING;

        $recruitment->fill($request->merge(['status' => $status])->only([
            'title',
            'description',
            'position',
            'skills',
            'picture',
            'salary',
            'status',
            'categories',
            'province',
            'contract',
            'experience'
        ]));

        $recruitment->save();

        return $recruitment;
    }

    public function updateStatus(Recruitment $recruitment, RecruitmentChangeStatusRequest $request)
    {
        $status = $request->get('status');

        if ($status == Recruitment::STATUS_PUBLISH) {
            PermissionHelper::abort_if_unless_permission('recruitment_change_status');
        } else {
            PermissionHelper::abort_if_unless_admin_or_permmition_with_own_model('recruitment_change_status' , 'recruitment_update', $recruitment);
        }

        $recruitment->status = $status;
        $recruitment->save();

        return $recruitment;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Recruitment $recruitment
     * @return bool
     */
    public function destroy(Recruitment $recruitment)
    {
        PermissionHelper::abort_if_unless_admin_or_permmition_with_own_model('recruitment_delete', 'recruitment_delete_own', $recruitment);
        return $recruitment->delete();
    }
}
