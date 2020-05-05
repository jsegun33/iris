<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class RequestDetails extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'request_details';

    protected $fillable = [
       'RequestNo' , 'PlateNumber' , 'Denomination' , 'MotorPOAmount' , 'MotorYear' ,
       'MotorBrand' , 'MotorModel' , 'MotorBodyType' , 'MotorUsage' , 'MotorNetWeight' ,
       'MotorWithAccessories' , 'MotorEffectiveDate' , 'MotorExpiryDate' , 'TINNumber' , 'EmailAddress' ,
       'ContactNumber' , 'FirstName' , 'MiddleName' , 'LastName' , 'Address' ,
       'Barangay' , 'City' , 'Status' , 'Active' ,'PremiumAmount', 'AmountDue', 'TotalCharges','RatePercent',
       'Vat','COCFee','LGT','DocStamp','BayadCenter','MotorSurcharge','ProductLine','Deductable','CoverageAmount',
       'DepressiveAmount','NoYrsDepreciative','DepreciativeEveryYear','DepreciativeEveryYearPrcnt','QuoteExpiry',
       'QuoteExpiryDate','QuoteExpiryTime','QuoteExpiryStatus','QuoteExpiryRemarks',
       'CustMessage', 'CustMessageDate','Passengers','Driver'
       ,'MvFileNo','EngineNo','ChassisNo','Mortgage','MortgageBankName','MortgageBankAddress','HardCopy','NormalDelivery'
       ,'PaymentGateway','DeliveryAddress','BodyColor','CustAcctNO'
       ,'RequestModify','RequestModifyRemarks','RequestModifyPassByAcctNo','RequestModifyPassByName'
       ,'ForSignature','ForSignatureAcctNo','ForSignatureName'
       ,'LateDaysNo','IssuanceRemarks','AutoRenew','AssignCRD','AcceptanceDate','TotalCoverages','SubLinesName','AcctName'
       ,'WithAOG','WithAOGPremium','WithAOGCoverages','OptionWithAOG'
       ,'UploadedORCR','PolicyApproverSignature','PolicyApproverCName','PolicyApproverAcctNo','PaymentMode'
       ,'AOGAmountDue' ,'CocNoRequest' ,'AuthCodeRequest','HasCTPL','PolicyNo','TotalCommission','DiscountedAmountDue'
       ,'DiscountAmount','StatusCashOut','CashOutAmount','CashOutMode','CommissionAmount'
       ,'DiscountCOAmount','DiscountCOAmountMode','DiscountCOTotalCommission','CashOutPaidAmount'
       ,'AssuredName','AssuredAddress','AssuredCity','AssuredBarangay','Individual','CName','UpdateRequest'
      
    ];
}
