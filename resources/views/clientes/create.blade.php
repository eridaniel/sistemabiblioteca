@extends('layout/template')


@vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/css/main.css'])
@section('title', 'BIBLIOTECA')
@section('content')

<script>
function validarFormulario(event) {
        
        var nombre = document.getElementById('nombre').value;
        var apellido = document.getElementById('apellido').value;
        var direccion = document.getElementById('direccion').value;
        var telefono = document.getElementById('telefono').value;
        var estatus = document.getElementById('estatus').value;
        if (nombre === "" || apellido === "" || direccion === "" || telefono === "" ||  estatus === "") {
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
            title: 'Cliente guardado exitosamente',
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
                <h2 class="card-title text-white">Registro de Clientes</h2>
                <form action="{{url('clientes')}}" method="post" onsubmit="return validarFormulario()">
                    @csrf 
                    <div class="mb-2">
                        <label for="nombre" class="form-label text-white">Nombre</label>
                        <input type="text" class="form-control" name="nombre" id="nombre">
                    </div>
                    <div class="mb-2">
                        <label for="apellido" class="form-label text-white">Apellido</label>
                        <input type="text" class="form-control" name="apellido" id="apellido">
                    </div>
                    <div class="mb-2">
                        <label for="direccion" class="form-label text-white">Dirección</label>
                        <input type="text" class="form-control" name="direccion" id="direccion">
                    </div>
                    <div class="mb-2">
                        <label for="telefono" class="form-label text-white">Teléfono</label>
                        <input type="text" class="form-control" name="telefono" id="telefono" >
                    </div>
                    <div class="mb-2">
                        <label for="estatus" class="form-label text-white">Estatus</label>
                        <input type="int" class="form-control" name="estatus" id="estatus" >
                    </div>
                        <button type="submit" class="btn btn-success btn-sm-mb-2">Guardar</button>
                        <a href="{{url('clientes')}}" class="btn btn-secondary btn-sm-mb-2">Regresar</a>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection