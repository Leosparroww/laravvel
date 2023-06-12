<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //direct login Page
    public function loginPage()
    {
        return view('login');
    }
    //dirct register Page
    public function registerPage()
    {
        return view('register');
    }
    //dashboard
    public function dashboard()
    {
        if (Auth::user()->role == 'user') {
            return redirect()->route('user#home');
        } else {
            return redirect()->route("category#list");
        }
    }

}
