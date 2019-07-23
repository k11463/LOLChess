<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function store(Request $req)
    {
        $user = new User();
        $user->fill($req->all());
        $user->token = str_random(60);
        $user->save();

        return '註冊成功';
    }

    public function login(Request $req)
    {
        $user = User::where('account', '=', $req->account)->first();
        if ($user->password == $req->password) {
            return $user;
        }
        return '密碼不一致';
    }

    public function update(Request $request, User $user)
    {
        //
    }

    public function destroy(User $user)
    {
        //
    }
}
