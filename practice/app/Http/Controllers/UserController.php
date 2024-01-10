<?php

namespace App\Http\Controllers;

use App\Http\Requests\SendMailRequest;
use App\Http\Requests\UpdatePasswordRequest;
use App\mail\ForgotPassword;                                                  // for setting expiration
use App\Models\password_resets;                                // for mailing
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function forgot_password()
    {
        return view('components.forgot-password');
    }

    public function verify_token()
    {
        $email = request()->query('email');
        $token = request()->query('token');

        $expires = request()->expires;
        $expirationTime = Carbon::createFromTimestamp($expires);

        if ($expirationTime->isPast()) {
            // The link has expired
            $delete_token = password_resets::where('token', $token)->delete();

            return response()->json(['message' => 'Password reset link has expired'], 400);
        }

        $user_tokens = password_resets::where('email', '=', $email)->get();

        foreach ($user_tokens as $user) {
            if ($user->token == request()->token) {
                return view('components.change-password', ['email' => $email]);
            }
        }
        abort(403, 'Unauthorized User');
    }

    public function change_password()
    {
        return view('components.change-password');
    }

    public function send_mail(SendMailRequest $request)
    {

        if ($request->validated()) {
            $user = User::where('email', $request->email)->first();
            $expirationTime = Carbon::now()->addMinutes(10); // Set the expiration time
            $user_id = $user->user_id;
            $email = $user->email;
            $token = Str::random(60);
            $attributes = [
                'email' => $email,
                'token' => $token,
                'email_verified_at' => now(),
            ];
            $reset_password = password_resets::create($attributes);
            $reset_link = route('password-reset', [
                'any' => '?'.http_build_query([
                    'email' => $email,
                    'token' => $token,
                    'expires' => $expirationTime->timestamp,
                ]),
            ]);
            $sent_link = Mail::to($email)->send(new ForgotPassword($reset_link)); // Sends Mail

            return response()->json(['message' => 'success']);

        }
    }

    public function update_password(UpdatePasswordRequest $request)
    {
        $email = request()->email;
        $user = User::where('email', $email)->first();
        $user_id = $user->user_id;
        $new_password = request()->new_password;
        $RowAffected = User::where('user_id', $user_id)->update([
            'password' => bcrypt($new_password),
        ]);
        if ($RowAffected) {
            // return response()->json(['message' => "success"]);   // for backend
            return redirect('/login');
        } else {
            return response()->json(['message' => 'failed']);
        }
    }

    public function php_info()
    {
        return phpinfo();
    }
}
