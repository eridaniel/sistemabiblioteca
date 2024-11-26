@extends('layout/template')


@vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/css/main.css'])
@section('title', 'BIBLIOTECA')
@section('content')
<main>
    <div class="container d-flex align-items-center justify-content-center mt-4">
    </div>

    <div class="max-w-7xl mx-auto p-6 lg:p-8">
    <h2 class="text-center">Clientes Inactivos</h2>
    
    <div class="container">
    <div class="row mb-2">
        <div class="col-md-8">
      
        </div>
        <div class="col-md-4">
            <form action="{{ route('inactivos') }}" method="GET" class="d-flex">
                <input type="text" name="buscar" class="form-control" placeholder="Buscar cliente..." value="{{ request()->get('buscar') }}">
                <button type="submit" class="btn btn-outline-success ms-2">Buscar</button>
            </form>
        </div>
    </div>
        <div class="row">
            
            <table class="table table-bordered table-dark text-center">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Dirección</th>
                        <th>Teléfono</th>
                        <th>Estatus</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($clientesIna as $clienteIna) 
                    <tr>
                        <td>{{$clienteIna->id}}</td>
                        <td>{{$clienteIna->nombre}}</td>
                        <td>{{$clienteIna->apellido}}</td>
                        <td>{{$clienteIna->direccion}}</td>
                        <td>{{$clienteIna->telefono}}</td>
                        <td>
                        @if ($clienteIna->estatus == 0)
                            <span class="text-success">Activo</span>
                            @elseif ($clienteIna->estatus == 1)
                            <span class="text-danger">Inactivo</span>
                            @endif
                        </td>
                    <td>    
                            <div class="d-flex align-items-center justify-content-center">
                                <a href="{{ route('inactivos.moverActivo', $clienteIna->id) }}" class="btn btn-danger btn-sm-2 mr-3"><i class="fas fa-trash"></i>Eliminar</a> 
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>  
</main>
@endsection