<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\SoftDeletes;

class BankDetails extends Eloquent
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $connection = 'mongodb';
    protected $collection = 'BankDetails';

    protected $fillable = [
        'BankName', 'Status', 'Active', 'Remarks', 'Address'
    ];
}
