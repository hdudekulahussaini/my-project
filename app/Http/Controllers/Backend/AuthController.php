<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class AuthController extends Controller
{
    public function showRegister()
    {
        return view('backend.pages.auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'user_type' => 'user',
        ]);
        return redirect()->route('index');
    }

    public function showLoginSelection()
    {
        return redirect()->route('login.user');
    }

    public function showUserLogin()
    {
        return view('backend.pages.auth.login-user');
    }

    public function showAdminLogin()
    {
        return view('backend.pages.auth.login-admin');
    }
    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'login_type' => 'required|in:user,admin',
        ]);
        if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
            $request->session()->regenerate();
            if (Auth::user()->user_type !== $data['login_type']) {
                Auth::logout();
                return back()->with('error', 'This login page is for ' . ucfirst($data['login_type']) . 's only.');
            }
            return redirect()->route($data['login_type'] === 'admin' ? 'admin.dashboard' : 'user.dashboard')
                ->with('success', 'Login successful. Welcome back!');
        }
        return back()->with('error', 'Invalid Email Or Password');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('index');
    }
}