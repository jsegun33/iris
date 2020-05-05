<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubType extends Eloquent
{
    //
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $connection = 'mongodb';
    protected $collection = 'sub_types';

    protected $fillable = [
        'SubTypeNo', 'SubLink_TypeName', 'SubLink_URL', 'SubMenu_Type', 'TypeID', 'active','icon_display','status','UserMenu'
    ];
}
