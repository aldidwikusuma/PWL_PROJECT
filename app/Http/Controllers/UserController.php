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
        return view("admin.profile.edit",[
            "title" => 'User Edit Data']
        );
    }

    public function update(Request $request, User $user)
    {
        $this->validate($request,[
            'username' => 'numeric|unique:users,username,'.Auth::user()->id,
            'email' => 'email|unique:users,email,'.Auth::user()->id,
            'umur' =>'required|numeric',
            'jenis_kelamin' => 'required',
        ]);

        $userUpdate = User::where('username', $user->username);
        $userUpdate->email = $request->email;
        $userUpdate->umur = $request->umur;
        $userUpdate->jenisKelamin = $request->jenis_kelamin;
        $userUpdate->save();
        return redirect('/dashboard/user',Auth::user()->username) -> with('success', 'Data berhasil diubah');
    }
}
