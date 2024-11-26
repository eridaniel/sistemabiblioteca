@extends('layout/template')

@vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/css/main.css'])
@section('title', 'BIBLIOTECA')
@section('content')
<main>
    <div class="container d-flex align-items-center justify-content-center mt-4">
    </div>

    <div class="max-w-7xl mx-auto p-6 lg:p-8">
        <h2 class="text-center">Clientes</h2>
        
        <div class="container">
            <div class="row mb-2">
                <div class="col-md-8">
                    
                        <a href="{{url('clientes/create')}}" class="btn btn-outline-primary btn-sm-2">Agregar Cliente</a>
                   
                </div>
                <div class="col-md-4">
                    <form action="{{ route('clientes') }}" method="GET" class="d-flex">
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
                        @foreach ($clientes as $cliente) 
                        <tr>
                            <td>{{$cliente->id}}</td>
                            <td>{{$cliente->nombre}}</td>
                            <td>{{$cliente->apellido}}</td>
                            <td>{{$cliente->direccion}}</td>
                            <td>{{$cliente->telefono}}</td>
                            <td>
                            @if ($cliente->estatus == 0)
                            <span class="text-success">Activo</span>
                            @elseif ($cliente->estatus == 1)
                            <span class="text-danger">Inactivo</span>
                            @endif
                            </td>
                        <td>    
                            <div class="d-flex align-items-center justify-content-center">
                                <a href="{{ route('clientes.show', $cliente->id) }}" class="btn btn-info btn-sm-2 mr-3"><i class="fas fa-eye"></i> Ver</a>
                                @if (Auth::check() && Auth::user()->role && Auth::user()->role->name === 'admin')
                                    <a href="{{route('clientes.edit', $cliente->id)}}" class="btn btn-warning btn-sm-2 mr-3"><i class="fas fa-edit"></i> Editar</a> 
                                @endif
                            </div>
                        </td>
                        </tr>
                        @endforeach
                    </tbody>  
                </table>
            </div>
        </div>
    </div>
</main>
@endsection
