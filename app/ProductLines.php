<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductLines extends Eloquent
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $connection = 'mongodb';
    protected $collection = 'product_lines';

    protected $fillable = [
        'LinesNo', 'LinesCode', 'LinesName', 'Active'
    ];
}
