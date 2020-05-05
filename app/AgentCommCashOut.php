<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class AgentCommCashOut extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'AgentCommCashOut';

    protected $fillable = [
       'AccountNo','CashOutMode', 'active','RequestAmount','status','RequestNo','PlateNo','COCNo','AmountCom','DateRequested'
       ,'CashOutAmount','RemainingAmount','CashOutPaidAmount'
    ];
}
