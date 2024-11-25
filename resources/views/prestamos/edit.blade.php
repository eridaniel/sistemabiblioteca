@extends('layout/template')

@vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/css/main.css'])
@section('title', 'BIBLIOTECA')
@section('content')

<main>
    <div class="container py-0">
        <div class="card border-primary rounded-0" style="background-color: #62152d;">
            <div class="card-body p-2">
                <h2 class="card-title text-white">Editar Préstamo</h2>
                <form id="form-editar-prestamo" action="{{url('prestamos/'.$prestamo->id)}}" method="post">
                    @method("PUT")
                    @csrf 
                    <div class="mb-2">
                        <label for="cliente_id" class="form-label text-white">Cliente</label>
                        <select class="form-control" name="cliente_id" id="cliente_id">
                            <option value="">Selecciona un cliente</option>
                            @foreach($clientes as $cliente)
                                <option value="{{ $cliente->id }}" @if ($prestamo->cliente_id == $cliente->id) {{'selected'}} @endif> {{ $cliente->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-2">
                    <label for="libro_id" class="form-label text-white">Libro</label>
                        <select class="form-control" name="libro_id" id="libro_id">
                            <option value="">Selecciona un libro</option>
                            @foreach($libros as $libro)
                                <option value="{{ $libro->id }}" @if ($prestamo->libro_id == $libro->id) {{'selected'}} @endif> {{$libro->titulo}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-2">
                        <label for="fecha_prestamo" class="form-label text-white">Fecha-Préstamo</label>
                        <input type="date" class="form-control" name="fecha_prestamo" id="fecha_prestamo" value="{{$prestamo->fecha_prestamo}}" required>
                    </div>
                    <div class="mb-2">
                        <label for="fecha_devolucion" class="form-label text-white">Fecha-Devolución</label>
                        <input type="date" class="form-control" name="fecha_devolucion" id="fecha_devolucion" value="{{$prestamo->fecha_devolucion}}" required>
                    </div>
                    <div class="mb-2">
                        <label for="cantidad" class="form-label text-white">Cantidad</label>
                        <input type="number" class="form-control" name="cantidad" id="cantidad" value="{{$prestamo->cantidad}}" required>
                    </div>
                    <div class="mb-2">
                        <label for="estatus" class="form-label text-white">Estatus</label>
                        <input type="int" class="form-control" name="estatus" id="estatus" value="{{$prestamo->estatus}}">
                    </div>
                        <button type="submit" class="btn btn-success btn-sm-mb-2">Guardar</button>
                        <a href="{{url('prestamos')}}" class="btn btn-secondary btn-sm-mb-2">Regresar</a>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection