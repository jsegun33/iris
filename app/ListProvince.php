<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class ListProvince extends Eloquent
{   
    protected $connection = "mongodb";
    protected $collection = "list_province";
    protected $fillable = [
        'ProvCode', 'ProvName', 'active'
   ];
}
