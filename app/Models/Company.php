<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Company extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'companies';
    protected $dates = ['endDate'];
    protected $fillable = [
        'name', 'email', 'password','type','phone', 'manager','endDate','enable','hotboxes','accessCamera','plateFee'
    ];

}
