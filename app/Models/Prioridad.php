<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Database\Eloquent\Model;
use MongoDB\Laravel\Eloquent\Model;

class Prioridad extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipo',
        'color',
    ];

    protected $connection = 'mongodb';
    protected $collection = 'prioridades';
    protected $primaryKey = '_id';
}
