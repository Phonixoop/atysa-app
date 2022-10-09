<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Wallet extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'wallet';
    protected $fillable = [
        'userId', 'charges', 'budget'
    ];
}
