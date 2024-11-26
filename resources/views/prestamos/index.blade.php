@extends('layout/template')

@vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/css/main.css'])
@section('title', 'BIBLIOTECA')
@section('content')
<main>
    <div class="container d-flex align-items-center justify-content-center mt-4">
    </div>

    <div class="max-w-7xl mx-auto p-6 lg:p-8">
    <h2 class="text-center">Préstamos</h2>
    
    <div class="container">
    <div class="row mb-2">
        <div class="col-md-8">
        @if(Auth::check() && Auth::user()->role && Auth::user()->role->name === 'admin')
            <a href="{{route('prestamos.create')}}" class="btn btn-outline-primary btn-sm-2">Registrar Préstamo</a>
        @endif
        </div>
        <div class="col-md-4">
        <ul class="navbar-nav ms-auto">
    <li class="nav-item me-3 dropdown">
        <a class="nav-link" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fa-solid fa-bell"></i>
            @if($notificaciones->count() > 0)
            <span class="badge bg-danger">{{ $notificaciones->count() }}</span>
        @endif
    </a>
    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
        @foreach ($notificaciones as $notificacion)
                <li>
                    <a class="dropdown-item" href="{{ route('notificacion.leer', $notificacion->id)}}">
                        {{$notificacion->data['prestamo_id']}} - {{ $notificacion->data['mensaje']}} - {{ $notificacion->data['fecha_devolucion'] }}
                    </a>
                </li>
            @endforeach
        </ul>
    </li>
    </div>
        <div class="row">
            <table class="table table-bordered table-dark text-center">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Cliente</th>
                        <th>Título-Libro</th>
                        <th>Fecha-Préstamo</th>
                        <th>Fecha-Devolución</th>
                        <th>Cantidad</th>
                        <th>Estatus
                        <br/>
                            <select id="filter-status" class="form-select form-select-sm mt-1" style="width: auto; display: inline-block;">
                                <option value="all">(Todos)</option>
                                <option value="En Préstamo">En Préstamo</option>
                                <option value="No Devuelto">No Devuelto</option>
                                <option value="Devuelto">Devuelto</option>
                            </select>
                        </th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($prestamos as $prestamo)
                    <tr>
                        <td>{{$prestamo->id}}</td>
                        <td>{{$prestamo->clientes->nombre}}</td>
                        <td>{{$prestamo->libros->titulo}}</td>
                        <td>{{$prestamo->fecha_prestamo}}</td>
                        <td>{{$prestamo->fecha_devolucion}}</td>
                        <td>{{$prestamo->cantidad}}</td>
                        <td>
                            @if ($prestamo->estatus == 0)
                            <span class="text-success">En Préstamo</span>
                            @elseif ($prestamo->estatus == 1)
                            <span class="text-danger">No Devuelto</span>
                            @elseif ($prestamo->estatus == 2)
                            <span class="text-muted">Devuelto</span>
                            @endif
                        </td>
                    <td>
                            <div class="d-flex align-items-center justify-content-center">
                                
                                @if (Auth::check() && Auth::user()->role && Auth::user()->role->name === 'admin')
                                        <a href="{{ route('prestamos.edit', $prestamo->id)}}" class="btn btn-warning btn-sm-2 mr-3"><i class="fas fa-edit"></i> Editar</a> 
                                @endif
                                        <a href="{{ route('prestamos.delete', $prestamo->id) }}" class="btn btn-danger btn-sm-2 mr-3"><i class="fas fa-trash"></i> Eliminar</a>
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
<script>
    const filterSelect = document.getElementById('filter-status');
    const tableRows = document.querySelectorAll('table tbody tr');

    filterSelect.addEventListener('change', () => {
        const filterValue = filterSelect.value;

        tableRows.forEach(row => {
            const statusCell = row.querySelector('td:nth-child(7)'); 
            if (filterValue === 'all' || statusCell.textContent.trim() === filterValue) {
                row.style.display = ''; 
            } else {
                row.style.display = 'none'; 
            }
        });
    });
</script>
@endsection