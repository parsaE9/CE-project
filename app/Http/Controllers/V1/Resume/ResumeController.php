<?php

namespace App\Http\Controllers\V1\Resume;

use App\Helpers\FileHelper;
use App\Helpers\PermissionHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\ResumeStoreRequest;
use App\Http\Requests\ResumeUpdateRequest;
use App\Http\Resources\ResumeResource;
use App\Models\Resume;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResumeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        PermissionHelper::abort_if_unless_permission("resume_own_list");

        return ResumeResource::collection(
            Resume::query()
                ->select(['id' , 'name' , 'status' , 'created_at' , 'updated_at', 'extras->redirect_to as redirect_to'])
                ->where('user_id' , Auth::id())
                ->paginate()
        );
    }

    public function nameId()
    {
        PermissionHelper::abort_if_unless_permission("resume_own_list");

        return ResumeResource::collection(
            Resume::query()
                ->select(['id' , 'name'])
                ->where('user_id' , Auth::id())
                ->get()
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return ResumeResource
     */
    public function store(ResumeStoreRequest $request)
    {
        PermissionHelper::abort_if_unless_permission("resume_own_create");

        FileHelper::UploadAllowFields($request , ['data']);

        $merge = ['user_id' => Auth::id()];
        if ($request->has('redirect_to')){
            $merge['extras'] = ['redirect_to' => $request->get('redirect_to')];
        }
        $request = $request->merge($merge);


        /** @var Resume $resume */
        $resume = Resume::create($request->only('user_id' , 'name' , 'data' , 'status' , 'extras'));

        return new ResumeResource($resume);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return ResumeResource
     */
    public function show(Resume $resume)
    {
        PermissionHelper::abort_if_unless_permission_with_own_model("resume_own_show" , $resume);
        return new ResumeResource($resume);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return ResumeResource
     */
    public function update(ResumeUpdateRequest $request, Resume $resume)
    {
        PermissionHelper::abort_if_unless_permission_with_own_model("resume_own_edit" , $resume);

        FileHelper::UploadAllowFields($request , ['data']);

        if ($request->has('redirect_to')){
            $request = $request->merge(['extras' => ['redirect_to' => $request->get('redirect_to')]]);
        }

        $resume->fill($request->only(['user_id' , 'name' , 'data' , 'status' , 'extras']))->save();

        return new ResumeResource($resume);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return ResumeResource
     */
    public function destroy(Resume $resume)
    {
        PermissionHelper::abort_if_unless_permission_with_own_model("resume_own_delete" , $resume);

        abort_unless($resume->delete() , 403);

        return new ResumeResource($resume);
    }
}
