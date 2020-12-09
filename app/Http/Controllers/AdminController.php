<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function loginAdmin()
    {
        return view('admin.login');
    }

    public function logoutAdmin()
    {
        Auth::logout();
        return redirect()->to('login');
    }

    public function postLoginAdmin(Request $request)
    {
        $rememberMe = $request->remember_me;
        if(auth()->attempt([
            'email' => $request->email,
            'password' => $request->password,
        ], $rememberMe)) {
            return redirect()->to('admin');
        } else {
            return redirect()->to('login');
        }
    }
}
