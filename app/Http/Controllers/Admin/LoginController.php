<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{

    use AuthenticatesUsers;

    protected $redirectTo = '/admin';
 public function showLoginForm(){
     return view('admin.auth.login');
 }
public function logout(){
    $this->guard()->logout();

        session()->invalidate();

        return  redirect('/admin/login');
}
}
