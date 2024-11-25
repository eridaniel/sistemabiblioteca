@extends('layout/template')


@vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/css/main.css'])
@section('title', 'BIBLIOTECA')
@section('content')

<script>
function validarFormulario(event) {
        
        var cliente_id = document.getElementById('cliente_id').value;
        var libro_id = document.getElementById('libro_id').value;
        var fecha_prestamo = document.getElementById('fecha_prestamo').value;
        var fecha_devolucion = document.getElementById('fecha_devolucion').value;
        var cantidad = document.getElementById('cantidad').value;
        var estatus = document.getElementById('estatus').value;
        if (cliente_id === "" || libro_id === "" || fecha_prestamo === "" || fecha_devolucion === "" || cantidad === "" || 
             estatus === "") {
        // Mostrará una alerta de error si los campos están vacíos
        Swal.fire({
            icon: 'error',
            title: 'Campos incompletos',
            text: 'Por favor, rellena todos los campos.',
        });
        return false;
    } else {
        // Mostrar alerta de registro exitoso
        Swal.fire({
            icon: 'success',
            title: 'Préstamo registrado exitosamente',
            showConfirmButton: false,
            timer: 2000
        });
    }
}
</script>

<main>
    <div class="container py-0">
    <div class="row mb-3">
        <div class="col-md-4">
            <form action="{{ url('prestamos/create') }}" method="GET">
                <div class="mb-2">
                    <label for="categoria_id" class="form-label">Filtrar por Categoría</label>
                    <select class="form-control" name="categoria_id" id="categoria_id" onchange="this.form.submit()">
                        <option value="">Selecciona una categoría</option>
                        @foreach($categorias as $categoria)
                            <option value="{{ $categoria->id }}" {{ request('categoria_id') == $categoria->id ? 'selected' : '' }}>
                                {{ $categoria->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </form>
        </div>
    </div>
        <div class="card border-primary rounded-0" style="background-color: #62152d;">
            <div class="card-body p-2">
                <h2 class="card-title text-white">Registro de Préstamos</h2>
                <form action="{{url('prestamos')}}" method="post" onsubmit="return validarFormulario()">
                    @csrf 
                    <div class="mb-2">
                        <label for="cliente_id" class="form-label text-white">Cliente</label>
                        <select class="form-control" name="cliente_id" id="cliente_id">
                            <option value="">Selecciona un cliente</option>
                            @foreach($clientes as $cliente)
                                <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="mb-2">
                        <label for="libro_id" class="form-label text-white">Libro</label>
                        <select class="form-control" name="libro_id" id="libro_id">
                            <option value="">Selecciona un libro</option>
                            @foreach($libros as $libro)
                                <option value="{{ $libro->id }}">{{ $libro->titulo }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-2">
                        <label for="fecha_prestamo" class="form-label text-white">Fecha-Préstamo</label>
                        <input type="date" class="form-control" name="fecha_prestamo" id="fecha_prestamo">
                    </div>
                    <div class="mb-2">
                        <label for="fecha_devolucion" class="form-label text-white">Fecha-Devolución</label>
                        <input type="date" class="form-control" name="fecha_devolucion" id="fecha_devolucion">
                    </div>
                    <div class="mb-2">
                        <label for="cantidad" class="form-label text-white">Cantidad</label>
                        <input type="number" class="form-control" name="cantidad" id="cantidad" >
                    </div>
                    <div class="mb-2">
                        <label for="estatus" class="form-label text-white">Estatus</label>
                        <input type="int" class="form-control" name="estatus" id="estatus" >
                    </div>
                        <button type="submit" class="btn btn-success btn-sm-mb-2">Guardar</button>
                        <a href="{{url('prestamos')}}" class="btn btn-secondary btn-sm-mb-2">Regresar</a>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection