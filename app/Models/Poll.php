<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Poll extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'polls';
    public $timestamps = true;
    protected $fillable = [
        'mobile', 'zaherKolli', 'rangeGhaza' , 'bafteGhaza', 'cheghadrLezzat','mojaddad'
    ];
}
