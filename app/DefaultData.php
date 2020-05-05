<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class DefaultData extends Eloquent
{
    protected $dates = ['deleted_at'];
    protected $connection = 'mongodb';
    protected $collection = 'products_default_data';

    protected $fillable = [
        'DefaultDataNo','PerilsClass', 'LinesNo','Name', 'Amount','Converter', 'Active',
    ];
}
