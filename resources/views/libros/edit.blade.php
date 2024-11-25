@extends('layout/template')


@vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/css/main.css'])
@section('title', 'BIBLIOTECA')
@section('content')

<main>
    <div class="container py-0">
        <div class="card border-primary rounded-0" style="background-color: #62152d;">
            <div class="card-body p-2">
                <h2 class="card-title text-white">Editar Libro</h2>
                <form id="form-editar-libro" action="{{url('libros/'.$libro->id)}}" method="post">
                    @method("PUT")
                    @csrf 
                    <div class="mb-2">
                        <label for="titulo_libro" class="form-label text-white">Título</label>
                        <input type="text" class="form-control" name="titulo" id="titulo" value="{{$libro->titulo}}" required>
                    </div>
                    <div class="mb-2">
                        <label for="categoria" class="form-label text-white">Categoría</label>
                        <select name="categoria" id="categoria" class="form-control">
                            <option value="">Seleccione una categoría</option>
                            @foreach($categorias as $category)
                            <option value="{{$category->id}}" @if ($category->id == $libro->categoria_id) {{'selected'}} @endif> {{$category->nombre}}</option>
                        @endforeach
                        </select>
                    </div>
                    <div class="mb-2">
                        <label for="cantidad" class="form-label text-white">Cantidad</label>
                        <input type="number" class="form-control" name="cantidad" id="cantidad" value="{{$libro->cantidad}}" required>
                    </div>
                    <div class="mb-2">
                        <label for="edit_libro" class="form-label text-white">Editorial</label>
                        <input type="text" class="form-control" name="editorial" id="editorial" value="{{$libro->editorial}}" required>
                    </div>
                    <div class="mb-2">
                        <label for="isbn" class="form-label text-white">ISBN</label>
                        <input type="text" class="form-control" name="isbn" id="isbn" value="{{$libro->isbn}}" required>
                    </div>
                    <div class="mb-2">
                        <label for="ubicacion" class="form-label text-white">Ubicación</label>
                        <input type="int" class="form-control" name="ubicacion" id="ubicacion" value="{{$libro->ubicacion}}" required>
                    </div>
                    <div class="mb-2">
                        <label for="observaciones" class="form-label text-white">Observaciones</label>
                        <input type="text" class="form-control" name="observaciones" id="observaciones" value="{{$libro->observaciones}}" required>
                    </div>
                    <div class="mb-2">
                        <label for="estatus" class="form-label text-white">Estatus</label>
                        <input type="int" class="form-control" name="estatus" id="estatus" value="{{$libro->estatus}}" required>
                    </div>
                        <button type="submit" class="btn btn-success btn-sm-mb-2">Guardar</button>
                        <a href="{{url('libros')}}" class="btn btn-secondary btn-sm-mb-2">Regresar</a>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection