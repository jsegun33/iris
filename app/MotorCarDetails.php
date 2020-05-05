<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class MotorCarDetails extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'motor_details';
    

    protected $fillable = [
        'plate_number', 'mv_file_number',
        'engine_number', 'chassis_number',
        'make_id',  'series_id', 'body_id',
        'mv_id',  'color', 'CustAcctNo',
        

    ];
}
