<?php

namespace App\Http\Controllers\V1;

use App\Helpers\PermissionHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\SkillStoreRequest;
use App\Http\Requests\SkillUpdateRequest;
use App\Models\Skill;
use Illuminate\Http\Request;

class SkillsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
        PermissionHelper::abort_if_unless_permission('skill_list');
        return Skill::advancedFilter(\Illuminate\Support\Facades\Request::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SkillStoreRequest $request)
    {
        PermissionHelper::abort_if_unless_permission('skill_create');
        return Skill::create($request->only(['name' , 'description']));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return int|Skill
     */
    public function show(Skill $skill)
    {
        PermissionHelper::abort_if_unless_permission('skill_show');
        return $skill;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return int|Skill
     */
    public function update(SkillUpdateRequest $request, Skill $skill)
    {
        PermissionHelper::abort_if_unless_permission('skill_update');
        $skill->fill($request->only(['description' , 'name']))->save();
        return $skill;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return bool
     */
    public function destroy(Skill $skill)
    {
        PermissionHelper::abort_if_unless_permission('skill_delete');
        return $skill->delete();
    }
}
