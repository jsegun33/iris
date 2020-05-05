<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Authentication extends Eloquent
{
    protected $dates = ['deleted_at'];
    protected $connection = 'mongodb';
    protected $collection = 'authentication';

    protected $fillable = [
       'CocNoSeqNo', 'CocNo', 'AuthCode', 'AuthRemarks',  'Active', 'RequestNo', 'PlateNumber', 'DateAuth'
       ,'AssuredName','Denomination'
    ];
}
