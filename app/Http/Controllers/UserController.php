<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;

class UserController extends Controller
{
    public function index(User $user)
    {
        return view(config("data.view.admin.users.index"), [
            "user" => $user,
            "title" => 'User'
        ]);
    }

    public function edit(User $user)
    {
        return abort(403);
        return view("admin.profile.edit",[
            "title" => 'User Edit Data']
        );
    }

    public function update(Request $request, User $user)
    {
        return abort(403);
        $rulesData = [
            'umur' => 'required|integer|between:5,50',
            'jenis_kelamin' => 'required',
        ];

        if ($user->email != $request->email) {
            $rulesData['email'] = 'required|email|unique:users';
        }

        if ($user->username != $request->username) {
            $rulesData['username'] = 'required|unique:users';
        }

        $validatedData = $request->validate($rulesData);

        return dd($validatedData);

        User::where("username", $user->username)->update($validatedData);

        return redirect(route("users.index", $user->username))->with('success', 'Profile has been updated');
    }
}
