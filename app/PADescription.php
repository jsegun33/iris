<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;


class PADescription extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'PADescription';
    

    protected $fillable = [
        'RequestNo', 'PolicyNo',
        'Line1', 'Line2',
        'Line3',  'Line4', 'Line5',
        'Line6',  'active', 
        

    ];
}
