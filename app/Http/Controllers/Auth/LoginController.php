<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\LoginRequest;

class LoginController extends Controller
{
    public function index() {
        return view('auth.login');
    }


    public function process(LoginRequest $request) {
        $login = $request->input('login');
        $password = $request->input('password');

        $fieldType = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $credentials = [$fieldType => $login, 'password' => $password];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return to_route('admin.dashboard.index')->with('success', __('message.welcome_back', ['data' => Auth::user()->name]));
        }

        return back()->withErrors([
            'login' => __('message.invalid_credentials'),
        ]);
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return to_route('login.index')->with('success', __('message.success_logout', ['data' => 'You\'re']));
    }
}
