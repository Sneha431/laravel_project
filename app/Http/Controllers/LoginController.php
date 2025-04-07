<?php

namespace App\Http\Controllers;

use Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use App\Models\User;

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
        $username = User::where("email", $request->email)->first();

        if (Auth::attempt($credentials)) {
            $request->session()->put('username', $username->name);
            $request->session()->put('userid', $username->id);
            return redirect()->intended(route("home.index"));
        }
        return redirect(to: "login")->with("error", "Invalid email or password");
    }
        public function passwordedit(Request $request)
    {
      

      
       

     
         $validator = Validator::make(
            $request->all(),
            [
            "email" => "required|email",
                "password" => [
                    "required",
                    "min:8",
                    "regex:/^(?=.*[a-zA-Z])(?=.*\d)(?=.*[\W_]).+$/"
                ]
        ],[]
            ,[]
        );

       if ($validator->fails()) {
       return redirect()->route("password.edit")->withInput()->withErrors($validator);
        //  return redirect(route("signup"))->withInput()->with("error", $validator->errors());
        }
        User::where("email", $request->email)->update(["password"=>Hash::make($request->password)]);
        return redirect(to: "passwordedit")->with("error", "Invalid email or password");
    }
    public function logout()
    {
        Auth::logout();
        Session::flush();
        //This is a method from Laravel's Auth facade that logs out the currently authenticated user.
        // When called, it will: Clear the user's session data. Invalidate the session token 
        //(if you're using token-based authentication).
        // Effectively log out the user, so they are no longer authenticated.
        return redirect("login");
    }
    public function reset()
    {
        return view("auth.password_reset");
    }
}
