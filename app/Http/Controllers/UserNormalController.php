<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginFormRequest;
use App\Http\Requests\LoginRequest;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\UserNormal;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class UserNormalController extends Controller
{
    private $user;
private $order;
private $order_detail;
    public function __construct(UserNormal $user,Order $order,OrderDetail $order_detail)
    {
        $this->user = $user;
        $this->order = $order;
        $this->order_detail = $this->order_detail;
    }

    public function loginForm()
    {
        if (auth('site')->check()) {
            return redirect(route('/'));
        } else {
            return view('site.login.login');
        }
    }

    public function resisterForm()
    {
        if (auth('site')->check()) {
            return redirect(route('/'));
        } else {
            return view('site.login.resister');
        }

    }

    public function resister(LoginRequest $request)
    {
        $this->user->create(['name' => $request->name, 'email' => $request->email, 'password' => bcrypt($request->password),]);
        return redirect(route('login.form'));
    }

    public function login(LoginFormRequest $request)
    {
        $remember = $request->has('remember_me') ? true : false;
        if (auth('site')->attempt(['email' => $request->email, 'password' => $request->password], $remember)) {
            return redirect()->intended();
        } else {
            return redirect()->back()->withErrors(['email' => 'Email or password is false.']);
        }
    }

    public function profile()
    {
        return view('site.user.profile');
    }

    public function logout(Request $request): RedirectResponse
    {

        \auth('site')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        return redirect()->to('/');
    }

    public function changePass()
    {
        return view('site.user.change-pass');
    }

    public function changePassPost(Request $request)
    {
        $user = $this->user->find(\auth('site')->user()->id);

        if (Hash::check($request->oldPass, $user->password)) {

            $user->update(['password' => bcrypt($request->newPass),]);
            if ($request->keep_me != null) {
                return back();
            } else {
                \auth('site')->logout();

                $request->session()->invalidate();

                $request->session()->regenerateToken();

                return redirect()->to('/');
            }
        }


    }
    public function order()
    {
        $user=auth('site')->user();
        $order =$this->order->where('id_user',$user->id)->latest()->get();
        return view('site.user.order',compact('order'));
    }
    public function orderDetail($id)
    {
        $order=$this->order->find($id);
        return view('site.user.order-detail',compact('order'));
    }
    public function orderCheck($id)
    {
        $this->order->find($id)->update([
            'status'=>'success'
        ]);
        return redirect()->to(route('user.order'));
    }
}
