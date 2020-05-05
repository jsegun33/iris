<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductLinesSurcharge extends Eloquent
{
    //
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $connection = 'mongodb';
    protected $collection = 'products_line_surcharge';

    protected $fillable = [
        'SurchargeNo', 'SurchargeName', 'Charge', 'LinesNo', 'Active'
    ];
}
