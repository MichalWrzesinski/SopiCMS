<?php

declare(strict_types=1);

namespace App\Http\Controllers\User;

use App\Http\Requests\ImageRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\PasswordRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Repository\Eloquent\UserRepository;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function dashboard(): View
    {
        return View('main.user.dashboard', [
            'title' => 'Twoje konto',
        ]);
    }

    public function manage(): View
    {
        return View('main.user.manage', [
            'title' => 'Ustawienia konta',
            'user' => Auth::user(),
        ]);
    }

    public function manageDataSend(Request $request)
    {
        $request->validate([
            'name' => ['required', 'min:3', 'max:30'],
            'email' => ['required', 'email', 'unique:users,email,'.Auth::id()],
        ]);

        $this->userRepository->update(Auth::id(), [
            'name' => $request['name'],
            'email' => $request['email'],
        ]);

        return back()->with('success', 'Twoje ustawienia zostały zmienione');
    }

    public function managePasswordSend(PasswordRequest $request)
    {
        $this->userRepository->update(Auth::id(), [
            'password' => Hash::make($request['password']),
        ]);

        return back()->with('success', 'Twoje hasło zostało zmienione');
    }

    public function manageAvatarSend(ImageRequest $request)
    {
        $user = Auth::user();
        if($user->avatar <> null) {
            Storage::disk('public')->delete($user->avatar);
        }

        $file = $request->file('image')->store('avatars', 'public');
        $this->userRepository->update(Auth::id(), [
            'avatar' => $file,
        ]);

        return back()->with('success', 'Twój avatar został zmieniony');
    }

    public function manageAvatarDelete()
    {
        $this->userRepository->update(Auth::id(), [
            'avatar' => '',
        ]);

        return back()->with('success', 'Twój avatar został usunięty');
    }
}
