<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class WebAuthController extends Controller
{
    public function showLogin()
    {
        if (auth()->check()) {
            return redirect('/dashboard');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);
        $user = User::where('name', $data['name'])->first();
        if (!$user || !Hash::check($data['password'], $user->password)) {
            return back()->withErrors(['name' => 'Invalid credentials'])->withInput();
        }
        auth()->login($user, true);
        return redirect('/dashboard');
    }

    public function showRegister()
    {
        if (auth()->check()) {
            return redirect('/dashboard');
        }
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'student',
        ]);
        auth()->login($user, true);
        return redirect('/dashboard');
    }

    public function logout()
    {
        auth()->logout();
        return redirect('/login');
    }

    public function showLogout()
    {
        if (!auth()->check()) {
            return redirect('/login');
        }
        return view('auth.logout');
    }
}
