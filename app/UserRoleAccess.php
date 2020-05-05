<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class UserRoleAccess extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'user_role_access';

    protected $fillable = [
        'CName','AccountNo','role_name_access', 'active','role_number_access','status','acctTypeSub','acctTypeSubName','role_number_url',
        'RemarksRemove',
        'RemarksRemoveDate',
        'RemarksRestore',
        'RemarksRestoreDate',
        'UnderSubMenu',
        'icon_display'
    ];
}
