<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class ListCity extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'list_city';

    protected $fillable = [
         'Code', 'CityName', 'active', 'ProvCode'
    ];
}
