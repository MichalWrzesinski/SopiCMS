<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function dashboard(): View
    {
        return View('admin.layouts.index', [
            'title' => __('layout.header.admin'),
        ]);
    }

    public function seo(): View
    {
        return View('admin.settings.seo', [
            'title' => __('settings.header.seo'),
            'form' => [
                'name' => config('settings.meta.name'),
                'title' => config('settings.meta.title'),
                'description' => config('settings.meta.description'),
                'keywords' => config('settings.meta.keywords'),
                'index' => config('settings.meta.index'),
            ],
        ]);
    }

    public function seoSend(Request $request)
    {
        $request->validate([
            'name' => ['required', 'min:1', 'max:255'],
            'title' => ['required', 'min:1', 'max:255'],
        ]);

        Setting::where('key', 'meta.name')->update(['value' => $request['name']]);
        Setting::where('key', 'meta.title')->update(['value' => $request['title']]);
        Setting::where('key', 'meta.description')->update(['value' => $request['description']]);
        Setting::where('key', 'meta.keywords')->update(['value' => $request['keywords']]);
        Setting::where('key', 'meta.index')->update(['value' => $request['index']]);

        return back()->with('success', __('layout.alert.save'));
    }

    public function socialmedia(): View
    {
        return View('admin.settings.socialmedia', [
            'title' => __('settings.header.socialMedia'),
            'form' => [
                'facebook' => config('settings.socialmedia.facebook'),
                'instagram' => config('settings.socialmedia.instagram'),
                'youtube' => config('settings.socialmedia.youtube'),
                'twitter' => config('settings.socialmedia.twitter'),
                'linkedin' => config('settings.socialmedia.linkedin'),
            ],
        ]);
    }

    public function socialmediaSend(Request $request)
    {
        Setting::where('key', 'socialmedia.facebook')->update(['value' => $request['facebook']]);
        Setting::where('key', 'socialmedia.instagram')->update(['value' => $request['instagram']]);
        Setting::where('key', 'socialmedia.youtube')->update(['value' => $request['youtube']]);
        Setting::where('key', 'socialmedia.twitter')->update(['value' => $request['twitter']]);
        Setting::where('key', 'socialmedia.linkedin')->update(['value' => $request['linkedin']]);

        return back()->with('success', __('layout.alert.save'));
    }

    public function email(): View
    {
        return View('admin.settings.email', [
            'title' => __('settings.header.email'),
            'form' => [
                'to' => config('settings.email.to'),
                'reply' => config('settings.email.reply'),
                'sender' => config('settings.email.sender'),
            ],
        ]);
    }

    public function emailSend(Request $request)
    {
        $request->validate([
            'to' => ['required', 'email'],
            'reply' => ['required', 'email'],
            'sender' => ['required'],
        ]);

        Setting::where('key', 'email.to')->update(['value' => $request['to']]);
        Setting::where('key', 'email.reply')->update(['value' => $request['reply']]);
        Setting::where('key', 'email.sender')->update(['value' => $request['sender']]);

        return back()->with('success', __('layout.alert.save'));
    }

    public function ads(): View
    {
        return View('admin.settings.ads', [
            'title' => __('settings.header.ads'),
            'form' => [
                'block1' => config('settings.ads.block1'),
                'block2' => config('settings.ads.block2'),
                'block3' => config('settings.ads.block3'),
                'block4' => config('settings.ads.block4'),
            ]
        ]);
    }

    public function adsSend(Request $request)
    {
        Setting::where('key', 'ads.block1')->update(['value' => $request['block1']]);
        Setting::where('key', 'ads.block2')->update(['value' => $request['block2']]);
        Setting::where('key', 'ads.block3')->update(['value' => $request['block3']]);
        Setting::where('key', 'ads.block4')->update(['value' => $request['block4']]);

        return back()->with('success', __('layout.alert.save'));
    }

    public function other(): View
    {
        return View('admin.settings.other', [
            'title' => __('settings.header.other'),
            'form' => [
                'head' => config('settings.other.head'),
                'body' => config('settings.other.body'),
            ]
        ]);
    }

    public function otherSend(Request $request)
    {
        Setting::where('key', 'other.head')->update(['value' => $request['head']]);
        Setting::where('key', 'other.body')->update(['value' => $request['body']]);

        return back()->with('success', __('layout.alert.save'));
    }
}
