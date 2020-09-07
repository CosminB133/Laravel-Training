<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'password'=> 'required',
        ]);
        if (
            config('services.admin.user') == $request['username']
            && config('services.admin.pass') == $request['password']
        ) {
            $request->session()->put('auth', true);
            return redirect('/products');
        }
        return redirect('/login')->withErrors(['failed_login' => 'Wrong username or password!']);
    }
}
