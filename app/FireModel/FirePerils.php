<?php

namespace App\FireModel;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class FirePerils extends Eloquent
{
    //protected $dates = ['deleted_at'];
    protected $connection = 'mongodb';
    protected $collection = 'fire_perils';

    protected $fillable = [
        'PerilsCode', 
        'PerilsAcct', 
        'PerilsDecription', 
        'status',
        'active',
    ];
}
