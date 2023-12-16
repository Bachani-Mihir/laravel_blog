<?php

namespace App\Http\Controllers;

use Error;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Exists;

class SessionController extends Controller
{
    public function destroy()
    {
        auth()->logout();
        return redirect("/register");
    }

    public function view()
    {
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

        if (@auth()->attempt($attributes)) {
            session()->regenerate();
            return redirect("/home");
        }else {
            return back()->withInput()->withErrors(['password' => 'Invalid password.']);
        }
    }
}
