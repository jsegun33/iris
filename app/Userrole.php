<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Userrole extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'user_roles';

    protected $fillable = [
        'CName','RoleAlias','AccountNo','role_name', 'active','role_number','user_id','status','acctType','acctTypeName','Limit', 'UnderSubMenu',
        'icon_display'
    ];
}
