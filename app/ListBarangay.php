<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class ListBarangay extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'list_barangay';

    protected $fillable = [
         'BrgyName', 'CityCode','active', 'ProvCode'
    ];
}
