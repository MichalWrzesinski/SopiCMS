<?php

declare(strict_types=1);

namespace App\Http\Controllers\User;

use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Repository\Eloquent\UserRepository;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function login(): View
    {
        return view('auth.login', [
            'title' => 'Logowanie',
        ]);
    }

    public function loginSend(LoginRequest $request)
    {
        if($this->userRepository->login($request)) {
            return redirect()->route('user.dashboard');
        }

        return back()->with('error', 'Podano błędne dane lub konto nie jest aktywne.');
    }

    public function logout(): View
    {
        $this->userRepository->logout();

        return View('auth.logout', [
            'title' => 'Wyloguj się',
        ]);
    }

    public function password(): View
    {
        return View('auth.password', [
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
            return redirect()->route('auth.password')
                ->with('error', 'Błędny link potwierdzający');
        }

        return View('auth.password', [
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

        return redirect()->route('auth.login')
            ->with('success', 'Twoje hasło zostało zmienione. Możesz się teraz zalogować');
    }

    public function register(): View
    {
        return View('auth.register', [
            'title' => 'Rejestracja',
        ]);
    }

    public function registerSend(RegisterRequest $request)
    {
        $this->userRepository->add($request);

        return redirect()->route('auth.activate');
    }

    public function activate(): View
    {
        return View('auth.activate', [
            'title' => 'Aktywacja',
        ]);
    }

    public function activateSend(int $id, string $hash)
    {
        if(!$this->userRepository->active($id, $hash)) {
            return redirect()->route('auth.activate')
                ->with('error', 'Błędny link potwierdzający');
        }

        return redirect()->route('auth.login')
            ->with('success', 'Twoje konto zostało aktywowane. Możesz się teraz zalogować.');
    }
}
