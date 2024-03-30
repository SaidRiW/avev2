<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Database\Eloquent\Model;
use MongoDB\Laravel\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'notifications';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'data', 
        'type', 
        'notifiable_id', 
        'notifiable_type',
        'read_at',
    ];

}
