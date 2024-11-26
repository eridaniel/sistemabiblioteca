@extends('layout/template')


@vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/css/main.css'])
@section('title', 'BIBLIOTECA')
@section('content')

<script>
function validarFormulario(event) {
        
        var titulo = document.getElementById('titulo').value;
        var categoria = document.getElementById('categoria').value;
        var cantidad = document.getElementById('cantidad').value;
        var editorial = document.getElementById('editorial').value;
        var isbn = document.getElementById('isbn').value;
        var ubicacion = document.getElementById('ubicacion').value;
        var observaciones = document.getElementById('observaciones').value;
        var estatus = document.getElementById('estatus').value;
        if (titulo === "" || categoria === "" || cantidad === "" || editorial === "" || isbn === "" || 
            ubicacion === "" || observaciones === "" || estatus === "") {
        // Mostrará una alerta de error si los campos están vacíos
        Swal.fire({
            icon: 'error',
            title: 'Campos incompletos',
            text: 'Por favor, rellena todos los campos.',
        });
        return false;
    } else {
        // Mostrar alerta de guardado exitoso
        Swal.fire({
            icon: 'success',
            title: 'Libro guardado exitosamente',
            showConfirmButton: false,
            timer: 2000
        });
    }
}
</script>

<main>
    <div class="container py-0">
        <div class="card border-primary rounded-0" style="background-color: #62152d;">
            <div class="card-body p-2">
                <h2 class="card-title text-white">Registro de Libros</h2>
                <form action="{{url('libros')}}" method="post" onsubmit="return validarFormulario()">
                    @csrf 
                    <div class="mb-2">
                        <label for="titulo_libro" class="form-label text-white">Título</label>
                        <input type="text" class="form-control" name="titulo" id="titulo">
                    </div>
                    <div class="mb-2">
                        <label for="categoria" class="form-label text-white">Categoría</label>
                        <select name="categoria" id="categoria" class="form-control" >
                            <option value="">Seleccione una categoría</option>
                            @foreach($categorias as $category)
                        <option value="{{$category->id}}" > {{$category->nombre}}</option>
                        @endforeach
                        </select>
                    </div>
                    <div class="mb-2">
                        <label for="cantidad" class="form-label text-white">Cantidad</label>
                        <input type="number" class="form-control" name="cantidad" id="cantidad">
                    </div>
                    <div class="mb-2">
                        <label for="edit_libro" class="form-label text-white">Editorial</label>
                        <input type="text" class="form-control" name="editorial" id="editorial">
                    </div>
                    <div class="mb-2">
                        <label for="isbn" class="form-label text-white">ISBN</label>
                        <input type="text" class="form-control @error('isbn') is-invalid @enderror" name="isbn" id="isbn" value="{{ old('isbn') }}" required>
                        
                        @error('isbn')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="ubicacion" class="form-label text-white">Ubicación</label>
                        <input type="int" class="form-control" name="ubicacion" id="ubicacion" >
                    </div>
                    <div class="mb-2">
                        <label for="observaciones" class="form-label text-white">Observaciones</label>
                        <input type="text" class="form-control" name="observaciones" id="observaciones" >
                    </div>
                    <div class="mb-2">
                        <label for="estatus" class="form-label text-white">Estatus</label>
                        <input type="int" class="form-control" name="estatus" id="estatus" >
                    </div>
                        <button type="submit" class="btn btn-success btn-sm-mb-2">Guardar</button>
                        <a href="{{url('libros')}}" class="btn btn-secondary btn-sm-mb-2">Regresar</a>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection