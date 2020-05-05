<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class RequestSurcharge extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'request_surcharge';

    protected $fillable = [
        'SurchargeNo', 'RequestNo','SurchargeName','SurchargeAmount','SurchargePremium','Active'
        

    ];
}
