<?php

namespace App\Http\Controllers\V1\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Database\Query\Builder;
use App\Models\Ticket;
use App\Models\TicketMessage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Prettus\Validator\Exceptions\ValidatorException;

class TicketController extends Controller
{

    public function index(Request $request): JsonResponse
    {
        return response()->json(Ticket::when($request->input('importance'), function ($query, $importance) {
            /** @var Builder $query */
            $query->where('importance', '=', $importance);
        })
            ->when($request->input('status'), function ($query, $status) {
                /** @var Builder $query */
                $query->where('status', '=', $status);
            })
            ->when($request->input('department_id'), function ($query, $department_id) {
                /** @var Builder $query */
                $query->where('department_id', '=', $department_id);
            })
            ->advancedFilter($request->all()));


    }


    public function store(Request $request): JsonResponse
    {
        $request->validate(
            [
                TicketMessage::TICKET_ID => ["required"],
                TicketMessage::DESCRIPTION => ["required"],
            ]);
        /** @var Ticket $ticket */
        $ticket = Ticket::findOrFail($request->input("ticket_id"));

        $file = null;
        $filePath = null;
        if ($request->hasFile("attach")) {
            $file = $request->file("attach");
            $allowedExtensions = ["png", "gif", "pdf", "docs", "xls"];
            if (!in_array($file->getClientOriginalExtension(), $allowedExtensions))
                return resJson("فرمت فایل پیوست قابل قبول نیست");
            if ($file->getSize() > 6000000)
                return resJson("حجم فایل ارسالی باید کمتر از ۵ مگابایت باشد");

            $filePath = new UploadFile($file);
        }

        $ticket->addMessageAdmin($request->input("description"), $filePath !== null ? $filePath->imageName : null);

        return response()->json(('پیام شما با موفقیت ارسال شد.'));
    }


    public function show(Ticket $ticket): JsonResponse
    {
        $ticket['messages'] = $ticket->comments()->with('user')->get()->sortBy('updated_at');

        return response()->json($ticket);
    }

    /**
     * @throws ValidatorException
     */
    public function update(Request $request, Ticket $ticket)
    {
        $request->validate([
            "department_id" => ["required"],
        ]);
        $ticket->update([
            "department_id" => $request->input("department_id"),
            "status" => $request->input("status"),
        ]);
        return response()->json("تیکت موردنظر ویرایش شد.");
    }

}
