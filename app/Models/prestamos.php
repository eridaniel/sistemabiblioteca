<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Models\clientes;
use App\Models\libros;


class prestamos extends Model
{
    use HasFactory, Notifiable;
    protected $fillable = [
        'cliente_id',
        'libro_id',
        'fecha_prestamo',
        'fecha_devolucion',
        'cantidad',
        'estatus',
    ];
    public $timestamps = false;
    public function clientes(){
        return $this->belongsTo(clientes::class, 'cliente_id');
    }

    public function libros(){
        return $this->belongsTo(libros::class, 'libro_id');
    }
}