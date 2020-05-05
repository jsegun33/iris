<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;


class Quotation extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'quotation_customer';
    

    protected $fillable = [
        'firstname', 'middlename',
        'lastname', 'email',
        'Address',  'ContactNo', 'CustAcctNo',
        

    ];
}
