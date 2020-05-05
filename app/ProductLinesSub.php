<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class ProductLinesSub extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'product_lines_sub';

    protected $fillable = [
        'SubLinesNo', 'SubLinesCode', 'SubLinesName','Class','Active'
        

    ];
}
