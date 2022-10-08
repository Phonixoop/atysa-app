<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class UserBasket extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'usersBasket';
    protected $fillable = [
        'userId', 'histories'
    ];
}
