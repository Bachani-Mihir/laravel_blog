<?php

namespace App\Http\Controllers;

use Illuminate\Mail\Mailer;
use Illuminate\Support\Facades\Mail;
use App\mail\ForgotPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\User;

use App\Models\Password_Reset;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;

class UserController extends Controller
{
    public function forgot_password(){

    /* $user = User::where("email","")->first();
    $user_id = $user->user_id;

    $token = Str::random(60);
 */        return view('components.forgot-password');
    }

    public function change_password(){
        $email = request()->input('email');

        return view('components.change-password',['email'=>$email]);
    }

    public function send_mail()
    {
    //    $reset_link = "/"; // Generate the reset link
    $user = User::where("email",request()->input("email"))->first();
    $user_id = $user->user_id;
    $email = $user->email;
    $token = Str::random(60);
    $attributes = [$email,$token];
    $reset_password = Password_Reset::create($attributes);
    $reset_link = URL::signedRoute('password.reset', ['email' => $email, 'token' => $token]);
    // Send the email
        Mail::to(request()->input('email'))->send(new ForgotPassword($reset_link));
        return $reset_password;
        //return redirect()->back()->with('status', 'Password reset link sent successfully!');
}

    public function update_password(){
        $email = $_POST['email'];
        $user_id = session('user_id');
        $user = User::where('email', $email)->first();
        $user_id = $user->user_id;
        $new_password = $_POST['new_password'];
        //@dd("Password Updated uccessfully",$new_password);
        $RowAffected = User::where('user_id', $user_id)->update([
            'password' => bcrypt($new_password),
        ]);
        if ($RowAffected) {
            return redirect('/login');
        }else{
            @dd("No Row Affected");
        }

    }
}
