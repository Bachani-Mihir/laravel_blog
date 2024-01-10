<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginFormRequest;
use Illuminate\Support\Facades\Gate;

class SessionController extends Controller
{
    public function destroy()
    {
        request()->user()->tokens()->delete();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function view()
    {
        if (auth()->check()) {
            if (auth()->check()) {
                // Check the user's role using the 'IsAdmin' gate
                if (Gate::allows('IsAdmin')) {
                    return redirect('/api/admin-home');
                } elseif (Gate::allows('IsUser')) {
                    return redirect('/api/home');
                }
            }
        }

        return view('login.create');
    }

    public function valid(LoginFormRequest $request)
    {
        if ($request->validated()) {
            $role = $request->authenticate();

            if ($role == 'admin' || $role == 'user') {
                $tokenName = ucfirst($role).'Token';
                $token = $request->user()->createToken($tokenName, [$role])->plainTextToken;

                return response()->json([        // For Back-End
                    'token' => $token,
                    'role' => $role,
                ]);
            //return redirect('/api/home');
            } else {
                return response()->json(['error' => 'Invalid password.'], 401);
            }
        }
    }
}
