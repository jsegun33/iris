<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class AgentComReport extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'AgentCommReport';

    protected $fillable = [
       'AccountNo','ClassName', 'active','Class','status','PerilsName','PerilsNo','PerilsCode','AmountCom','RequestNo'
       ,'TotalAmountCom','TotalAmountMaxCom'
    ];
}
