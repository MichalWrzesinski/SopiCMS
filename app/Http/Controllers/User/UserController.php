<?php

declare(strict_types=1);

namespace App\Http\Controllers\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\User;
use App\Repository\UserRepository;
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

    public function login(): View
    {
        return view('main.user.login', [
            'title' => 'Logowanie',
        ]);
    }

    public function loginSend(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if($this->userRepository->login($request)) {
            return redirect()->route('user.dashboard');
        }

        return back()->with('error', 'Podano błędne dane lub konto nie jest aktywne.');
    }

    public function logout(): View
    {
        $this->userRepository->logout();

        return View('main.user.logout', [
            'title' => 'Wyloguj się',
        ]);
    }

    public function password(): View
    {
        return View('main.user.password', [
            'title' => 'Przypomnij hasło',
            'form' => 1,
        ]);
    }

    public function passwordSend(Request $request)
    {
        $this->userRepository->passwordInit($request);

        return back()->with('success', 'Na podany adres e-mail wysłaliśmy wiadomość z dalszymi instrukcjami');
    }

    public function passwordNew(int $id, string $hash)
    {
        if(!$this->userRepository->passwordVeryfi($id, $hash)) {
            return redirect()->route('user.password')
                ->with('error', 'Błędny link potwierdzający');
        }

        return View('main.user.password', [
            'title' => 'Ustaw nowe hasło',
            'form' => 2,
            'id' => $id,
            'hash' => $hash
        ]);
    }

    public function passwordNewSend(Request $request)
    {
        if(!$this->userRepository->passwordVeryfi((int)$request['id'], $request['hash'])) {
            return back()->with('error', 'Błędny link potwierdzający');
        }

        $request->validate([
            'password' => ['required', 'min:8', 'confirmed'],
        ]);

        $this->userRepository->passwordReset((int)$request['id'], $request);

        return redirect()->route('user.login')
            ->with('success', 'Twoje hasło zostało zmienione. Możesz się teraz zalogować');
    }

    public function register(): View
    {
        return View('main.user.register', [
            'title' => 'Rejestracja',
        ]);
    }

    public function registerSend(Request $request)
    {
        $request->validate([
            'name' => ['required', 'min:3', 'max:30'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:8', 'confirmed'],
            'regulations' => ['required']
        ]);

        $this->userRepository->add($request);

        return redirect()->route('user.activate')
            ->with('success', 'Twoje konto zostało zarejestrowane. Na podany adres e-mail wysłaliśmy wiadomość. Kliknij w link by zweryfikować swoje konto.');
    }

    public function activate(): View
    {
        return View('main.user.activate', [
            'title' => 'Aktywacja',
        ]);
    }

    public function activateSend(int $id, string $hash)
    {
        if(!$this->userRepository->active($id, $hash)) {
            return redirect()->route('user.activate')
                ->with('error', 'Błędny link potwierdzający');
        }

        return redirect()->route('user.login')
            ->with('success', 'Twoje konto zostało aktywowane. Możesz się teraz zalogować.');
    }

    public function manage(): View
    {
        $user = Auth::user();

        return View('main.user.manage', [
            'title' => 'Ustawienia konta',
            'user' => $user,
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

    public function managePasswordSend(Request $request)
    {
        $request->validate([
            'password' => ['required', 'min:8', 'confirmed'],
        ]);

        $this->userRepository->update(Auth::id(), [
            'password' => Hash::make($request['password']),
        ]);

        return back()->with('success', 'Twoje hasło zostało zmienione');
    }

    public function manageAvatarSend(Request $request)
    {
        $request->validate([
            'avatar' => ['required', 'file', 'image', 'mimes:jpg,jpeg,gif,png,bmp', 'max:10240'],
        ]);

        $user = Auth::user();
        if($user->avatar <> null) {
            Storage::disk('public')->delete($user->avatar);
        }

        $file = $request->file('avatar')->store('avatars', 'public');
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
