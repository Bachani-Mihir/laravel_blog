<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationFormRequest;
use App\Models\User;

class RegisterController extends Controller
{
    public function create()
    {
        return view('Register.create');
    }

    public function store(RegistrationFormRequest $request)
    {
        $user = User::create($request->validated());                 // Creating New User
        auth()->login($user);

        if ($user) {
            /* return response()->json([                               // for back-end
                "message"=> "User Registered Successfully",
            ]); */
            return redirect('/api/home');
        } else {
            /* return response()->json([
                "message"=> "User Not Registered Successfully",
            ]); */
            return redirect('/');
        }
    }
}
