<?php

namespace App;

// use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\SoftDeletes;


class ClausesWarranties extends Eloquent

{
    use SoftDeletes;

    protected $connection = 'mongodb';
    protected $collection = 'ClausesWarranties';

    protected $fillable = [
        'Number','Name','Required','Active', 'Status','Default','Belong','Remarks','Statement'
    ];
}
