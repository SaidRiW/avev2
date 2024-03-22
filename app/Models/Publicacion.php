<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Database\Eloquent\Model;
use MongoDB\Laravel\Eloquent\Model;

class Publicacion extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_admin',
        'servicio',
        'titulo',
        'fechaInicio',
        'fechaFin',
        'descripcion',
        'grupo',
        'imagen',
        'prioridad',
    ];

    protected $connection = 'mongodb';
    protected $collection = 'publicaciones';
    protected $primaryKey = '_id';
}
