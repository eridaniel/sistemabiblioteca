<?php

namespace App\Http\Controllers;
use App\Models\libros;
use App\Models\categoria;
use Illuminate\Http\Request;
use App\Models\prestamos;
use App\Notifications\PrestamoExpirado;
use Illuminate\Support\Facades\Notification;
use App\Models\clientes;
use Carbon\Carbon;


class prestamosController extends Controller{

    public static function index(Request $request){
        
       self::prestamosNoDevueltos();
       $prestamos = prestamos::with('clientes', 'libros')->get(); 
       $horaActual = Carbon::now();
        
        $prestamoVencido = prestamos::where('fecha_devolucion', '<=', $horaActual->addDay())
            ->where('estatus', 0)
            ->get();
        foreach($prestamoVencido as $prestamo){
            $NotificacionExiste = auth()->user()->notifications()
            ->where('data->prestamo_id', $prestamo->id)
            ->first();

            if(!$NotificacionExiste){
            Notification::send(auth()->user(), new prestamoExpirado($prestamo));
            }
            
        }

    $notificaciones = auth()->user()->notifications()->whereNull('read_at')->get();
    return view('prestamos.index', compact('prestamos', 'notificaciones'));
    }

    private static function prestamosNoDevueltos(){

        $now = Carbon::now();

        $prestamos = prestamos::where('estatus', 0)
            ->where('fecha_devolucion', '<=', $now)
            ->get();

        foreach($prestamos as $prestamo){
            $prestamo->estatus = 1;
            $prestamo->save();
        }
    }
    public static function create(Request $request){
        $clientes = clientes::all();
        $categorias = categoria::all();
        $libros = [];

        if($request->has('categoria_id')){
            $libros = libros::where('categoria_id', $request->input('categoria_id'))->get();
        }
        return view('prestamos.create', compact('clientes', 'libros', 'categorias'));    
    }

    public function store(Request $request){
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'libro_id' => 'required|exists:libros,id',
            'fecha_prestamo' => 'required|date',
            'fecha_devolucion' => 'required|date|after_or_equal:fecha_prestamo',
            'cantidad' => 'required|integer|min:1',
            'estatus' => 'required|boolean',
        ]);
    
        $libro = libros::findOrFail($request->input('libro_id'));

        if($libro->cantidad < $request->input('cantidad')){
            return redirect()->back();
        }

        $libro->cantidad -= $request->input('cantidad');

        if($libro->cantidad == 0){
            $libro->estatus = 1;
        }
        $libro->save();

        $prestamo = new prestamos();
        $prestamo->cliente_id = $request->input('cliente_id'); 
        $prestamo->libro_id = $request->input('libro_id');     
        $prestamo->fecha_prestamo = $request->input('fecha_prestamo');
        $prestamo->fecha_devolucion = $request->input('fecha_devolucion');
        $prestamo->cantidad = $request->input('cantidad');
        $prestamo->estatus = 0;
        $prestamo->save();
        return redirect()->route('prestamos');
    }

    public static function edit($id){
        $prestamo = prestamos::find($id);
        $clientes = clientes::all();
        $libros = libros::all();

        return view('prestamos.edit', compact('prestamo', 'clientes', 'libros'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'libro_id' => 'required|exists:libros,id',
            'fecha_prestamo' => 'required|date',
            'fecha_devolucion' => 'required|date|after_or_equal:fecha_prestamo',
            'cantidad' => 'required|integer|min:1',
            'estatus' => 'required|boolean',
        ]);
        $prestamo = prestamos::find($id);
        $prestamo->fill($request->all());
        $libro = libros::find($request->input('libro_id'));

        $cantidadAnt = $prestamo->cantidad;

        $prestamo->cliente_id=$request->input('cliente_id');
        $prestamo->libro_id=$request->input('libro_id');
        $prestamo->fecha_prestamo=$request->input('fecha_prestamo');
        $prestamo->fecha_devolucion=$request->input('fecha_devolucion');
        $prestamo->cantidad=$request->input('cantidad');
       

        $currentDate = Carbon::now();
        if($prestamo->fecha_devolucion <= $currentDate){
            $prestamo->estatus = 1;
        }else{
            $prestamo->estatus = 0;
        }    
        $prestamo->save();

        $diferencia = $prestamo->cantidad - $cantidadAnt;

        $libro->cantidad -= $diferencia;
        if($libro->cantidad == 0){
            $libro->estatus = 1;
        }else{
            $libro->estatus = 0;
        }
        $libro->save();
        return redirect()->route('prestamos');
    }
    
    public function delete($id){
    $prestamo = prestamos::findOrFail($id);
    $libro = libros::findOrFail($prestamo->libro_id);
    
    $libro->cantidad += $prestamo->cantidad;
    if($libro->cantidad > 0){
        $libro->estatus = 0;
    }
    $libro->save();

    $prestamo->estatus = 2;
    $prestamo->save();

    return redirect()->route('prestamos');
    }

}