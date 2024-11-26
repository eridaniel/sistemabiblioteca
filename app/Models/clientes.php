<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class clientes extends Model
{
    use HasFactory, Notifiable;
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