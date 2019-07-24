<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ErrorMsg
{
    public $error;
}

class UserController extends Controller
{
    public function store(Request $req)
    {
        $error = new ErrorMsg();
        if (User::where('name', '=', $req->name)->first()) {
            $error->error = '名稱重複 註冊失敗';
            return json_encode($error);
        } else if (User::where('account', '=', $req->account)->first()) {
            $error->error = '帳號重複 註冊失敗';
            return json_encode($error);
        } else {
            $user = new User();
            $user->fill($req->all());
            if ($req->name == "Brian") {
                $user->level = "菁英";
            }
            $user->password = Hash::make($req->password);
            $user->token = str_random(60);
            $user->save();

            return '註冊成功';
        }
    }

    public function login(Request $req)
    {
        $error = new ErrorMsg();
        if ($user = User::where('account', '=', $req->account)->first()) {
            $user = User::where('account', '=', $req->account)->first();
            if (Hash::check($req->password, $user->password)) {
                return $user;
            }
        }
        $error->error = '帳號或密碼錯誤';
        return json_encode($error);
    }

    public function loginToken(Request $req)
    {
        $user = User::where('token', '=', $req->token)->first();
        return $user;
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
