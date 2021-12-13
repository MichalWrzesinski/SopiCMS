<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\IpRequest;
use App\Models\Ban;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Http\Controllers\Controller;

class BanController extends Controller
{
    public function list(Request $request): View
    {
        $banArray = Ban::select(['id', 'ip', 'created_at', 'updated_at'])
            ->where(function($query) use($request) {
                if($request['id'] == 1 && (int)$request['search'] > 0) $query->orWhere('id', (int)$request['search']);
                if($request['ip'] == 1) $query->orWhere('ip', 'like', '%'.$request['search'].'%');
            })
            ->orderBy('created_at')
            ->paginate(10);

        return View('admin.users.bans', [
            'title' => __('bans.header.title'),
            'list' => $banArray,
        ]);
    }

    public function addSend(IpRequest $request)
    {
        Ban::create([
            'ip' => $request['ip'],
        ]);

        return back()->with('success', __('bans.alert.add'));
    }

    public function deleteSend(Request $request, int $id)
    {
        Ban::findOrFail($id)->delete();

        return redirect()->route('admin.users.bans')
            ->with('success', __('bans.alert.delete'));
    }
}
