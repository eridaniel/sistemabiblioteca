<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class clientesIna extends Model
{
    use HasFactory;

    protected $table = 'clientes_inactivos';
    protected $fillable = [
        'id',
        'nombre',
        'apellido',
        'direccion',
        'telefono',
        'estatus',
    ];
    public function buscarCli(){
        return $this->belongsTo(clientes::class, 'nombre');
    }
}