<?php

namespace App\FireModel;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class FireCharges extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'fire_charges';

    protected $fillable = [
        'Description', 
        'Formula', 
        'PolicyDisplay', 
        'status',
        'active',
    ];
}
