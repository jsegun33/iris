<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class RequestClauses extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'request_clauses';

    protected $fillable = [
        'RequestNo','OptionNo','Active','Status','ClausesNo','ClausesName','ClausesStatement','Belong','ClausesRequired'
        

    ];
}
