<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Database\Eloquent\Model;
use MongoDB\Laravel\Eloquent\Model;

class Estudiante extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user',
        'matricula',
        'id_grupo',
    ];

    protected $connection = 'mongodb';
    protected $collection = 'estudiantes';
    protected $primaryKey = '_id';

}
