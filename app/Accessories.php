<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
class Accessories extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'Accessories';

    protected $fillable = [
        'Number','Name','SubLinesNO','Formula1','Greater','Active','Status','Formula2','ForType'
        

    ];
}
