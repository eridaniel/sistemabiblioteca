<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function login(){

        // Validar los datos de entrada
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        // Intentar autenticar al usuario
        if (Auth::attempt($request->only('email', 'password'))) {
            // Autenticación pasada, redirigir al usuario a la ruta deseada
            return redirect()->route('index'); // Cambia esto según tu ruta
        }

    }

    public function register(Request $request){
        $user = new User();
        
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        $user->save();
        Auth::login($user);

        return redirect(route('index'));
    }
    //
    public function logout(Request $request){
        Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect(route('login'));
    }
    


}
