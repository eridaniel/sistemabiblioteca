@extends('layout/template')


@vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/css/main.css'])
@section('title', 'BIBLIOTECA')
@section('content')

<main>
    <div class="container py-0">
        <div class="card border-primary rounded-0" style="background-color: #62152d;">
            <div class="card-body p-2">
                <h2 class="card-title text-white">Información sobre el Cliente</h2>
                <form id="form-ver-cliente" action="{{url('clientes/'.$cliente->id)}}" method="show">
                    @method("SHOW")
                    @csrf 
                    <div class="mb-2">
                        <label for="nombre" class="form-label text-white">Nombre</label>
                        <input type="text" class="form-control" name="nombre" id="nombre" value="{{$cliente->nombre}}" readonly>
                    </div>
                    <div class="mb-2">
                        <label for="apellido" class="form-label text-white">Apellido</label>
                        <input type="text" class="form-control" name="apellido" id="apellido" value="{{$cliente->apellido}}" readonly>
                    </div>
                    <div class="mb-2">
                        <label for="direccion" class="form-label text-white">Dirección</label>
                        <input type="text" class="form-control" name="direccion" id="direccion" value="{{$cliente->direccion}}" readonly>
                    </div>
                    <div class="mb-2">
                        <label for="telefono" class="form-label text-white">Teléfono</label>
                        <input type="text" class="form-control" name="telefono" id="telefono" value="{{$cliente->telefono}}" readonly>
                    </div>
                    <div class="mb-2">
                        <label for="estatus" class="form-label text-white">Estatus</label>
                        <input type="int" class="form-control" name="estatus" id="estatus" value="{{$cliente->estatus}}" readonly>
                    </div>
                        <a href="{{url('clientes')}}" class="btn btn-secondary btn-sm-mb-2">Regresar</a>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection