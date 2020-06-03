<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class RequestCoverages extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'request_coverages';

    protected $fillable = [
        'CoveragesNo','PerilsName', 'RequestNo','CoveragesName','CoveragesAmount','CoveragesPremium','Active',
        'PremiumAmount','OptionNo','TotalCoveragesPremium','Status','Sort','Approver','ApproverRemarks','ApproverRemarksDate','ApproverName'
        ,'CheckedApprovedByName','CheckedApprovedByID','ClientRemarks','ClientRemarksDate','AccountNo','RevieweeRemarks','RevieweeRemarksDate'
        ,'CoverageRates','PerilsCode','RevieweeAcctNO','RevieweeCName','RevieweePasserRemarks','AssignApproverNameQuote','AssignApproverAcctNoQuote'
        ,'AssignApproverRemarksDate','AssignApproverIDQuote','AssignApproverRemarksQuote'
        ,'ApproverNameQuote','ApproverAcctNoQuote','ApproverRemarksDate','ApproverIDQuote','ApproverRemarksQuote'
        ,'AssignRevieweeRemarks','AssignRevieweeDate','AssignRevieweeCName','AssignRevieweeAcctNO','AssignRevieweeID','DenominationType'
        ,'Description','RequestModify','RequestModifyRemarks','RequestModifyPassByAcctNo','RequestModifyPassByName','RequestModifyCoverages'
        , 'WithAOG','NoAOGPremiumTotal','NoAOGCoveragesTotal','TotalPremium','TotalCoverages','TotalAmountDue','Deductible','TowingLimit'
        ,'Surcharge','DepreciativeAmount','UpdateRequest','Passengers'
    ];
}
