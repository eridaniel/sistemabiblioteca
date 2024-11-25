@extends('layout/template')

@vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/css/main.css'])
@section('title', 'BIBLIOTECA')
@section('content')
<main>
    <div class="container d-flex align-items-center justify-content-center mt-4">
    </div>

    <div class="max-w-7xl mx-auto p-6 lg:p-8">
    <h2 class="text-center">Libros</h2>
    
    <div class="container">
    <div class="row mb-2">
        <div class="col-md-8">
        @if(Auth::check() && Auth::user()->role && Auth::user()->role->name === 'admin')
            <a href="{{route('libros.create')}}" class="btn btn-outline-primary btn-sm-2">Agregar Libro</a>
        @endif
        </div>
        <div class="col-md-4">
        <form action="{{ route('libros') }}" method="GET" class="d-flex">
            <select name="categoria" id="cateogria" class="form-control me-2" onchange="this.form.submit()">
                <option value="">Todas las Categorías</option>
                @foreach ($categorias as $categoria)
                <option value="{{ $categoria->id }}" {{ request('categoria') == $categoria->id ? 'selected' : '' }}>
                    {{ $categoria->nombre }}
                </option>
                @endforeach
            </select>
            
            <input type="text" name="buscar" class="form-control ms-2" placeholder="Buscar libro..." value="{{ request('buscar') }}">
            <button type="submit" class="btn btn-outline-success ms-2">Buscar</button>
        </form>
        </div>
    </div>
        <div class="row">
            
            <table class="table table-bordered table-dark text-center">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Titulo</th>
                        <th>Categoría</th>
                        <th>Cantidad</th>
                        <th>Editorial</th>
                        <th>ISBN</th>
                        <th>Ubicación</th>
                        <th>Observaciones</th>
                        <th>Estatus</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($libros as $libro) 
                    <tr>
                        <td>{{$libro->id}}</td>
                        <td>{{$libro->titulo}}</td>
                        <td>{{$libro->category->nombre}}</td>
                        <td>{{$libro->cantidad}}</td>
                        <td>{{$libro->editorial}}</td>
                        <td>{{$libro->isbn}}</td>
                        <td>{{$libro->ubicacion}}</td>
                        <td>{{$libro->observaciones}}</td>
                        <td>
                            @if($libro->estatus == 0)
                            <span class="text-success">Disponible</span>
                            @elseif($libro->estatus == 1)
                            <span class="text-danger">Agotado</span>
                            @endif
                        </td>
                    <td>    
                            <div class="d-flex align-items-center justify-content-center">

                                <a href="{{ route('libros.show', $libro->id) }}" class="btn btn-info btn-sm-2 mr-3"><i class="fas fa-eye"></i> Ver</a>
                                @if (Auth::check() && Auth::user()->role && Auth::user()->role->name === 'admin')
                                        <a href="{{route('libros.edit', $libro->id)}}" class="btn btn-warning btn-sm-2 mr-3"><i class="fas fa-edit"></i> Editar</a> 
                                        <a href="{{ route('libros.delete', $libro->id) }}" class="btn btn-danger btn-sm-2 mr-3"><i class="fas fa-trash"></i>Eliminar</a> 
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