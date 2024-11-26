<?php

namespace App\Http\Controllers;
use App\Models\clientes;
use App\Models\clientesIna;
use Carbon\Carbon;

use Illuminate\Http\Request;

class clientesController extends Controller{

    public static function index(Request $request){

        self::moverClientesInactivos();
        $query = $request->input('buscar');
        if($query){
            $clientes = clientes::with('buscarCli')->where('nombre', 'LIKE', "{$query}%")
            ->get();
        }else{
            $clientes = clientes::with('buscarCli')->get();
        }

        //$clientes = clientes::all();
        return view('clientes.index', compact('clientes'));
    }

    
    private static function moverClientesInactivos(){
       
        $now = Carbon::now();

        $clientes = clientes::where('estatus', 0) 
            ->where(function ($query) use ($now) {
                $query->where('created_at', '<=', $now->subMonths(6)) 
                      ->orWhere('updated_at', '<=', $now->subMonths(6)); 
            })->get();

        foreach($clientes as $cliente){
            
            $cliente->estatus = 1; 
            $cliente->save();

            $clienteIna = new clientesIna();
            $clienteIna->fill($cliente->toArray()); 
            $clienteIna->save();

            $cliente->delete(); 
        }
    }

    public static function create(){
        $clientes = clientes::all();
        return view('clientes.create', compact('clientes'));
    }

    public function store(Request $request){
        $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'direccion' => 'required',
            'telefono' => 'required|max:10',
            'estatus' => 'required|boolean',
        ]);
        $cliente = new clientes();
        $cliente->nombre=$request->input('nombre');
        $cliente->apellido=$request->input('apellido');
        $cliente->direccion=$request->input('direccion');
        $cliente->telefono=$request->input('telefono');
        $cliente->estatus= 0;
        $cliente->save();
        return redirect()->route('clientes');
    }

    public static function show($id){
        $clientes = clientes::find($id);
    return view('clientes.show', ['cliente' => $clientes]);
    }

    public static function edit ($id){
        $clientes = clientes::find($id);
        return view('clientes.edit', ['cliente' => $clientes]);
    }

    public function update(Request $request, $id){
        $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'direccion' => 'required',
            'telefono' => 'required|max:10',
        ]);
        $cliente = clientes::find($id);
        $cliente->nombre=$request->input('nombre');
        $cliente->apellido=$request->input('apellido');
        $cliente->direccion=$request->input('direccion');
        $cliente->telefono=$request->input('telefono');
        $cliente->estatus=$request->input('estatus');
        $cliente->save();
        return redirect()->route('clientes');
    }

    /*public function delete($id){
        $cliente = clientes::find($id);
        $cliente->delete();
        return redirect()->route('clientes');
    }*/
    //----------------------------------------------------------------//
}