<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Dessert extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'desserts';
    protected $fillable = [
        'name','calory'
    ];
}
