<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\SoftDeletes;

class CarDenomination extends Eloquent
{
    //
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $connection = 'mongodb';
    protected $collection = 'car_denominations';

    protected $fillable = [
        'DenominationNo', 'DenominationCode', 'DenominationName', 'Class', 'Active'
    ];
}
