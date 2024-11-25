<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\libros;
use App\Models\categorias;
use App\Models\prestamos;
use App\Models\rol;
use App\Models\clientes;
use App\Models\clientesIna;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //$libros = libros::with('category')->get(); // Obtener todos los libros desde la base de datos
        return view('welcome'); 
    }
}
