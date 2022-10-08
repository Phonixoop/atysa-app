<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Plate extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'plates';
    protected $fillable = [
        'userId', 'weight', 'name' , 'materials', 'description','calory','size','image'
    ];
}
