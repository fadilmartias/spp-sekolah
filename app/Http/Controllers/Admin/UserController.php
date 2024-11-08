<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\User\UserProcessPasswordRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\UserProcessRequest;

class UserController extends Controller
{

    public function index()
    {
        $users = User::all();
        return view("admin.user.index", compact('users'));
    }

    public function action($id = null)
    {
        $roles = Role::all();
        $data = [
            'roles' => $roles,
        ];
        // jika id != null, maka action = edit
        if ($id !== null) {
            $oldData = User::findOrFail($id);
            $data['oldData'] = $oldData;
        }
        return view("admin.user.action", $data);
    }

    public function process(UserProcessRequest $request)
    {
        $id = $request->input('id');
        $name = $request->input('name');
        $username = $request->input('username');
        $phone = $request->input('phone');
        $email = $request->input('email');
        $password = $request->input('password');
        $role = $request->input('role');
        $description = $request->input('description');
        $data = [
            'name' => $name,
            'username' => $username,
            'phone' => $phone,
            'email' => $email,
            'description' => $description,
        ];
        if($id === null) {
            $data['password'] = bcrypt($password);
        }
        $user = User::updateOrCreate(
            ['id' => $id],
            $data
        );

        if ($user->wasRecentlyCreated || ($user->roles->first()->name !== $role)) {
            $user->syncRoles([$role]);
        }
        return to_route("admin.user.index")->with('success', $user->wasRecentlyCreated ? __('message.success_create', ['data' => 'User']) : __('message.success_update', ['data' => 'User']));
    }

    public function processPassword(UserProcessPasswordRequest $request)
    {
        $id = $request->input('id');
        if ($id !== null) {
            User::findOrFail($id)->update(
                [
                    'password' => bcrypt($request->input('new_password'))
                ]
            );
        }
        return to_route('admin.user.index')->with('success', __('message.success_update', ['data' => 'Password']));
    }

    public function updateStatus(Request $request) {
        $id = $request->input('id');
        $status = (int)$request->input('status');
        User::findOrFail($id)->update(['status' => $status]);
        session()->flash('success', __('message.success_update', ['data' => 'Status']));
        return response()->json(['status' => 1, 'message' => __('message.success_update', ['data' => 'Status'])]);
    }

    public function delete($id)
    {
        User::findOrFail($id)->delete();
        return to_route("admin.user.index")->with('success', __('message.success_delete', ['data' => 'User']));
    }
}
