<?php

namespace App\Http\Controllers;

use Error;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Exists;

class SessionController extends Controller
{
    public function destroy(){
        auth()->logout();
        return redirect("/login");
    }
    public function view(){
        if (auth()->check()) {
            $user_id = auth()->user()->user_id;

            if ($user_id == session('user_id')){
                request()->session()->regenerate();
                return redirect("/home");
                //@dd("YOu Are Already Logged In");
            }
        }
        return view("login.create");
    }
    public function valid()
    {
        $attributes = request()->validate([
            "email" => "required|exists:users",
            "password" => "required"
        ],[
            'email.exists' => 'Entered Email Is Not Registered. So Please Register First!',
        ]);

        if (@auth()->attempt($attributes)){
            session()->regenerate();
            $user_id = auth()->user()->user_id;
            session(['user_id' => $user_id]);

            if(@auth()->user()->role == 'admin'){
                return redirect("/admin-home");
            }
            return redirect("/posts");
        }else {
            return back()->withInput()->withErrors(['password' => 'Invalid password.']);
        }
    }

}
