<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class AgentCom extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'AgentCommission';

    protected $fillable = [
       'AccountNo','ClassName', 'active','Class','status','PerilsName','PerilsNo','PerilsCode','AmountCom'
       ,'RemarksRemove','RemarksRemoveDate'
    ];
}
