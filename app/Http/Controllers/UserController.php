<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Actualizar OTRO usuario (Bloqueo, Rol, Resetear Clave)
    public function update(Request $request, User $user)
    {
        if (auth()->user()->rol !== 'admin') abort(403);

        $request->validate(['rol' => 'required']);

        $user->rol = $request->rol;
        $user->is_active = $request->has('is_active'); // Checkbox logic

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return back()->with('success', 'Usuario gestionado correctamente.');
    }

    // Borrar usuario
    public function destroy(User $user)
    {
        if (auth()->user()->rol !== 'admin') abort(403);
        
        if ($user->id === auth()->id()) {
            return back()->with('error', 'No puedes borrarte a ti mismo desde aquí.');
        }

        $user->delete();
        return back()->with('success', 'Usuario eliminado.');
    }
}