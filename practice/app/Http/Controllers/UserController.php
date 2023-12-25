<?php

namespace App\Http\Controllers;

use Carbon\Carbon;                                                  // for setting expiration
use Illuminate\Mail\Mailer;
use Illuminate\Support\Facades\Mail;                                // for mailing
use App\mail\ForgotPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\password_resets;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;

class UserController extends Controller
{
    public function forgot_password(){
          return view('components.forgot-password');
    }

    public function verify_token(){
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
            if($user->token == request()->token){
                return view('components.change-password',['email' => $email]);
            }
        }

        abort(403,"Unauthorized User");
    }
    public function change_password(){
        return view('components.change-password');
    }

    public function send_mail(){
        $user = User::where("email",request()->input("email"))->first();
        $expirationTime = Carbon::now()->addMinutes(1); // Set the expiration time
        $user_id = $user->user_id;
        $email = $user->email;
        $token = Str::random(60);
        $attributes =  [
                'email' => $email,
                'token' => $token,
        ];
        $reset_password = password_resets::create($attributes);
        $reset_link = route('password-reset', [
            'any' => '?' . http_build_query([
                'email' => $email,
                'token' => $token,
                'expires' => $expirationTime->timestamp,
            ]),
        ]);
        $sent_link = Mail::to($email)->send(new ForgotPassword($reset_link)); // Sends Mail
        @dd("email Sent Successfully");
    }

    public function update_password(){
        $email = $_POST['email'];
        $user_id = session('user_id');
        $user = User::where('email', $email)->first();
        $user_id = $user->user_id;
        $new_password = $_POST['new_password'];
        $RowAffected = User::where('user_id', $user_id)->update([
            'password' => bcrypt($new_password),
        ]);
        if ($RowAffected) {
            return redirect('/login');
        }else{
            @dd("Error");
        }
    }
}
