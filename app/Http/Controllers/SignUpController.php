<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class SignUpController extends Controller
{
    //
    public function signup()
    {
        return view("auth.signup");
    }
    public function registeruser(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                "email" => "required|email",
                "password" => [
                    "required",
                    "min:8",
                    "regex:/^(?=.*[a-zA-Z])(?=.*\d)(?=.*[\W_]).+$/"
                ],
                "fname" => [
                    "required",
                    "min:5",
                    "regex:/^[A-Za-z]+$/"
                ],
                "lname" => [
                    "required",
                    "min:5",
                    "regex:/^[A-Za-z]+$/"
                ],
                "phone" => [
                    "required",
                    "digits:9"
                ]
                ],[]
            ,[
                "fname"=>"First Name",
                 "lname"=>"Last Name",
                  "phone"=>"Phone Number",
            ]
        );

       if ($validator->fails()) {
       return redirect()->route("signup")->withInput()->withErrors($validator);
        //  return redirect(route("signup"))->withInput()->with("error", $validator->errors());
        }

        $user = new User();
        $user->name = $request->fname . " " . $request->lname;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->phone = $request->phone;
        $user->remember_token = Str::random(60);

        $user->email_verified_at = now();

        if ($user->save()) {
            return redirect()->intended(route("login"))->with("success", "You have been registered successfully");
        }
        return redirect(route("signup"))->with("error", "Something went wrong");
    }
}
