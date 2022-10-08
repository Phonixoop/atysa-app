<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Hotbox extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'hotboxes';
    protected $fillable = [
        'name','capacity','temp','lat','lang'
    ];
}
