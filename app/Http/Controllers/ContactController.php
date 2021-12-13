<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Mail\SendMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function form(): View
    {
        return View('main.pages.contact', [
            'title' => __('contact.header.title'),
            'email' => config('sopicms.email'),
            'phone' => config('sopicms.phone'),
        ]);
    }

    public function send(Request $request)
    {
        $request->validate([
            'content' => ['required', 'min:10'],
            'name' => ['required', 'min:5'],
            'email' => ['required', 'email'],
        ]);

        Mail::to('wuerzet@gmail.com')
            ->send(new SendMail([
                'subject' => __('contact.header.subject'),
                'body' => str_replace("\n", '<br>', $request['content']),
                'name' => $request['name'],
                'reply' => $request['email'],
            ]));

        return back()->with('success', __('contact.alert.success'));
    }
}
