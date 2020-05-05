<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class ReportQuotation extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'report_qoute';

    protected $fillable = [
        'Action','OldRecord', 'TransaID','AcctNo','OptionNo','AcctName','Transaction','TransactionDate','Status','Active',
       
        
    
    ];
}
