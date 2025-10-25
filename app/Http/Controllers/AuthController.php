<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function loginView() {
        return view('auth.login');
    }

    public function login(Request $request) {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        return back()->withErrors(['login_error' => 'Usuario o contraseña incorrectos.']);
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    public function dashboard() {
        $user = Auth::user();
        return view('dashboard', compact('user'));
    }

    public function registerView() {
    return view('auth.register');
}

// Guardar usuario
public function register(Request $request) {
    $request->validate([
        'name' => 'required|string|max:255',
        'username' => 'required|string|max:50|unique:users',
        'email' => 'required|email|unique:users',
        'password' => 'required|string|min:6|confirmed',
        'rol' => 'required|string'
    ]);

    \App\Models\User::create([
        'name' => $request->name,
        'username' => $request->username,
        'email' => $request->email,
        'rol' => $request->rol,
        'password' => \Illuminate\Support\Facades\Hash::make($request->password)
    ]);

    return redirect('/dashboard')->with('success', 'Usuario creado correctamente'); //REDIRIGIR A DASHBOARD CUANDO EL USUARIO ESTE CREADO
}
}
