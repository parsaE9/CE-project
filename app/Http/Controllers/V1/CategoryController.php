<?php

namespace App\Http\Controllers\V1;

use App\Helpers\PermissionHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\SkillStoreRequest;
use App\Http\Requests\SkillUpdateRequest;
use App\Models\Category;
use App\Models\Skill;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
        PermissionHelper::abort_if_unless_permission('category_list');
        return Category::advancedFilter(\Illuminate\Support\Facades\Request::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        PermissionHelper::abort_if_unless_permission('category_create');
        return Category::create($request->only(['name' , 'description']));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return int|Category
     */
    public function show(Category $category)
    {
        PermissionHelper::abort_if_unless_permission('category_show');
        return $category;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return int|Category
     */
    public function update(CategoryRequest $request, Category $category)
    {
        PermissionHelper::abort_if_unless_permission('category_update');
        $category->fill($request->only(['description' , 'name']))->save();
        return $category;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return bool
     */
    public function destroy(Category $category)
    {
        PermissionHelper::abort_if_unless_permission('category_delete');
        return $category->delete();
    }

}
