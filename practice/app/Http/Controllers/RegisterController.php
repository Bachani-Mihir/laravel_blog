<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Contracts\Service\Attribute\Required;

class RegisterController extends Controller
{
    public function create(){
        return view("Register.create");
    }
    public function store(){
       $attributes = request()->validate([
            'name' => 'required|max:255',
            'user_id' => 'required|max:255|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:5|max:255',
        ]);

        $user = User::create($attributes);      // Creating New User
        auth()->login($user);                   // User Got Logged In
        return redirect('/home');
    }

}
