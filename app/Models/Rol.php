<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Database\Eloquent\Model;
use MongoDB\Laravel\Eloquent\Model;

class Rol extends Model
{
    use HasFactory;

    protected $fillable = [
        'rol',
    ];

    protected $connection = 'mongodb';
    protected $collection = 'roles';
    protected $primaryKey = '_id';
}
