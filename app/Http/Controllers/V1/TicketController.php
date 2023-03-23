<?php

namespace App\Http\Controllers\V1;

use App\Helpers\FileHelper;
use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\TicketMessage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Prettus\Validator\Exceptions\ValidatorException;

class TicketController extends Controller
{

    public function index()
    {
        return response(Ticket::where('user_id', auth()->id())->advancedFilter());

    }

    public function store(Request $request)
    {
        $request->validate(
            [
                Ticket::TITLE => ["required"],
                Ticket::DEPARTMENT_ID => ["required"],
                TicketMessage::DESCRIPTION => ["required"],
                Ticket::IMPORTANCE => ["required", 'in:1,2,3'],
            ]);

        $file = null;
        $filePath = null;
        if ($request->hasFile("attach")) {
            $file = $request->file("attach");
            $allowedExtensions = ["png", "gif", "pdf", "jpg", "docs", "xls"];
            if (!in_array($file->getClientOriginalExtension(), $allowedExtensions))
                return response("فرمت فایل پیوست قابل قبول نیست", 422);
            if ($file->getSize() > 6000000)
                return response("حجم فایل ارسالی باید کمتر از ۵ مگابایت باشد", 422);

            FileHelper::UploadAllowFields($request, ['attach']);
        }


        $ticket = Ticket::create(
            [
                Ticket::USER_ID => \Auth::id(),
                Ticket::DEPARTMENT_ID => $request->input("department_id"),
                Ticket::IMPORTANCE => $request->input('importance'),
                Ticket::TITLE => $request->input("title")
            ]
        );

        $ticket->addMessage($request->input("description"), $filePath != null ? $filePath->imageName : null);

        return response('درخواست پشتیبانی شما با موفقیت ثبت شد.');
    }


    public function message(Request $request)
    {
        $request->validate(
            [
                TicketMessage::TICKET_ID => ["required"],
                TicketMessage::DESCRIPTION => ["required"],
            ]);


        $ticket = Ticket::findOrFail($request->input("ticket_id"));

        if ($ticket->user_id !== auth()->id())
            return response("این تیکت متعلق به شما نیست", 403);

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

        $ticket->addMessage($request->input("description"), $filePath !== null ? $filePath->imageName : null);

        return response('پیام شما با موفقیت ارسال شد.');
    }

    public function show(Ticket $ticket): JsonResponse
    {
        if ($ticket->user_id !== auth()->id())
            return response()->json("این تیکت متعلق به شما نیست", 403);

        $ticket['messages'] = $ticket->comments()->with('user')->get()->sortBy('updated_at');

        return response()->json($ticket);
    }


    public function ticketFeedback(Request $request): JsonResponse
    {
        $ticket = Ticket::find($request->ticket_id);
        if (auth()->id() == $ticket->user_id) {
            if ($ticket->feedBack == null) {

                $ticket->update([
                    "feedback" => \request()->input("feedback"),
                ]);

            }
        }
        return response()->json($ticket);
    }

}
