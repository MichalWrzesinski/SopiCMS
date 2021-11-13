<?php

declare(strict_types=1);

namespace App\Http\Controllers\User;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Http\Request;
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
            'title' => 'Użytkownicy',
            'list' => $this->userRepository->list($request, config('sopicms.paginate')),
        ]);
    }

    public function addSend(Request $request)
    {
        $request->validate([
            'name' => ['required', 'min:3', 'max:30'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:8', 'confirmed'],
        ]);

        $request['status'] = 1;
        $id = $this->userRepository->add($request);

        return redirect()->route('admin.users.edit', ['id' => $id]);
    }

    public function edit(int $id): View
    {
        return View('admin.users.edit', [
            'id' => $id,
            'title' => 'Edycja użytkownika',
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

        return back()->with('success', 'Zmiany zostały zapisane');
    }

    public function passwordSend(Request $request, Int $id)
    {
        $request->validate([
            'password' => ['required', 'min:8', 'confirmed'],
        ]);

        $this->userRepository->update($id, [
            'password' => Hash::make($request['password'])
        ]);

        return back()->with('success', 'Hasło użytkownika zostało zmienione');
    }

    public function deleteSend(Request $request, Int $id)
    {
        $request->validate([
            'delete' => ['required'],
        ]);

        $this->userRepository->delete($id);

        return redirect()->route('admin.users.list')
            ->with('success', 'Użytkownik został usunięty');
    }

    public function avatarAddSend(Request $request, Int $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'avatar' => ['required', 'file', 'image', 'mimes:jpg,jpeg,gif,png,bmp', 'max:10240'],
        ]);

        if($user->avatar <> null) {
            Storage::disk('public')->delete($user->avatar);
        }

        $file = $request->file('avatar')->store('avatars', 'public');
        $this->userRepository->update($id, [
            'avatar' => $file,
        ]);

        return back()->with('success', 'Avatar użytkownika został zmieniony');
    }

    public function avatarDeleteSend(Request $request, Int $id)
    {
        $this->userRepository->update($id, [
            'avatar' => '',
        ]);

        return back()->with('success', 'Avatar użytkownika został usunięty');
    }

    public function bans(): View
    {
        return View('admin.users.bans', [
            'title' => 'Banicja',
        ]);
    }

    public function newsletter(): View
    {
        return View('admin.users.newsletter', [
            'title' => 'Newsletter',
        ]);
    }

    public function newsletterSend(Request $request)
    {
        $request->validate([
            'title' => ['required'],
            'content' => ['required'],
        ]);

        $this->userRepository->newsletter($request['title'], $request['content']);

        return back()->with('success', 'Newsletter został wysłany');
    }
}
