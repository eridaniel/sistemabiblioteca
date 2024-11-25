<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificacionController extends Controller
{
    //
    public function leerNoti($id){
        $notificacion = Auth::user()->notifications()->find($id);

        if($notificacion){
            $notificacion->markAsRead();

            $this->actualizarContadorNotificaciones(auth()->user());
            return redirect()->route('prestamos');
        }
    }

    private function actualizarContadorNotificaciones($user){
        $user->unreadNotifications;
    }
}
