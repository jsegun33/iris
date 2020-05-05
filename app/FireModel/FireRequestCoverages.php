<?php

namespace App\FireModel;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class FireRequestCoverages extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'fire_request_coverages';

    protected $fillable = [
        'RequestNo',
        'CName',
        'AssuredName',
        'Rate',
        'Formula',
        'MarketValue',
        'CoveragesPremium',
        'OptionNo',
        'TotalPremium',
        'TotalAmountDue',
        'PerilsCode', 
        'PerilsAcct', 
        'PerilsDecription', 
        'RateSub', 
        'PerilsAcct', 
        'SubAcct', 
        'status',
        'active',
    ];
}
