<?php

namespace App\Http\Controllers\V1;

use App\Helpers\EventLogHelper;
use App\Helpers\FileHelper;
use App\Helpers\PermissionHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\PageStoreRequest;
use App\Models\Page;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function index()
    {
        PermissionHelper::abort_if_unless_permission('page_list');
        return Page::query()->with('users')->paginate();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PageStoreRequest $request)
    {
        PermissionHelper::abort_if_unless_permission('page_store_own');

        FileHelper::UploadAllowFields($request , ['data']);

        /** @var Page $page */
        $page = Page::query()->firstOrNew([
            'user_id' => Auth::id()
        ]);
        $page->data = $request->get('data');
        $page->save();

        EventLogHelper::addEventLog('page' , 'یک پیج ساخته یا به روز رسانی شد ' , '',
            [
                EventLogHelper::createMeta(Auth::user() , 'کابر'),
                EventLogHelper::createMeta($page , 'صخفه'),
            ]);

        return $page->data;
    }

    public function update($page , PageStoreRequest $request)
    {
        PermissionHelper::abort_if_unless_permission('page_store');

        FileHelper::UploadAllowFields($request , ['data']);

        /** @var Page $page */
        $page = Page::query()->firstOrNew([
            'user_id' => $page
        ]);
        $page->data = $request->get('data');
        $page->save();

        EventLogHelper::addEventLog('page' , 'یک پیج ساخته یا به روز رسانی شد ' , '',
            [
                EventLogHelper::createMeta(Auth::user() , 'کابر'),
                EventLogHelper::createMeta($page , 'صخفه'),
            ]);

        return $page->data;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function show($page)
    {
        return Page::query()->where('user_id' , $page)->firstOrFail()->data;
    }
}
