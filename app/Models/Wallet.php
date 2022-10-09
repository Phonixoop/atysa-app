<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Wallet extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'wallets';
    protected $fillable = [
        'user', 'transactions', 'budget'
    ];
}
