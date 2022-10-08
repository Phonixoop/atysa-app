<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class DessertPlan extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'desserts_plans';
    protected $fillable = [
        'month', 'days'
    ];
}
