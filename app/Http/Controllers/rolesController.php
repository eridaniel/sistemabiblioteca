<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\rol;

class rolesController extends Controller
{
    //
    public function assignRole($userId)
    {
        
        $user = User::findOrFail($userId);

        
        $adminRole = rol::where('name', 'admin')->first();
        $userRole = rol::where('name', 'usuario')->first();

        
        $user->role()->associate($adminRole);
        $user->save();
    }
}

/*<main>
    <div class="container py-0">
        <h2 class="card-title text-white">Eliminar Préstamo</h2>
        <form action="{{url('prestamos/'.$prestamo->id)}}" method="post">
            @method('delete')
            @csrf
            <table class="table">
                <tr>
                    <td><label for="cliente_id" class="fuente">Cliente</label></td>
                    <td>
                        <select class="form-control" name="cliente_id" id="cliente_id">
                            <option value="">Selecciona un cliente</option>
                                @foreach($clientes as $cliente)
                            <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
                                @endforeach
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label for="libro_id" class="fuente">Libro</label></td>
                    <td>
                        <select class="form-control" name="libro_id" id="libro_id">
                            <option value="">Selecciona un libro</option>
                                @foreach($libros as $libro)
                            <option value="{{ $libro->id }}">{{ $libro->titulo }}</option>
                                @endforeach
                        </select>
                    </td>
                </tr>
                <tr> 
                    <td><label for="fecha_prestamo" class="fuente">Fecha-Préstamo</label></td>
                    <td><input type="date" class="form-control" name="fecha_prestamo" id="fecha_prestamo"></td>
                </tr>
                <tr> 
                    <td><label for="fecha_devolucion" class="fuente">Fecha-Devolución</label></td>
                    <td><input type="date" class="form-control" name="fecha_devolucion" id="fecha_devolucion"></td>
                </tr>
                <tr> 
                    <td><label for="cantidad" class="fuente">Cantidad</label></td>
                    <td><input type="date" class="form-control" name="cantidad" id="cantidad"></td>
                </tr>
                <tr> 
                    <td><label for="estatus" class="fuente">Estatus</label></td>
                    <td><input type="date" class="form-control" name="estatus" id="estatus"></td>
                </tr>
            </table>                 
        </form>
    </div>
</main>
@endsection*/
