<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class PremiumType extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'PremiumType';

    protected $fillable = [
        'Type', 'Description', 'Remarks', 'active'
    ];
}
