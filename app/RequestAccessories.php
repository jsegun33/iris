<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
class RequestAccessories extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'request_accessories';

    protected $fillable = [
        'RequestNo','OptionNo','CoverageAmount','Active','Status','AcsID','Number','Name','Formula','Greater','Amount'
        

    ];
}
