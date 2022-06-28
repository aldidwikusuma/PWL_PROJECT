<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

    public function update(User $user)
    {
        return view("admin.profile.index");
    }
}
