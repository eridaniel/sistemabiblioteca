<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\categoria;

class libros extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'titulo',
        'editorial',
        'categoria_id',
        'cantidad',
        'isbn',
        'ubicacion',
        'observaciones',
        'estatus',
    ];
    public function category(){
        return $this->belongsTo(categoria::class, 'categoria_id');
    }
}