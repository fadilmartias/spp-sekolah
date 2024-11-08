<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function process(RegisterRequest $request) {
        $email = $request->input('email');
        $password = $request->input('password');
        $username = $request->input('username');
        $name = $request->input('name');
        $user = User::create([
            'email'=> $email,
            'name' => $name,
            'username' => $username,
            'password' => bcrypt($password),
        ]);
        return redirect()->route('login.index')->with('success', __('message.success_register', ['data' => 'You\'re']));
    }
}
