<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
        return view('client.auth.login');
    }

    public function register()
    {
        return view('client.auth.register');
    }

    public function forget()
    {
        return view('client.auth.forget_password.forget');
    }

    public function change()
    {
        return view('client.auth.forget_password.change');
    }

    public function active()
    {

    }

    public function logout()
    {
        
    }




}
