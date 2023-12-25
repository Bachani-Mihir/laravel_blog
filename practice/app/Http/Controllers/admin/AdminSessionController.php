<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
class AdminSessionController extends Controller
{
    public function view(){
        return view("admin.login");
    }
    public function valid(){                            // Check If Admin Exists
        $attributes = request()->validate([
            "email" => "required|exists:users",
            "password" => "required"
        ],[
            'email.exists' => 'Entered Email Is Not Registered. So Please Register First!',
        ]);

        if (@auth()->attempt($attributes)){     // When Admin Successfully Logged In
            session()->regenerate();
            $user = User::where('email', $attributes['email'])->first();
            session(['user_id' => $user->user_id]);
            return redirect("/admin-home");
        }else {
            return back()->withInput()->withErrors(['password' => 'Invalid password.']);
        }
    }
}
