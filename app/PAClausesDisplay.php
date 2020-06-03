<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class PAClausesDisplay extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'PAClausesDisplay';
    

    protected $fillable = [
        'RequestNo', 'PolicyNo','active', 'Line0',
        'Line1','Line2','Line3','Line4','Line5',
        'Line6','Line7','Line8','Line9','Line10','Line8a','Line8b','Line8c',
        'Line8d','Line8e','Linef','Line8g',
        'Line1Amount', 'Line2Amount', 'Line3Amount', 'Line4Amount',
        'Line5Amount', 'Line6Amount', 'Line7Amount', 'Line8Amount',
        
        

    ];
}
