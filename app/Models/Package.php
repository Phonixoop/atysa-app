<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Package extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'packages';
    protected $fillable = [
        'name', 'childs','calory','size'
    ];
}
