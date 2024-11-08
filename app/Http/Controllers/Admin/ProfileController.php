<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Admin\Profile\UpdateProfileRequest;
use App\Http\Requests\Admin\Profile\UpdatePasswordRequest;

class ProfileController extends Controller
{
    public function index()
    {
        return view("admin.profile.index");
    }

    public function edit()
    {
        return view("admin.profile.edit");
    }

    public function update(UpdateProfileRequest $request)
    {
        User::findOrFail(Auth::id())->update([
            'name' => $request->input('name'),
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'description' => $request->input('description'),
        ]);
        return to_route('admin.profile.index')->with('success', __('message.success_update', ['data' => 'Profile']));
    }

    public function updatePassword(UpdatePasswordRequest $request)
    {
        User::findOrFail(Auth::id())->update(
            [
                'password' => bcrypt($request->input('new_password'))
            ]
        );
        return to_route('admin.profile.index')->with('success', __('message.success_update', ['data' => 'Password']));
    }
}
