<?php

namespace App\Http\Controllers;
use App\Models\clientesIna;
use App\Models\clientes;
use Illuminate\Http\Request;


class clientesInaController extends Controller{
    public static function index(Request $request){

        $query = $request->input('buscar');
        if($query){
            $clientesIna = clientesIna::with('buscarCli')->where('nombre', 'LIKE', "{$query}%")
            ->get();
        }else{
            $clientesIna = clientesIna::with('buscarCli')->get();
        }
        //$clientesIna = clientesIna::all();
        return view('clientes.inactivos.index', compact('clientesIna'));
    }

    public function store(Request $request){
        $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'direccion' => 'required',
            'telefono' => 'required|max:10',
            'estatus' => 'required|boolean',
        ]);
        $clienteIna = new clientesIna();
        $clienteIna->nombre=$request->input('nombre');
        $clienteIna->apellido=$request->input('apellido');
        $clienteIna->direccion=$request->input('direccion');
        $clienteIna->telefono=$request->input('telefono');
        $clienteIna->estatus=$request->input('estatus') ? 0 : 1;
        $clienteIna->save();
        return redirect()->route('inactivos');
    }

    public function moverActivo($id){
        
        $clienteIna = clientesIna::find($id);

        if ($clienteIna) {
            
            $cliente = new clientes();
            $cliente->fill($clienteIna->toArray()); 
            $cliente->estatus = 0; 
            $cliente->save();

            
            $clienteIna->delete();

            return redirect()->route('clientes');
        } else {
            return redirect()->route('clientes/inactivos.index');
        }
    }

    public static function show($id){
        $clienteIna = clientesIna::find($id);
    return view('inactivos.show', ['clientesIna' => $clienteIna]);
    }

}