<?php

namespace App\Http\Controllers\Auth;

use Exception;
use App\Models\User;
use App\Mail\ForgotPassword;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    public function index()
    {
        return view('auth.forgot-password');
    }

    public function process(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:users,email']);
        $user = User::where('email', $request->email)->first();
        $token = Password::broker()->createToken($user);
        try {
            Mail::to($request->email)->send(new ForgotPassword($request->email, $token));
            return back()->with('success', __('message.we_have_e_mailed_your_password_reset_link'));
        } catch (Exception $e) {
            // Handle any other exceptions
            return back()->withErrors('email', __('message.something_went_wrong'));
        }

        // dd($request->all());
    }
    public function reset(Request $request)
    {
        $token = $request->query('token');
        $email = $request->query('email');
        $user = User::where('email', $email)->first();
        $status = Password::broker()->tokenExists($user, $token);
        if ($status) {
            // Token valid
            return view('auth.reset-password', compact('email', 'token'));
        } else {
            // Token invalid
            return back()->withErrors('token', __('message.invalid', ['data' => 'token']));
        }
    }

    public function processReset(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'password' => 'required|min:8|',
            'confirm_password' => 'required|min:8|same:password',
            'token' => 'required',
            'email' => 'required|email',
        ]);
        $status = Password::broker()->reset(
            $request->only('email', 'password', 'confirm_password', 'token'),
            function ($user, $password) {
                $user->password = bcrypt($password);
                $user->save();
            }
        );
        if ($status == Password::PASSWORD_RESET) {
            return redirect()->route('login.index')->with('success', __('message.success_reset', ['data' => 'Password']));
        } else {
            return back()->withErrors('password', __('message.something_went_wrong'));
        }
    }
}
