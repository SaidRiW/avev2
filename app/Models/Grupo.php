<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Database\Eloquent\Model;
use MongoDB\Laravel\Eloquent\Model;

class Grupo extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'carrera',
    ];


    protected $connection = 'mongodb';
    protected $collection = 'grupos';
    protected $primaryKey = '_id';
}
