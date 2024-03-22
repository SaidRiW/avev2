<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Database\Eloquent\Model;
use MongoDB\Laravel\Eloquent\Model;

class Administrador extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user',
        'servicio',
    ];

    protected $connection = 'mongodb';
    protected $collection = 'administradores';
    protected $primaryKey = '_id';

}
