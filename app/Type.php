<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\SoftDeletes;

class Type extends Eloquent
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $connection = 'mongodb';
    protected $collection = 'type';

    protected $fillable = [
        'type_name','AutoNo', 'active','icon_display','UnderSubMenu','UnderSubMenuName','status','UserMenu'
    ];
}
