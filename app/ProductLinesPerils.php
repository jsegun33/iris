<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductLinesPerils extends Eloquent
{
    //
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $connection = 'mongodb';
    protected $collection = 'product_lines_sub_perils';

    protected $fillable = [
        'PerilsNo', 'PerilsCode', 'PerilsName', 'Checkbox', 'Checkbox1', 'Active', 'LinesNo'
    ];
}
