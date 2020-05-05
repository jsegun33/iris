<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class QuotationList extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'quotation_list';
    

    protected $fillable = [
        'QuoteNo', 
        'plate_number',
        'CustAcctNo',
         'CTPL',
        'CTPLAmount', 
         'CTPLPremium', 'OD',
        'ODAmount',  'ODPremium', 'TH',
        'THLAmount',  'THPremium', 'AOG',
        'AOGAmount',  'AOGPremium', 'xBI',
        'xBIAmount',  'xBIPremium', 'PD',
        'PDAmount',  'PDPremium', 'PA',
        'PAAmount',  'PAPremium', 'TotalCoverage',
        'DocStps',  'Vat', 'LGT',
        'COCFee',  'BayadCenter', 'GrossAmount',
        'Discount',  'DiscountRemarks', 'TotalPremium',



        

    ];
}
