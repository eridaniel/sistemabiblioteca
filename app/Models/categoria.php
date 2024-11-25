<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\libros;

class categoria extends Model
{
    use HasFactory;
    protected $fillable = [
    'id',
    'nombre'
    ];
    
}