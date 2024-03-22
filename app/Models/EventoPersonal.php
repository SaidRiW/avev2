<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Database\Eloquent\Model;
use MongoDB\Laravel\Eloquent\Model;

class EventoPersonal extends Model
{
    use HasFactory;

    protected $fillable = [
        'matricula',
        'titulo',
        'fecha_hora',
        'descripcion',
        'id_prioridad',
    ];

    protected $connection = 'mongodb';
    protected $collection = 'eventos_personales';
    protected $primaryKey = '_id';
}
