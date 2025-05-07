<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\AuthorRequest;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    public function login(){
        if (Auth::check()){
            return redirect('/');
        }
        return view('auth.login');
    }

    public function certification(Request $request){
        $data = $request->only('email', 'password');
        if (Auth::attempt($data)){
            $request->session()->regenerate();
            return redirect()->intended('/');
        } else {
            return redirect('login')->with('message', 'ログイン認証に失敗しました。');
        }
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('message', 'ログアウトしました。');
    }

    public function register(Request $request){
        return view('auth.register');
    }

    public function create(AuthorRequest $request){
        $credentials = $request->only('name', 'email', 'password');
        User::create($credentials);
        return redirect('login');
    }
}
