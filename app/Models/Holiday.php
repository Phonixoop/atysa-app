<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Holiday extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'holydays';
    protected $dates = ['date'];
    protected $fillable = [
        'date'
    ];
}
