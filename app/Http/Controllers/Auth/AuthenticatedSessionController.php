<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Password;
use Laravel\Socialite\Facades\Socialite;

class AuthenticatedSessionController extends Controller
{
    public function register(): View
    {
        if (auth()->check()) {
            if (auth()->user()->roles == 'USER') {
                return redirect('/home');
            } else {
                return redirect('/dashboard');
            }
        }
        return view('auth.register')->with('pages', 'register');
    }

    public function storeRegister(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'roles' => 'USER',
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect()->intended('/home');
    }

    public function login()
    {
        if (auth()->check()) {
            if (auth()->user()->roles == 'USER') {
                return redirect()->intended('/home');
            } else {
                return redirect()->intended('/dashboard');
            }
        }

        return view('auth.login')->with('pages', 'login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function auth(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            $roles = Auth::user()->roles;
            if ($roles == 'ADMIN') {
                return redirect()->intended('/dashboard');
            }
            return redirect()->intended('/home');
        }

        return back()
            ->withErrors([
                'email' => 'Email atau pasword salah.',
            ])
            ->withInput($request->only('email', 'remember'));
    }

    // auth google
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback(Request $request)
    {
        $userFromGoogle = Socialite::driver('google')->user();

        $userFromDatabase = User::where('google_id', $userFromGoogle->getId())->first();

        if (!$userFromDatabase) {
            $alreadyEmail = User::where('email', $userFromGoogle->getEmail())->first();

            if ($alreadyEmail) {
                $alreadyEmail->update([
                    'google_id' => $userFromGoogle->getId(),
                ]);
                auth('web')->login($alreadyEmail);
            } else {
                $newUser = User::create([
                    'google_id' => $userFromGoogle->getId(),
                    'name' => $userFromGoogle->getName(),
                    'email' => $userFromGoogle->getEmail(),
                    'password' => bcrypt(str()->random(16)),
                ]);
                auth('web')->login($newUser);
            }
        } else {
            auth('web')->login($userFromDatabase);
        }

        session()->regenerate();

        if (Auth::user()->roles == 'ADMIN') {
            return redirect()->intended('/dashboard');
        }
        return redirect()->intended('/home');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
