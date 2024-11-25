<?php

namespace App\Http\Controllers;
use App\Models\libros;
use App\Models\categoria;
use App\Models\rol;
use App\Models\prestamos;
use Illuminate\Http\Request;

class librosController extends Controller{

    public static function index(Request $request){
        
        $categoriaId = $request->input('categoria');
        $query = $request->input('buscar');
        
        $consulta = libros::with('category');
        if($categoriaId){
            $consulta->where('categoria_id', $categoriaId);
        }
        if($query){
            $consulta->where('titulo', 'LIKE', "{$query}%");
        }
        
        $libros = $consulta->get();
        $categorias = categoria::all();
        return view('libros.index', compact('libros', 'categorias'));
    }

    public static function create(){
        $categorias = categoria::all();
        return view('libros.create', compact('categorias'));    
    }

    public function store(Request $request){
        $request->validate([
            'titulo' => 'required|max:50',
            'categoria' => 'required',
            'editorial' => 'required|max:30',
            'isbn' => 'required|max:13|unique:libros,isbn','unique',
            'estatus' => 'required|boolean',
        ], ['isbn.unique' => 'El ISBN ya fue registrado.',]);
        
        $libro = new libros();
        $libro->titulo=$request->input('titulo');
        $libro->categoria_id=$request->input('categoria');
        $libro->cantidad=$request->input('cantidad');
        $libro->editorial=$request->input('editorial');
        $libro->isbn=$request->input('isbn');
        $libro->ubicacion=$request->input('ubicacion');
        $libro->observaciones=$request->input('observaciones');
        $libro->estatus= 0;
        $libro->save();
        return redirect()->route('libros');
    }

    public static function show($id){
        $libros = libros::find($id);
    return view('libros.show', ['libro' => $libros, 'categorias' => categoria::all()]);
    }

    public static function edit ($id){
        $libros = libros::find($id);
        return view('libros.edit', ['libro' => $libros, 'categorias' => categoria::all()]);
    }

    public function update(Request $request, $id){
        $request->validate([
            'titulo' => 'required|max:50',
            'categoria' => 'required',
            'editorial' => 'required|max:30',
            'isbn' => 'required|max:13',
            'cantidad' => 'required|integer|min:0',
        ]);
        $libro = libros::find($id);

        $cantidadAnt = $libro->cantidad;

        $libro->titulo=$request->input('titulo');
        $libro->categoria_id=$request->input('categoria');
        $libro->cantidad=$request->input('cantidad');
        $libro->editorial=$request->input('editorial');
        $libro->isbn=$request->input('isbn');
        $libro->ubicacion=$request->input('ubicacion');
        $libro->observaciones=$request->input('observaciones');
        $libro->estatus=$request->input('estatus');

        if($cantidadAnt == 0 && $libro->cantidad > 0){
            $libro->estatus = 0;
        }else if($libro->cantidad == 0){
            $libro->estatus = 1;
        }

        $libro->save();
        return redirect()->route('libros');
    }

    public function delete($id) {
        $libro = libros::find($id);
        $libro->delete();
        return redirect()->route('libros');
    }
}