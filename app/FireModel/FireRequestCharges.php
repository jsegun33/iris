<?php

namespace App\FireModel;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class FireRequestCharges extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'fire_request_charges';

    protected $fillable = [
        'RequestNo',
        'TotalPremiumCoverages',
        'PremiumCharges',
        'TotalAmountDue',
        'Description', 
        'Formula', 
        'PolicyDisplay', 
        'status',
        'active',
    ];
}
