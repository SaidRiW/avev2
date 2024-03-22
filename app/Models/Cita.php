<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Database\Eloquent\Model;
use MongoDB\Laravel\Eloquent\Model;

class Cita extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_admin',
        'matricula',
        'id_servicio',
        'id_grupo',
        'fecha_hora',
        'motivo',
    ];

    protected $connection = 'mongodb';
    protected $collection = 'citas';
    protected $primaryKey = '_id';

}
