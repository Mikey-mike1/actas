<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = auth()->user();
        $usersList = null;

        // Si es Admin o Supervisor, buscamos la lista de usuarios
        if ($user->rol === 'admin' || $user->rol === 'supervisor') {
            $usersList = User::paginate(10); 
        }

        return view('opciones', [
            'user' => $user,
            'usersList' => $usersList // Pasamos la lista (será null si es usuario normal)
        ]);
    }

    // (La función update se queda igual que antes para cambiar tu propia clave)
    public function update(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        $request->user()->update(['password' => Hash::make($request->password)]);

        return back()->with('status', '¡Tu contraseña ha sido actualizada!');
    }
}