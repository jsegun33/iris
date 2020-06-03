<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Registration extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'users';

    protected $fillable = [
        'user_fname', 'user_mname',
        'user_lname', 'email',
        'username', 'password',
        'acctType', 'AccountNo',
        'active', 'status','RoleAlias',
        'userRole','department','departmentID','ApprovedLimit',
        'AgentType','SubAgent',
        'RemarksRestore',
        'RemarksRestoreDate',
        'RemarksRemove',
        'RemarksRemoveDate',
        'UnderSubMenu',
        'icon_display',
        'UnderSubMenuName'
        ,'MktgTaskCounter'
        ,'MktgTaskCounterDaily'


    ];
}
