<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class RequestCharges extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'request_charges';

    protected $fillable = [
        'ChargesNo', 'RequestNo','ChargesName','ChargesAmount','ChargesPremium','Active','OptionNo','TotalCharges','Status','TotalAmountDue'
        ,'ChargesPremiumAOG','TotalChargesAOG','UpdateRequest'

    ];
}
