<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function login()
    {
        return view("auth.login");
    }
    public function loginpost(Request $request)
    {
        $request->validate([
            "email" => "required",
            "password" => "required"
        ]);

        $credentials = $request->only("email", "password");


        if (Auth::attempt($credentials)) {
            return redirect()->intended(route("home.index"));
        }
        return redirect(to: "login")->with("error", "Invalid email or password");
    }

    public function reset()
    {
        return view("auth.password_reset");
    }
}