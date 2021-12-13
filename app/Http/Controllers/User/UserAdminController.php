<?php

declare(strict_types=1);

namespace App\Http\Controllers\User;

use App\Http\Requests\ImageRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Requests\PasswordRequest;
use App\Http\Requests\DeleteRequest;
use App\Models\User;
use App\Repository\Eloquent\UserRepository;
use App\Http\Controllers\Controller;

class UserAdminController extends Controller
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function list(Request $request): View
    {
        return View('admin.users.list', [
            'title' => __('users.header.title'),
            'list' => $this->userRepository->list($request, config('sopicms.paginate')),
        ]);
    }

    public function addSend(RegisterRequest $request)
    {
        $request['status'] = 1;
        $id = $this->userRepository->add($request);

        return redirect()->route('admin.users.edit', ['id' => $id]);
    }

    public function edit(int $id): View
    {
        return View('admin.users.edit', [
            'id' => $id,
            'title' => __('users.header.edit'),
            'user' => $this->userRepository->get($id),
        ]);
    }

    public function editSend(Request $request, int $id)
    {
        $request->validate([
            'name' => ['required', 'min:3', 'max:30'],
            'email' => ['required', 'email', 'unique:users,email,'.$id],
            'status' => ['in:'.implode(',', array_keys(config('sopicms.user.status')))],
            'type' => ['in:'.implode(',', array_keys(config('sopicms.user.type')))],
        ]);

        $this->userRepository->update($id, [
            'status' => $request['status'],
            'type' => $request['type'],
            'name' => $request['name'],
            'email' => $request['email'],
        ]);

        return back()->with('success', __('layout.alert.save'));
    }

    public function passwordSend(PasswordRequest $request, int $id)
    {
        $this->userRepository->update($id, [
            'password' => Hash::make($request['password'])
        ]);
        return back()->with('success', __('users.alert.password'));
    }

    public function deleteSend(DeleteRequest $request, int $id)
    {
        $this->userRepository->delete($id);
        return redirect()->route('admin.users.list')
            ->with('success', __('users.alert.deleted'));
    }

    public function avatarAddSend(ImageRequest $request, int $id)
    {
        $user = User::findOrFail($id);

        if($user->avatar <> null) {
            Storage::disk('public')->delete($user->avatar);
        }

        $file = $request->file('image')->store('avatars', 'public');
        $this->userRepository->update($id, [
            'avatar' => $file,
        ]);
        return back()->with('success', __('users.alert.avatar'));
    }

    public function avatarDeleteSend(Request $request, int $id)
    {
        $this->userRepository->update($id, [
            'avatar' => '',
        ]);
        return back()->with('success', __('users.alert.avatarDeleted'));
    }

    public function newsletter(): View
    {
        return View('admin.users.newsletter', [
            'title' => __('newsletter.header.title'),
        ]);
    }

    public function newsletterSend(Request $request)
    {
        $request->validate([
            'title' => ['required'],
            'content' => ['required'],
        ]);

        $this->userRepository->newsletter($request['title'], $request['content']);
        return back()->with('success', __('newsletter.alert.send'));
    }
}
