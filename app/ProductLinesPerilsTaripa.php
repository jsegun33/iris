<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductLinesPerilsTaripa extends Eloquent
{
    //
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $connection = 'mongodb';
    //protected $collection = 'product_lines_sub_perils_taripa';
    protected $collection = 'NewTaripa';
    protected $fillable = [
        'TaripaNo', 'SubLinesNo', 'PerilsNo', 'CoverageAmount', 'PremiumAmount', 'Formula', 'PerilsName', 'Active'
    ];
}
