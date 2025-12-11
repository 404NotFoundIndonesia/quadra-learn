<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\SignInRequest;
use App\Http\Requests\SignUpRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AuthController extends Controller
{

    public function login(Request $request): View|RedirectResponse {
        if (!auth()->guest()) return redirect()->route('dashboard');

        return view('pages.auth.login');
    }

    public function register(Request $request): View {
        if (!auth()->guest()) return redirect()->route('dashboard');

        return view('pages.auth.register');
    }

    public function signIn(SignInRequest $request): RedirectResponse {
        $credential = $request->getCredential();

        if (!Auth::validate($credential)) return back()->withErrors(['username' => __('auth.failed')]);

        $user = Auth::getProvider()->retrieveByCredentials($credential);
        Auth::login($user);

        $route = 'dashboard';

        if ($user->isAdmin()) {
            $route = 'admin.dashboard';
        } elseif ($user->isStudent()) {
            $route = 'student.dashboard';
        }

        return redirect()->route($route);
    }

    public function signUp(SignUpRequest $request): RedirectResponse {
        $validatedUser = $request->validated();
        $validatedUser['username'] = $validatedUser['nis'];

        $user = User::create($validatedUser);
        Auth::login($user);

        return redirect()->route('dashboard');
    }

    public function signOut(): RedirectResponse {
        Auth::logout();

        return redirect()->route('login');
    }
}
