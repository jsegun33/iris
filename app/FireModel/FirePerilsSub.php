<?php

namespace App\FireModel;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class FirePerilsSub extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'fire_perils_sub';

    protected $fillable = [
        'RateSub', 
        'PerilsAcct', 
        'SubAcct', 
        'SubName',
        'status',
        'active',
    ];
}
