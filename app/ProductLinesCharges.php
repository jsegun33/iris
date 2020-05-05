<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductLinesCharges extends Eloquent
{
    //
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $connection = 'mongodb';
    protected $collection = 'product_line_charges';

    protected $fillable = [
        'ChargesNo', 'ChargesCode', 'ChargesName', 'ChargesAmount', 'ChargesRemarks', 'ProductLine', 'Active'
    ];
}
