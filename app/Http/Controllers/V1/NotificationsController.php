<?php

namespace App\Http\Controllers\V1;

use App\Helpers\PermissionHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\SkillStoreRequest;
use App\Http\Requests\SkillUpdateRequest;
use App\Models\Notif;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;

class NotificationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
        return Notif::where('user_id', auth()->id())->advancedFilter(\Illuminate\Support\Facades\Request::all());
    }


    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return int|Skill
     */
    public function show(Notif $notifs)
    {
        abort_if(auth()->id() !== $notifs->id);
        return $notifs;
    }

}
