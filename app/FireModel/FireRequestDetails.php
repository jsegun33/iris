<?php

namespace App\FireModel;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class FireRequestDetails extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'fire_request_details';

    protected $fillable = [
        'UserAcctNo',
        'UserAcctName',
        'RequestNo',
        'MarketValue',
        'EffectiveDate',
        'ExpiryeDate',
        'PropertyAddress',
        'PropertyAddressCity',
        'PropertyAddressBarangay',
        'TINNumber',
        'EmailAddress',
        'ContactNumber',
        'FirstName',
        'MiddleName',
        'LastName',
        'PersonalAddress',
        'PersonalAddressCity',
        'PersonalAddressBarangay',
        'ImgBounderyLeft',
        'ImgBounderyRight',
        'ImgBounderyFront',
        'ImgBounderyRear',
        'BusinessType',

        'status',
        'active',
    ];
}
