<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class notificacion extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'notifications';
    protected $fillable = [
        'notifiable_type',
        'notifiable_id',
        'data',
    ];
}
