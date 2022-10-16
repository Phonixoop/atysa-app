<?php

namespace App;

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Plan extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'plans';
    protected $fillable = [
        'name',
        'months'
    ];
}
