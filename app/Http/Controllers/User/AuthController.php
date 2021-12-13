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
            'title' => __('auth.header.login'),
        ]);
    }

    public function loginSend(LoginRequest $request)
    {
        if($this->userRepository->login($request)) {
            return redirect()->route('user.dashboard');
        }

        return back()->with('error', __('auth.alert.badLogin'));
    }

    public function logout(): View
    {
        $this->userRepository->logout();

        return View('auth.logout', [
            'title' => __('auth.header.logout'),
        ]);
    }

    public function password(): View
    {
        return View('auth.password', [
            'title' => __('auth.header.password'),
            'form' => 1,
        ]);
    }

    public function passwordSend(Request $request)
    {
        $this->userRepository->passwordInit($request);
        return back()->with('success', __('auth.alert.register'));
    }

    public function passwordNew(int $id, string $hash)
    {
        if(!$this->userRepository->passwordVeryfi($id, $hash)) {
            return redirect()->route('auth.password')
                ->with('error', __('auth.alert.badLink'));
        }

        return View('auth.password', [
            'title' => __('auth.header.passwordNew'),
            'form' => 2,
            'id' => $id,
            'hash' => $hash
        ]);
    }

    public function passwordNewSend(Request $request)
    {
        if(!$this->userRepository->passwordVeryfi((int)$request['id'], $request['hash'])) {
            return back()->with('error', __('auth.alert.badLink'));
        }

        $request->validate([
            'password' => ['required', 'min:8', 'confirmed'],
        ]);

        $this->userRepository->passwordReset((int)$request['id'], $request);

        return redirect()->route('auth.login')
            ->with('success', __('auth.alert.passwordNew'));
    }

    public function register(): View
    {
        return View('auth.register', [
            'title' => __('auth.header.register'),
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
            'title' => __('auth.header.active'),
        ]);
    }

    public function activateSend(int $id, string $hash)
    {
        if(!$this->userRepository->active($id, $hash)) {
            return redirect()->route('auth.activate')
                ->with('error', __('auth.alert.badLink'));
        }

        return redirect()->route('auth.login')
            ->with('success', __('auth.alert.active'));
    }
}
