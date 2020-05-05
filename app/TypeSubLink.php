<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class TypeSubLink extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'type_sub_link';

    protected $fillable = [
        'SubLink_TypeName', 'SubLink_URL', 'type_name', 'type_ID','active','icon_display'
    ];
}
