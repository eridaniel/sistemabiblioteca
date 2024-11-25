<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Configuraciones;
use Illuminate\Http\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

class Mantenimiento
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $configuraciones = configuraciones::where('name', 'mantenimiento')->first();

        if($configuraciones && $configuraciones->state && !auth::check()){
            return redirect('/mantenimiento');
        }
        
        return $next($request);
    }
}
