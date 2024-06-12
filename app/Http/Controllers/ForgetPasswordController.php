<?php

namespace App\Http\Controllers;

use App\Http\Requests\ForgetPasswordRequest;
use App\Mail\SendMail;
use App\Models\UserNormal;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;


class ForgetPasswordController extends Controller
{
    public function forgetPassword()
    {
        return view('site.user.forget-password');
    }

    public function forgetPasswordPost(ForgetPasswordRequest $request)
    {
        $user =DB::table('user_normals')->where(['email' => $request->email])->first();
        $token = Str::random(64).$user->id;
        $check = DB::table('password_reset_tokens')->where(['email' => $request->email])->first();
        if(!$check){
            DB::table('password_reset_tokens')->insert(['email' => $request->email, 'token' => $token, 'created_at' => Carbon::now()]);
        }
        else{
            DB::table('password_reset_tokens')->update(['token' => $token, 'created_at' => Carbon::now()]);
        }
        Mail::to($request->email)->send(new \App\Mail\SendMail($token));
        return redirect()->to(route('forget.password'))->with("success", "We have send you reset password link");
    }

    public function resetPassword($token)
    {
        return view('email.new-password', compact('token'));

    }

    public function resetPasswordPost(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:user_normals', 'password' => 'required|string|min:6', 'confirm_password' => 'required|same:password']);
        $updatePassword = DB::table('password_reset_tokens')->where(['email' => $request->email, 'token' => $request->token])->first();
        if (!$updatePassword) {
            return back()->with('error', 'Invalid');
        }
        UserNormal::where('email', $request->email)->update(['password' => Hash::make($request->password),]);
        DB::table('password_reset_tokens')->where(['email' => $request->email,])->delete();
        return redirect()->to(route('login.form'))->with('success', 'Password reset success');
    }
}
