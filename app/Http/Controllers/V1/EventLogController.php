<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Models\EventLog;
use Illuminate\Http\Request;

class EventLogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function index()
    {
        return EventLog::query()->paginate();
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(EventLog $eventlog)
    {
        return $eventlog;
    }
}
