<?php

namespace App\Http\Controllers\Ajax;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\ContactUS;
use Config;
use Storage;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        $result = false;

        if($request->ajax() && !empty($request->all()))
        {
            // upload photo file
            $filePath = $this->upload($request->file('file'));

            $this->validate($request, [
                'email' => 'required|email',
                'file' => 'nullable',
                'message' => 'nullable'
            ]);

            \Mail::send('emails.contactus',
                array(
                    'email' => $request->get('email'),
                    'file' => $filePath ? $filePath : '',
                    'user_message' => $request->get('message')
                ), function($message) use ($request)
                {
                    $message->from(config('mail.admin_email_from'));
                    $message->to(config('mail.admin_email'), 'Speedvpn Support')->subject('Contact Us');
                });

            ContactUS::create(array('email' => $request->get('email'), 'file' => $filePath ? $filePath : '', 'message' => $request->get('message')));

            $result = true;
        }

        return response()->json(['result' => $result, 'result_info' => $request->all()]);
    }

    public function upload($file)
    {
        if (is_null($file)) return false;
        if ($file->isValid()) {
            $fileName = str_random(20) . '.' . $file->guessExtension();
            $file->move(storage_path() . '/upload', $fileName);
            return config('app.url') . '/storage/upload/' . $fileName;
        } else {
            return false;
        }
    }
}
