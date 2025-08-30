<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\AuthService;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct(private AuthService $auth) {}

    public function showRegister(){ return view('auth.register'); }
    public function showLogin(){ return view('auth.login'); }

    public function register(RegisterRequest $request){
        $this->auth->register($request->validated());
        return redirect()->route('dashboard')->with('success','Registered & logged in.');
    }

    public function login(LoginRequest $request){
        $data = $request->validated();
        if ($this->auth->attemptLogin($data['email'],$data['password'], (bool)($data['remember'] ?? false))) {
            $request->session()->regenerate();
            return redirect()->intended(route('dashboard'));
        }
        return back()->withErrors(['email'=>'Invalid credentials'])->onlyInput('email');
    }

    public function logout(){
        $this->auth->logout();
        return redirect()->route('login')->with('success','Logged out.');
    }
}
