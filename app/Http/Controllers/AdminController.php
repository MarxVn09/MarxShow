<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class AdminController extends Controller
{
    public function loginAdmin()
    {
        if(auth()->check()){
            return redirect()->route('admin.home');
        }
        return view('login');
    }
    public function home()
    {
        if(\auth('web')->user()){
            return view('home');
        }
        else{
            return redirect()->to(route('loginAdmin'));
        }
    }
    public function postLoginAdmin(Request $request)
    {
        $remember =$request->has('remember_me')?true :false;
        if(auth()->attempt([
            'email'=>$request->email,
            'password'=>$request->password
        ]
        ,$remember))
        {
            return redirect()->to('admin/home');
        }
    }
    public function logoutAdmin(Request $request): RedirectResponse
    {

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();


        return redirect()->to('admin/');
    }
}
