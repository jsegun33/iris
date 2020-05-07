<?php
namespace Jenssegers\Mongodb\Auth;
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
//use DB;
use Illuminate\Http\Request;
use App\Quotation;
use App\MotorCarDetails;
use App\QuotationList;
use App\PerilsAmount;
use App\SubLinesCount;
use App\ProductLinesPerils;
use App\RequestDetails;
use App\ProductLinesPerilsTaripa;
use App\ProductLinesSub;
use App\ProductSurcharge;
use App\RequestSurcharge;
use App\RequestCharges;
use App\RequestCoverages;
use App\DefaultData;
use App\ProductLinesCharges;
use App\User;
use App\Userrole;
use App\ClausesWarranties;
use App\RequestClauses;
use App\RequestAccessories;
use App\Accessories;
use App\BankDetails;
use App\Authentication;
use App\ReportQuotation;
use App\AgentComReport; 
use App\AgentCom;
use App\AgentCommCashOut;
use Jenssegers\Mongodb\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use MongoDB\BSON\Decimal128;
use SoapClient;
use Ixudra\Curl\Facades\Curl;




use Artisaninweb\SoapWrapper\SoapWrapper;
// use App\Soap\Request\GetConversionAmount;
// use App\Soap\Response\GetConversionAmountResponse;


use App\Libraries\PayMaya\PayMayaSDK;
use App\Libraries\PayMaya\API\Webhook;
use App\Libraries\PayMaya\API\Checkout;
use App\Libraries\PayMaya\API\Customization;
use App\Libraries\PayMaya\Model\Checkout\Item;
use App\Libraries\PayMaya\Model\Checkout\ItemAmount;
//use App\Libraries\PayMaya\sample\Checkout\User as PayMayaUser;
use App\Libraries\PayMaya\Model\Checkout\ItemAmountDetails;

use Crazymeeks\Foundation\PaymentGateway\Dragonpay\Dragonpay;
//use Crazymeeks\Foundation\PaymentGateway\Dragonpay\Action\CheckTransactionStatus;


class QuotationController extends Controller
{

 // private $UserDataAccountNo = "2019-0003" ;

 protected $dragonpay;

 public function __construct(Dragonpay $dragonpay)
 {
     $this->dragonpay = $dragonpay;
 }

  
//  protected $soapWrapper;

//  public function __construct(SoapWrapper $soapwrapper)
//  {
//      $this->soapWrapper = $soapwrapper;
//  }

public function QuotationMotor(Request $request)
{
  date_default_timezone_set('Asia/Hong_Kong');
  $curYear = date('Y'); 
  $CountUser = RequestDetails::count() + 1;
  $NewCountUser = str_pad($CountUser, 4, '0' , STR_PAD_LEFT); 
  $AccountNo =  $curYear. "-".$NewCountUser;
  //-------Depreciative ------------------------------------------
      $POAmount                   =   $request['DepreciativeAmount'] ;
      $DepreciativeNumberYear     =   $request['DepreciativeNumberYear'] ;
      $FindDefaultDataAmount      =  DefaultData::where('DefaultDataNo','2019-RE-0001')->first();
      $RatePercentage             =  round($FindDefaultDataAmount->Amount,2);
      $TotalComputationPremium    = 0 ; 
      $MaxTaripaAmount            = 1000000;
      $totalPerilsName1           = $request['PerilsName']; 
      $Denomination               = explode(';;' ,$request['Denomination']);
      for($P=0 ;$P < count($totalPerilsName1)  ;$P++)   //loop value of perilsname
      {  
         
         ///------------Premium  COmputation Commercial 
         $PerilsNo                = explode('-' ,$request['PerilsName'][$P]);
         $PerilsName              = $request['PerilsName'][$P];
        
            $FindSurcharge            = DefaultData::where('DefaultDataNo','2019-SE-0012')->first();
         if (trim($PerilsNo[1]) === "XBI" || trim($PerilsNo[1]) === "PD"  ) {
                  $DefaultPremiumAmount            = ProductLinesPerilsTaripa::select('*')->where('CoverageAmount','>=',round($POAmount))->orWhere('CoverageAmount',round($MaxTaripaAmount ))->where('PerilsNo',$PerilsName)->where('SubLinesNo',trim($Denomination[0]))->first();
                  if ( trim($request['usages']) === "Commercial Use"){   ///for Commercial
                        $ComputationPremium       =    round($DefaultPremiumAmount->PremiumAmount * $FindSurcharge->Amount, 2) ;
                        $PremiumAmount            =    round($DefaultPremiumAmount->PremiumAmount, 2) ;
                        $Surcharge                =    round($FindSurcharge->Amount, 2) ;
                      //  $DenominationType        =     $FindSurcharge->SubLinesNo;
                 

                  }else{
                          $ComputationPremium     =    round($DefaultPremiumAmount->PremiumAmount , 2) ;
                          $PremiumAmount          =    round($DefaultPremiumAmount->PremiumAmount, 2) ;
                          $Surcharge              =    0.00;
                         // $DenominationType        =     $DefaultPremiumAmount->SubLinesNo;
                          
                  } 
                  $PerilsNameSave                 = $DefaultPremiumAmount->PerilsName ;
                  $Section                        =  "IV" ;
                  $CoverageAmountSave             = $DefaultPremiumAmount->CoverageAmount;
                  $CoveragesName                  = $DefaultPremiumAmount->PerilsNo;
                  $DenominationType               = trim($Denomination[0]) ; //$DefaultPremiumAmount->SubLinesNo;
      }else{    ///CTPL ---OD/TF---AOG
                $DefaultPremiumAmount     = DefaultData::select('*')->where('LinesNo',trim($Denomination[0]))->where('PerilsClass',trim($PerilsName))->where('Converter',"PremiumComp")->where('Active',"1")->first();
                
               // return response()->json(['success' =>    $DefaultPremiumAmount ], 200);      
                    if ( trim($request['usages']) === "Commercial Use"){   ///for Commercial
                          if (trim($PerilsNo[1]) === "PA" ) {
                            $ComputationPremium      =    round($POAmount *  $DefaultPremiumAmount->Amount * $FindSurcharge->Amount, 2) ;
                        
                          }else{
                            $ComputeFormula             = $POAmount . $DefaultPremiumAmount->Formula ;
                            $ComputationPremium        =  eval('return '.$ComputeFormula.';');
                            $PremiumAmount              = $DefaultPremiumAmount->CompPremium;  // round($DefaultPremiumAmount->Amount , 2) ;
                            $Surcharge                  =  round($DefaultPremiumAmount->Surcharge, 2) ;
                          } 
                    }else{
                     
                            $ComputeFormula             = $POAmount . $DefaultPremiumAmount->Formula ;
                            $ComputationPremium        =  eval('return '.$ComputeFormula.';');
                            $PremiumAmount              = $DefaultPremiumAmount->CompPremium;  // round($DefaultPremiumAmount->Amount , 2) ;
                            $Surcharge                  =  round($DefaultPremiumAmount->Surcharge, 2) ;
                   
                        
                    }
                    if (trim($PerilsNo[1]) === "CT" ) {
                       $CoverageAmountSave          =  100000;
                    }else{
                      $CoverageAmountSave          =  $POAmount;
                    }
                  $PerilsNameSave              =  $DefaultPremiumAmount->PerilsName ;
                  $Section                     =  $DefaultPremiumAmount->Section ;
                  $CoveragesName               =  $DefaultPremiumAmount->PerilsClass; 
                  $DenominationType            =  $DefaultPremiumAmount->LinesNo;
                  $PerilsDescription           = str_replace("4",$request['passengers'], trim($DefaultPremiumAmount->Description));
              
         }
        // return response()->json(['success' => $FindCoveragess  ], 200); 
         $TotalComputationPremium     += $ComputationPremium;

            $RequestCoverages = new RequestCoverages;
            
              $RequestCoverages->RequestNo               = $AccountNo;
              $RequestCoverages->CoveragesName           =  $CoveragesName ; //$request['PerilsName'][$P];
              $RequestCoverages->PerilsName              =  $PerilsNameSave ; //$ProductLinesPerils->PerilsName ;
              $RequestCoverages->PerilsCode              = trim($PerilsNo[1]) ;
              $RequestCoverages->Description             = $PerilsDescription;
              $RequestCoverages->CoveragesAmount         = $CoverageAmountSave;
              $RequestCoverages->DepreciativeAmount      = round( $POAmount , 2) ;
              $RequestCoverages->Surcharge               = round( $Surcharge , 2) ;
              $RequestCoverages->CoveragesPremium        = round( $ComputationPremium , 2) ;
              $RequestCoverages->PremiumAmount           = round($PremiumAmount, 2);
            //  $RequestCoverages->TotalPremiumAmount      = round( $TotalComputationPremium , 2);
              $RequestCoverages->OptionNo                = 1;
              $RequestCoverages->Active                  = '1' ;
              $RequestCoverages->Status                  = 1;
              // $RequestCoverages->Sort                    = $SortPerilsName[2];
              $RequestCoverages->CoverageRates           = $RatePercentage;
               $RequestCoverages->DenominationType        = $DenominationType ;
              $RequestCoverages->Section                 =  $Section;//$ProductLinesPerils->Section ;
              $RequestCoverages->RequestModifyCoverages  = 0 ;
              $RequestCoverages->RequestModify           = 0 ;
              $RequestCoverages->PAmountODTF             = 0;
              $RequestCoverages->CAmountODTF             = 0 ;
              $RequestCoverages->UpdateRequest          = 0;   
              $RequestCoverages->save();

      }   ///close for Loop Coverages
      //-------Charges------Charges-----Charges-----Charges------->
      $FindProductLineCharge  = ProductLinesCharges::select('*')->where('ProductLine','2019-MC-0001')->where('Active','1')->get();
      
      $CompCharges=0;
      foreach($FindProductLineCharge as $FindProductLineCharges)
      { 
          //-------Doc Stamp Comp-------------------->
    if ( trim($FindProductLineCharges->ChargesType) === 'Percent'){
             if ( trim($FindProductLineCharges->ChargesNo) === '2019-DP-0001'){
            
                              $val 		      = $FindProductLineCharges->ChargesAmount  * $TotalComputationPremium ;
                              $num 		      = round($val,2);
                              $StringVal 	  = strval($num );
                              $int 		      = (int)$num;
                              $float 		    = (float)$num;
                              $Value51      = 50; 

                            if(is_float($num)){
                                $numpart    = explode(".",$StringVal);  
                                if( empty($numpart[1]) ){
                                      $CompChargesAmount   = $num ;
                                }else{
                                    $Val 		= round($numpart[1],2);
                                    if (  $Val <= $Value51){
                                      $CompChargesAmount   = $int . '.'. 50;
                                    }else{
                                    
                                      $CompChargesAmount   = $int +  1;
                                    }
                                }
                            }
          }else{
            $CompChargesAmount =  $FindProductLineCharges->ChargesAmount * $TotalComputationPremium  ; 
          }  


  }else{

    $RequestCoveragesPA     = RequestCoverages::where('RequestNo',$AccountNo)->where('PerilsCode','CT')->first();
                if ( trim($FindProductLineCharges->ChargesNo) === '2019-CC-0005'){ //DOC.Stamp 2019-CC-0005
                      if ( !empty($RequestCoveragesPA->PerilsCode)){
                              $CompChargesAmount =  $FindProductLineCharges->ChargesAmount ;  
                        }else{
                              $CompChargesAmount = 0.00;
                        }
                }else{
                      $CompChargesAmount =  $FindProductLineCharges->ChargesAmount ;  
                }
  }
      
          $CompCharges += $CompChargesAmount;
            $CountCharges      = RequestCharges::count() + 1;
            $RequestCharge = new RequestCharges;
                $RequestCharge->ChargesNo             = $CountCharges;
                $RequestCharge->RequestNo             = $AccountNo;
                $RequestCharge->ChargesName           = $FindProductLineCharges->ChargesName ;
                $RequestCharge->ChargesAmount         = $FindProductLineCharges->ChargesAmount ;
                $RequestCharge->ChargesPremium        =  round($CompChargesAmount , 2);
                $RequestCharge->ChargesType           = $FindProductLineCharges->ChargesType ;
                $RequestCharge->ChargesNo             = $FindProductLineCharges->ChargesNo ;
                $RequestCharge->OptionNo              = 1;
                $RequestCharge->TotalCharges          =  round($CompCharges , 2);
                $RequestCharge->Active                ='1';
                $RequestCharge->Status                = 1 ;
                $RequestCharge->UpdateRequest          = 0;
                $RequestCharge->save();
          
  }    //close for Loop CHARGES
        $CompAmount   =   $TotalComputationPremium +  $CompCharges;  

        $UpdateCharges    = RequestCharges::where('RequestNo',$AccountNo)->get();
        foreach($UpdateCharges as $UpdateCharges1){ 
                $UpdateCharges1->TotalCharges            =  round($CompCharges , 2);
                $UpdateCharges1->TotalAmountDue          =  round($CompAmount , 2);
                $UpdateCharges1->save();
        }

//-------RequestDetails------RequestDetails-----RequestDetails-----RequestDetails------->
        $DefaultCRD     = DefaultData::where('DefaultDataNo','2019-CR-0014')->first();

        $CurrentDate1   = date('Y-m-d');
        $EffectiveDate  =  $request['EffectiveDate'];

        if ($request['EffectiveDate'] != ''){  //No Known Loss 
          $date1          = strtotime($CurrentDate1 );    //date Computation
          $date2          = strtotime($EffectiveDate);  
          $CompDaysLate   = ($date1 - $date2)/60/60/24;

        }else{
          $CompDaysLate   = 1 ;
        }
       

        $RequestDetails = new RequestDetails;
        $RequestDetails->ProductLine                  = '2019-MC-0001';
        $RequestDetails->RequestNo                    = $AccountNo; 
        $RequestDetails->CustAcctNO                   = $request['CustAcctNo']; 
        $RequestDetails->AcctName                     = $request['AcctName'];   
        $RequestDetails->RatePercent                  = $RatePercentage;
        $RequestDetails->PremiumAmount                = 0;
        $RequestDetails->AmountDue                    = 0 ;
        $RequestDetails->TotalCharges                 = 0 ;
        $RequestDetails->TotalCoverages               = 0 ;
        $RequestDetails->DepreciativeAmount           =  round($request['DepreciativeAmount'], 2) ;
        //$RequestDetails->DepreciativeEveryYearPrcnt   =  round($DepreciativeEveryYearPrcnt, 2) ;
       // $RequestDetails->DepreciativeAmount           =  round($request['DepreciativeNumberYear'], 2) ;
       // $RequestDetails->DepreciativeEveryYear        =  round($request['DepreciativeNumberYear'], 2) ;
       // $RequestDetails->NoYrsDepreciative            =  $NoYrsDepreciative ;        
        $RequestDetails->MotorSurcharge               = $Surcharge ;
        $RequestDetails->PlateNumber                  = $request['PlateNumber'];  
        $RequestDetails->Denomination                 = $Denomination[0];
        $RequestDetails->SubLinesName                 = $Denomination[1];
        $RequestDetails->MotorPOAmount                = $request['POAMount'];
        $RequestDetails->CoverageAmount               = round($POAmount, 2) ; ///depreciative amount
        $RequestDetails->MotorYear                    = $request['YearPO'];
        $RequestDetails->MotorBrand                   = $request['CarBrand'];
        $RequestDetails->MotorModel                   = $request['CarModel'];
        $RequestDetails->MotorBodyType                = $request['BodyType'];
        $RequestDetails->MotorUsage                   = $request['usages'];
        $RequestDetails->MotorNetWeight               = $request['MotorNetWeight'];
        $RequestDetails->MotorWithAccessories         = $request['MotorAccessories'];
        $RequestDetails->MotorEffectiveDate           = $request['EffectiveDate'];
        $RequestDetails->MotorExpiryDate              = $request['ExpiryDate'];
        $RequestDetails->TINNumber                    = $request['TINNumber'];
        $RequestDetails->EmailAddress                 = $request['EmailAddress'];
        $RequestDetails->ContactNumber                = $request['ContactNumber'];
        $RequestDetails->FirstName                    = $request['first_name'];
        $RequestDetails->MiddleName                   = $request['middle_name'];
        $RequestDetails->LastName                     = $request['last_name'];
        $RequestDetails->CName                        = $request['first_name'] . " " . $request['middle_name']  . " " . $request['last_name'] ; 
        $RequestDetails->Address                      = $request['Address'];
        $RequestDetails->Barangay                     = $request['Barangay'];
        $RequestDetails->City                         = $request['CityName'];
        $RequestDetails->Passengers                   = $request['passengers'];
        $RequestDetails->Driver                       = 1;
        $RequestDetails->LateDaysNo                   = $CompDaysLate;
        $RequestDetails->Status                       ='Processing';
        $RequestDetails->Active                       ='1';
        $RequestDetails->QuoteExpiryStatus            = 0 ;
        $RequestDetails->BodyColor                    = 0 ;
        $RequestDetails->MortgageBankName             = 0 ;
        $RequestDetails->ChassisNo                    = 0 ;
        $RequestDetails->MvFileNo                     = 0 ;
        $RequestDetails->EngineNo                     = 0 ;
        $RequestDetails->RequestModify                = 0 ;
        $RequestDetails->InchargeAcctNo               = 0 ;
        $RequestDetails->AcceptedOption               = 0 ;
        $RequestDetails->ForSignature                 = 0 ;
        $RequestDetails->TotalCommission              = 0 ;
        $RequestDetails->StatusCashOut                = "Processing" ;
        $RequestDetails->AssignCRD                    = $DefaultCRD->Name ;
        $RequestDetails->CocNoRequest                 = '0';
        $RequestDetails->PaymentMode                  = '0';
        $RequestDetails->CashOutAmount                = 0;
        $RequestDetails->CashOutPaidAmount            = 0;
        $RequestDetails->UpdateRequest                = 0; 
        $RequestDetails->OktoAccept                   = 0; 
        $RequestDetails->save();
        
}
public function UpdateRequest($id)
{ 

        $RequestCoverages     = RequestCoverages::where('RequestNo',$id)->where('UpdateRequest',0)->get();
        $TotalPremium = 0;  $TotalCoverages = 0; 
        foreach($RequestCoverages as $RequestCoveragess){ 
                  $TotalCoverages    += $RequestCoveragess->CoveragesAmount;
                  $TotalPremium      += $RequestCoveragess->CoveragesPremium;
          if ( $RequestCoveragess->PerilsCode == 'AOG'  ){   
                $WithAOGPremium     =  $RequestCoveragess->CoveragesPremium;
                $WithAOGCoverages   =  $RequestCoveragess->CoveragesAmount;
                $WithAOG = "YES";
          }else{
                $WithAOGPremium     =  0.00;
                $WithAOGCoverages   =  0.00;
                $WithAOG = "NO";
          }         
                  
                  $RequestCoveragess->WithAOGPremium         =  round($WithAOGPremium , 2); 
                  $RequestCoveragess->WithAOGCoverages       =  round($WithAOGCoverages , 2); 
                  $RequestCoveragess->WithAOG                = $WithAOG ;
                  $RequestCoveragess->save(); 

          } //close for Loop

          $RequestCoveragesUpdate1    = RequestCoverages::where('RequestNo',$id)->where('UpdateRequest',0)->get();
          foreach($RequestCoveragesUpdate1 as $RequestCoveragesUpdate){ 

                $RequestCoveragesAOG1    = RequestCoverages::where('RequestNo',$id)->where('PerilsCode','AOG')->first();

                if ( !empty($RequestCoveragesAOG1->PerilsCode)){
                  $NoAOGPremiumTotal     =      $TotalPremium       -  $RequestCoveragesAOG1->CoveragesPremium;
                  $NoAOGCoveragesTotal   =      $TotalCoverages     -  $RequestCoveragesAOG1->CoveragesAmount;
                }else{
                  $NoAOGPremiumTotal       =      $TotalPremium  ;
                  $NoAOGCoveragesTotal     =      $TotalCoverages ;
                }
                $TowingLimit            = DefaultData::where('DefaultDataNo','2019-TL-0013')->first();
                // $CoveragesDeductibles->Deductible           = round($DeductableNew , 2);
                $RequestCoveragesUpdate->TowingLimit          = round($TowingLimit->Amount, 2);
                $RequestCoveragesUpdate->NoAOGPremiumTotal      = round($NoAOGPremiumTotal , 2); 
                $RequestCoveragesUpdate->NoAOGCoveragesTotal    = round($NoAOGCoveragesTotal , 2); 
                $RequestCoveragesUpdate->TotalPremium           = round($TotalPremium , 2); 
                $RequestCoveragesUpdate->TotalCoverages         = round($TotalCoverages , 2); 
                $RequestCoveragesUpdate->save(); 
          }
          $RequestCoveragesAOG    = RequestCoverages::where('RequestNo',$id)->where('PerilsCode','AOG')->first();
          if ( !empty($RequestCoveragesAOG->PerilsCode)){
              $WithAOGUpdate  ="YES";
          }else{
              $WithAOGUpdate  ="NO";
          }

          $RequestCoveragesCTPL    = RequestCoverages::where('RequestNo',$id)->where('PerilsCode','CT')->first();
          if ( !empty($RequestCoveragesCTPL->PerilsCode)){
              $HasCTPL   = 1;
          }else{
              $HasCTPL   = 0;
          }
          $RequestDetailsUpdate                   = RequestDetails::where('RequestNo',$id)->where('UpdateRequest',0)->first();
          $RequestDetailsUpdate->WithAOG          = $WithAOGUpdate ;
          $RequestDetailsUpdate->HasCTPL          =  $HasCTPL  ;
          $RequestDetailsUpdate->save();
          
          
                 $RequestCoveragesOD    = RequestCoverages::where('RequestNo',$id)->where('PerilsCode','OD')->where('UpdateRequest',0)->first();
                $RequestCoveragesTF     = RequestCoverages::where('RequestNo',$id)->where('PerilsCode','TF')->where('UpdateRequest',0)->first();
                if ( !empty($RequestCoveragesOD->PerilsCode)){
                      $CAmountODTF           = $RequestCoveragesOD->CoveragesAmount +   $RequestCoveragesTF->CoveragesAmount;
                      $PAmountODTF           = $RequestCoveragesOD->CoveragesPremium +  $RequestCoveragesTF->CoveragesPremium; 
                        
                      $RequestCoveragesOD->CAmountODTF            =  round($CAmountODTF , 2); 
                      $RequestCoveragesOD->PAmountODTF            =  round($PAmountODTF , 2); 
                      $RequestCoveragesOD->save(); 
        
                      $RequestCoveragesTF->CAmountODTF            = round($CAmountODTF , 2); 
                      $RequestCoveragesTF->PAmountODTF            = round($PAmountODTF , 2); 
                      $RequestCoveragesTF->save(); 
               
                }else{
                      $CAmountODTF    = 0.00; $PAmountODTF   = 0.00;
                  } 
                 //Deductable
                // $GetDenomination     = RequestDetails::where('RequestNo',$id)->first();
                // $GetDenominationExplode  =  explode('-' ,$GetDenomination->Denomination);

                 $CoveragesDeductible   = RequestCoverages::where('RequestNo',$id)->where('UpdateRequest',0)->get();
                 foreach($CoveragesDeductible as $CoveragesDeductibles){ 
                      $GetDenominationExplode  =  explode('-',$CoveragesDeductibles->DenominationType);
                      
                  if (trim($CoveragesDeductibles->DenominationType) === "2019-PC-0001" ) {
                        $FindDefaultDeductible     = DefaultData::where('DefaultDataNo','2019-DE-0004')->first();
                        $PAmountODTF1  = $CAmountODTF;
                  }if (trim($CoveragesDeductibles->DenominationType) === "2019-PC-0002" ) {
                        $FindDefaultDeductible     = DefaultData::where('DefaultDataNo','2019-DE-0005')->first();
                        $PAmountODTF1  = $CAmountODTF;
                  } if (strpos($CoveragesDeductibles->DenominationType, 'CV') !== false   ) {
                      $FindDefaultDeductible     = DefaultData::where('DefaultDataNo','2019-CV-0006')->first();
                      $PAmountODTF1  = $CAmountODTF;
                }if (strpos($CoveragesDeductibles->DenominationType, 'MC') !== false  ) {
                     $FindDefaultDeductible     = DefaultData::where('DefaultDataNo','2019-MC-0007')->first();
                      $PAmountODTF1  = 1;
                }
                
                
                if ($CoveragesDeductibles->PerilsCode == "OD" || $CoveragesDeductibles->PerilsCode === "TF" ){
                    $Deductable =  $PAmountODTF1  * $FindDefaultDeductible->Amount; 
                    if ($Deductable < $FindDefaultDeductible->MinAmount){  //less than the declare amount
                        $DeductableNew     =  $FindDefaultDeductible->MinAmount;
                    }else{
                        $DeductableNew =  $PAmountODTF1  * $FindDefaultDeductible->Amount;
                    }
              }else{
                    $DeductableNew =  $FindDefaultDeductible->MinAmount;

               } 
               // return response()->json(['success' => $GetDenominationExplode[1] ], 200);
            
               $CoveragesDeductibles->Deductible           = round($DeductableNew , 2);
               $CoveragesDeductibles->save();
                }

            //--------------Update Charges-----------------------
            $FindProductLineCharge1  = ProductLinesCharges::select('*')->where('ProductLine','2019-MC-0001')->where('Active','1')->get();
              
            $CompCharges1=0;
            foreach($FindProductLineCharge1 as $FindProductLineChargess)
            { 

              $RequestAOGCoverages     = RequestCoverages::where('RequestNo',$id)->first();
              if ( trim($FindProductLineChargess->ChargesType) === 'Percent'){
                if ( trim($FindProductLineChargess->ChargesNo) === '2019-DP-0001'){
                    $val 		      = $FindProductLineChargess->ChargesAmount  * $RequestAOGCoverages->NoAOGPremiumTotal ;
                    $num 		      = round($val,2);
                    $StringVal 	  = strval($num );
                    $int 		      = (int)$num;
                    $float 		    = (float)$num;
                    $Value51      = 50; 
        
                      if(is_float($num)){
                            $numpart    = explode(".",$StringVal);  
                            if( empty($numpart[1]) ){
                                  $CompChargesAmount1   = $num ;
                            }else{
                                $Val 		= round($numpart[1],2);
                                if (  $Val <= $Value51){
                                  $CompChargesAmount1   = $int . '.'. 50;
                                }else{
                                
                                  $CompChargesAmount1   = $int +  1;
                                }
                            }
                      }
          
              }else{
                $CompChargesAmount1 =  $FindProductLineChargess->ChargesAmount * $RequestAOGCoverages->NoAOGPremiumTotal ; 
              }  
            

          }else{
                $CompChargesAmount1 =  $FindProductLineChargess->ChargesAmount ;  
          }

              
                $CompCharges1 += $CompChargesAmount1; 
                $UpdateCharges2    = RequestCharges::where('RequestNo',$id)->where('ChargesNo',$FindProductLineChargess->ChargesNo)->where('UpdateRequest',0)->get();
                foreach($UpdateCharges2 as $UpdateCharges22){ 
                      $UpdateCharges22->ChargesPremiumAOG             = round($CompChargesAmount1 , 2);
                      //$UpdateCharges22->TotalChargesAOG               = $CountCharges;
                      $UpdateCharges22->save();
                
              }  
        }  
        
        $UpdateCharges2    = RequestCharges::where('RequestNo',$id)->where('UpdateRequest',0)->get();
        foreach($UpdateCharges2 as $UpdateCharges22){ 
              //$UpdateCharges22->ChargesPremiumAOG             = $CompChargesAmount;
              $UpdateCharges22->TotalChargesAOG               =  round($CompCharges1 , 2);
              $UpdateCharges22->save();
        
      } 
      
      //once update done---change status of  UpdateRequest = 1
      $UpdateRequestCharges    = RequestCharges::where('RequestNo',$id)->where('UpdateRequest',0)->get();
      foreach($UpdateRequestCharges as $UpdateRequestChargess){ 
            $UpdateRequestChargess->UpdateRequest               =  1;
            $UpdateRequestChargess->save();
     } 

     $UpdateRequestCoverages    = RequestCoverages::where('RequestNo',$id)->where('UpdateRequest',0)->get();
     foreach($UpdateRequestCoverages as $UpdateRequestCoveragess){ 
           $UpdateRequestCoveragess->UpdateRequest               =  1;
           $UpdateRequestCoveragess->save();
    } 


    $UpdateRequestDetails    = RequestDetails::where('RequestNo',$id)->where('UpdateRequest',0)->first();
          $UpdateRequestDetails->UpdateRequest               =  1;
          $UpdateRequestDetails->save();
 




              

}


    public function store(Request $request)
    {

      date_default_timezone_set('Asia/Hong_Kong');

        $curYear = date('Y'); 
        $CountUser = RequestDetails::count() + 1;
        //$wordCount = $wordlist->count();
        $NewCountUser = str_pad($CountUser, 4, '0' , STR_PAD_LEFT); 
       
        $AccountNo =  $curYear. "-".$NewCountUser;
       // $request['POAMount'] = 150000;

           //-------Depreciative ------------------------------------------
           $CurrentYear       =  now()->year;
           $NoYrsDepreciative =  trim($CurrentYear) -  trim($request['YearPO']);
           //$NoYrsDepreciative =  trim($CurrentYear) -  2018;


           $DepreciativeEveryYearPrcnt      = $NoYrsDepreciative  * 0.10;
           $DepreciativeEveryYear           = $request['POAMount'] * $DepreciativeEveryYearPrcnt;
           $DepreciativeAmount              = $request['POAMount'] - $DepreciativeEveryYear  ;

      // $RequestSurcharge->save();


        $FindDefaultDataRate       =  DefaultData::where('DefaultDataNo','2019-RE-0001')->first();
        $FindDefaultDataAmount     =  DefaultData::where('DefaultDataNo','2019-CT-0003')->first();
        $TaripaMaxAmount           = 1000000;

        if ( trim($request['POAMount']) == ' ' || trim($request['POAMount']) == 0 ){   //no MArket Value

              $POAmount     = $FindDefaultDataAmount->Amount;
              
        }else{
           
             if ( $request['POAMount']  <= $FindDefaultDataAmount->Amount  ){ //less than default value
                  $POAmount              = $FindDefaultDataAmount->Amount;
             }else{
                  if ($DepreciativeAmount > $TaripaMaxAmount){
                      $MaxAmount    =  $TaripaMaxAmount ; 
                  }else{
                      $MaxAmount  =  $DepreciativeAmount ; 
                  }

                   //$FindCoveragesss = ProductLinesPerilsTaripa::select('*')->where('CoverageAmount', '>=',round($DepreciativeAmount ))->first();
                   $FindCoveragesss = ProductLinesPerilsTaripa::select('*')->where('CoverageAmount', '>=',round($MaxAmount ))->first();
          
                    $POAmount     =  $FindCoveragesss->CoverageAmount; // Computation of Market Value;
             }
        }

       // $POAmount = 150000;
          $RatePercentage  =  $FindDefaultDataRate->Amount;


          $ComputationPremium       = 0 ; 
          $totalPerilsName1         = $request['PerilsName'];
         
        for($P=0 ;$P < count($totalPerilsName1)  ;$P++)
        { 
         
           $PerilsNoOD          =  trim($request['PerilsName'][$P]);
           $ExplodePerilsNo1    = explode('-' ,$PerilsNoOD);
          //  if (trim($ExplodePerilsNo1[1]) === "OD" || trim($ExplodePerilsNo1[1]) === "TF") {
          //      if ( trim($request['PerilsName'][$P])  === "2019-TF-0002"){
          //         $ArrayPerilsName = array('2019-OD-0003',$request['PerilsName'][$P]);
          //      } else{
          //         $ArrayPerilsName = array('2019-TF-0002',$request['PerilsName'][$P]);
          //       }
              
          //   } else{
          //       $ArrayPerilsName = array($request['PerilsName'][$P]);
                 
          //   }

            $ArrayPerilsName = array($request['PerilsName'][$P]);

          }
     
     //-------Request Coverages------Request Coverages-----Request Coverages-----Request Coverages------->
     $Denomination   = explode(';;' ,$request['Denomination']);
    //  if (trim($Denomination[0]) === "2019-PC-0001" ) {
    //        $FindDefaultDeductible     = DefaultData::where('DefaultDataNo','2019-DE-0004')->first();
    //   }

     $AOGFormula  = 0.005;
     $totalPerilsName1         = $request['PerilsName'];
        for($k=0 ;$k < count($totalPerilsName1)  ;$k++)
        { 
          $CountCoverages = RequestCoverages::count() + 1;
          $PerilsNo       = $request['PerilsName'][$k];
        
          $ExplodePerilsNo = explode('-' ,$PerilsNo);


          ///------------Premium

                $FindCoveragess           = ProductLinesPerilsTaripa::select('*')->where('CoverageAmount','>=',round($POAmount))->where('PerilsNo',trim($PerilsNo))->where('SubLinesNo',$Denomination[0])->first();
                $FindCoveragessPCS       = ProductLinesPerilsTaripa::select('*')->where('CoverageAmount','>=',round($POAmount))->where('PerilsNo',trim($PerilsNo))->where('SubLinesNo','2019-PC-0001')->first();
           //problem in PerilsNo  $FindCoveragessPCS   
                $DefaultPremiumAmount     = DefaultData::select('*')->where('LinesNo',trim($Denomination[0]))->where('PerilsClass',trim($PerilsNo))->where('Converter',"PremiumComp")->where('Active',"1")->first();
                if (!empty ($DefaultPremiumAmount)){
                       $DefaultAmount =  $DefaultPremiumAmount->Amount;
                }else{
                     $DefaultAmount  =  0.0025;  //default is not on the LIST of Denomination
                }
             
               
                if (!empty ($FindCoveragess)){  ///Condition in the TARIPA
                  $FindCoveragessPremium    =  round($FindCoveragess->PremiumAmount,2) ; 
                  $FindCoveragessCoverage   =  $FindCoveragess->CoverageAmount;
             }else{    ///NO record on TARIPA use 2019-PC-0001  PC1
                    $FindCoveragessPremium    =   round($FindCoveragessPCS->PremiumAmount,2) ; 
                    $FindCoveragessCoverage   =   $FindCoveragessPCS->CoverageAmount;
              }
             
           
                $FindSurcharge  = DefaultData::where('DefaultDataNo','2019-SE-0012')->first();
                  if ( trim($request['usages']) === "Commercial Use"){
                     if (trim($ExplodePerilsNo[1]) === "PA" ) {
                          $CompPremium      =   ($POAmount *   $DefaultAmount )* $FindSurcharge->Amount ;
                          $PremiumAmount    =   $DefaultAmount ;
                          $Surcharge        = $FindSurcharge->Amount;
                      
                     } 
                     if (trim($ExplodePerilsNo[1]) === "XBI" || trim($ExplodePerilsNo[1]) === "PD"  ) {
                            $CompPremium    =    $FindCoveragessPremium  * $FindSurcharge->Amount;
                            $PremiumAmount  =    $FindCoveragessPremium ;
                            $Surcharge      =    $FindSurcharge->Amount;
                    }

                  }else{
                          if (trim($ExplodePerilsNo[1]) === "PA" ) {
                            $CompPremium      =   ($POAmount *   $DefaultAmount ) ;
                            $PremiumAmount    =    $DefaultAmount ;
                            $Surcharge        =    0.00;
                        
                      } 
                      if (trim($ExplodePerilsNo[1]) === "XBI" || trim($ExplodePerilsNo[1]) === "PD"  ) {
                              $CompPremium    =    $FindCoveragessPremium  ;
                              $PremiumAmount  =    $FindCoveragessPremium ;
                              $Surcharge      =    0.00;
                      }

                  }

                if (trim($ExplodePerilsNo[1]) === "OD" || trim($ExplodePerilsNo[1]) === "TF") {
                    $CompPremium      =  ( ( $RatePercentage * $DepreciativeAmount) *  $DefaultAmount  );
                    $PremiumAmount =   $DefaultAmount ;
                    $Surcharge = 0;
                   
                }else if (trim($ExplodePerilsNo[1]) === "AOG"  ) {
                    $CompPremium  =   $DepreciativeAmount *   $DefaultAmount  ;
                    $PremiumAmount =  $DefaultAmount ;
                    $Surcharge = 0;
               }else if ( trim($ExplodePerilsNo[1]) === "CT") {
                    $CompPremium  =    $DefaultAmount  ;
                    $PremiumAmount =   $DefaultAmount ;
                    $Surcharge = 0;     
                }


            
                  $ComputationPremium += $CompPremium;
                  $ProductLinesPerils     = ProductLinesPerils::where('PerilsNo',trim($ArrayPerilsName[$k]))->first();
                  $SortPerilsName   = explode('-' ,$ArrayPerilsName[$k]);
				  
				  if ( $ProductLinesPerils->PerilsCode == "CT"){
					    $CTPLDefaultAmount      = DefaultData::where('DefaultDataNo','2019-CT-0003')->first();
              $CoverageAmountSave 	  =  $CTPLDefaultAmount->Amount;
              $NumberPassenger         = $request['passengers'];
           
          }else if (trim($ExplodePerilsNo[1]) === "OD" || trim($ExplodePerilsNo[1]) === "TF" || trim($ExplodePerilsNo[1]) === "AOG") {
                 $CoverageAmountSave     =  $DepreciativeAmount;
                
          }else if (trim($ExplodePerilsNo[1]) === "PA") {
                     $CoverageAmountSave     =  $POAmount ;
      
           }else if  (trim($ExplodePerilsNo[1]) === "XBI" || trim($ExplodePerilsNo[1]) === "PD" ) {
                $CoverageAmountSave      =  $FindCoveragessCoverage ;
            }
              
              $NumberPassenger        = 4 ;
		
          $PerilsDescription    = str_replace("4",$request['passengers'], trim($ProductLinesPerils->Description));

                  $RequestCoverages = new RequestCoverages;
                  $RequestCoverages->CoveragesNo             = $CountCoverages;
                  $RequestCoverages->RequestNo               = $AccountNo;
                  $RequestCoverages->CoveragesName           = $ArrayPerilsName[$k];
                  $RequestCoverages->PerilsName              = $ProductLinesPerils->PerilsName ;
                  $RequestCoverages->PerilsCode              = $ProductLinesPerils->PerilsCode ;
				          $RequestCoverages->Description             = $PerilsDescription;
                  $RequestCoverages->CoveragesAmount         = $CoverageAmountSave;
                  $RequestCoverages->CoveragesPremium        = round( $CompPremium , 2) ;
                  $RequestCoverages->PremiumAmount           = round($PremiumAmount, 2);
                  $RequestCoverages->TotalPremiumAmount      = round( $ComputationPremium , 2);
                  $RequestCoverages->OptionNo                = 1;
                  $RequestCoverages->Active                  = '1' ;
                  $RequestCoverages->Status                  = 1;
                  $RequestCoverages->Sort                    = $SortPerilsName[2];
                  $RequestCoverages->CoverageRates           = $RatePercentage;
                  $RequestCoverages->DenominationType        = $Denomination[0];
                  $RequestCoverages->Section                 = $ProductLinesPerils->Section ;
                  $RequestCoverages->RequestModifyCoverages  = 0 ;
                  $RequestCoverages->RequestModify           = 0 ;
                  $RequestCoverages->PAmountODTF             = 0;
                  $RequestCoverages->CAmountODTF             = 0 ;
                 
                  
                  //$RequestCoverages->Deductible           = round($DeductableNew , 2);
                  
                  
             $RequestCoverages->save();

            
      }
          
   // }
      //-------Charges------Charges-----Charges-----Charges------->
        $FindProductLineCharge  = ProductLinesCharges::select('*')->where('ProductLine','2019-MC-0001')->where('Active','1')->get();
      
        $CompCharges=0;
        foreach($FindProductLineCharge as $FindProductLineCharges)
        { 
            //-------Doc Stamp Comp-------------------->
      if ( trim($FindProductLineCharges->ChargesType) === 'Percent'){
                    if ( trim($FindProductLineCharges->ChargesNo) === '2019-DP-0001'){
                  $val 		      = $FindProductLineCharges->ChargesAmount  * $ComputationPremium ;
                  $num 		      = round($val,2);
                  $StringVal 	  = strval($num );
                  $int 		      = (int)$num;
                  $float 		    = (float)$num;
                  $Value51      = 51; 

                if(is_float($num)){
                    $numpart    = explode(".",$StringVal);  
                    if( empty($numpart[1]) ){
                          $CompChargesAmount   = $num ;
                    }else{
                        $Val 		= round($numpart[1],2);
                        if (  $Val <= $Value51){
                          $CompChargesAmount   = $int . '.'. 50;
                        }else{
                        
                          $CompChargesAmount   = $int +  1;
                        }
                    }
                }

            }else{
              $CompChargesAmount =  $FindProductLineCharges->ChargesAmount * $ComputationPremium  ; 
            }  


    }else{
        $CompChargesAmount =  $FindProductLineCharges->ChargesAmount ;  
    }
          


        
            $CompCharges += $CompChargesAmount;
              $CountCharges      = RequestCharges::count() + 1;
              $RequestCharge = new RequestCharges;
                  $RequestCharge->ChargesNo             = $CountCharges;
                  $RequestCharge->RequestNo             = $AccountNo;
                  $RequestCharge->ChargesName           = $FindProductLineCharges->ChargesName ;
                  $RequestCharge->ChargesAmount         = $FindProductLineCharges->ChargesAmount ;
                  $RequestCharge->ChargesPremium        =  round($CompChargesAmount , 2);
                  $RequestCharge->ChargesType           = $FindProductLineCharges->ChargesType ;
                  $RequestCharge->ChargesNo             = $FindProductLineCharges->ChargesNo ;
                  $RequestCharge->OptionNo              = 1;
                  $RequestCharge->TotalCharges          =  round($CompCharges , 2);
                  $RequestCharge->Active                ='1';
                  $RequestCharge->Status                = 1 ;
                  $RequestCharge->save();
            
          }  
          $CompAmount   =   $ComputationPremium +  $CompCharges;  

          $UpdateCharges    = RequestCharges::where('RequestNo',$AccountNo)->get();
          foreach($UpdateCharges as $UpdateCharges1){ 
                  $UpdateCharges1->TotalCharges            =  round($CompCharges , 2);
                  $UpdateCharges1->TotalAmountDue          =  round($CompAmount , 2);
                  $UpdateCharges1->save();
          }


            //$CompCharges  =  $CompChargesAmount + ( $Vat->Amount *  $ComputationPremium  ) + ($LGT->Amount *  $ComputationPremium  ) + $COCFee->Amount  +  $BayadCenter->Amount ;
           

           

		//-------RequestDetails------RequestDetails-----RequestDetails-----RequestDetails------->
    
          $CurrentDate1   = date('Y-m-d');
          $EffectiveDate  =  $request['EffectiveDate'];


          if ($request['EffectiveDate'] != ''){  //No Known Loss 
            $date1          = strtotime($CurrentDate1 );    //date Computation
            $date2          = strtotime($EffectiveDate);  
            $CompDaysLate   = ($date1 - $date2)/60/60/24;

          }else{
            $CompDaysLate   = 1 ;
          }
         
       

          $DefaultCRD     = DefaultData::where('DefaultDataNo','2019-CR-0014')->first();

        $RequestDetails = new RequestDetails;
        $RequestDetails->ProductLine                  = '2019-MC-0001';
        $RequestDetails->RequestNo                    = $AccountNo; 
        $RequestDetails->CustAcctNO                   = $request['CustAcctNo']; 
        $RequestDetails->AcctName                     = $request['AcctName'];   
        $RequestDetails->RatePercent                  = $RatePercentage;
        //$RequestDetails->Deductable                   = round($DeductableNew , 2);
        $RequestDetails->PremiumAmount                = 0;
        $RequestDetails->AmountDue                    = 0 ;
        $RequestDetails->TotalCharges                 = 0 ;
        $RequestDetails->TotalCoverages               = 0 ;
        $RequestDetails->DepreciativeAmount           =  round($DepreciativeAmount, 2) ;
        $RequestDetails->DepreciativeEveryYearPrcnt   =  round($DepreciativeEveryYearPrcnt, 2) ;
        $RequestDetails->DepreciativeAmount           =  round($DepreciativeAmount, 2) ;
        $RequestDetails->DepreciativeEveryYear        =  round($DepreciativeEveryYear, 2) ;
        $RequestDetails->NoYrsDepreciative            =  $NoYrsDepreciative ;        
        $RequestDetails->MotorSurcharge               = $Surcharge ;
        $RequestDetails->PlateNumber                  = $request['PlateNumber'];
        $RequestDetails->Denomination                 = $Denomination[0];
        $RequestDetails->SubLinesName                 = $Denomination[1];
        $RequestDetails->MotorPOAmount                = $request['POAMount'];
        $RequestDetails->CoverageAmount               = round($POAmount, 2) ;;
        $RequestDetails->MotorYear                    = $request['YearPO'];
        $RequestDetails->MotorBrand                   = $request['CarBrand'];
        $RequestDetails->MotorModel                   = $request['CarModel'];
        $RequestDetails->MotorBodyType                = $request['BodyType'];
        $RequestDetails->MotorUsage                   = $request['usages'];
        $RequestDetails->MotorNetWeight               = $request['MotorNetWeight'];
        $RequestDetails->MotorWithAccessories         = $request['MotorAccessories'];
        $RequestDetails->MotorEffectiveDate           = $request['EffectiveDate'];
        $RequestDetails->MotorExpiryDate              = $request['ExpiryDate'];
        $RequestDetails->TINNumber                    = $request['TINNumber'];
        $RequestDetails->EmailAddress                 = $request['EmailAddress'];
        $RequestDetails->ContactNumber                = $request['ContactNumber'];
        $RequestDetails->FirstName                    = $request['first_name'];
        $RequestDetails->MiddleName                   = $request['middle_name'];
        $RequestDetails->LastName                     = $request['last_name'];
        $RequestDetails->Address                      = $request['Address'];
        $RequestDetails->Barangay                     = $request['Barangay'];
        $RequestDetails->City                         = $request['CityName'];
         $RequestDetails->Individual                  = $request['IndividualPass'];
       // $RequestDetails->AssuredAddress               = $request['AssuredAddress'];
       // $RequestDetails->AssuredCity                  = $request['AssuredCity'];
       // $RequestDetails->AssuredBarangay              = $request['AssuredBarangay'];
        $RequestDetails->Passengers                   = $NumberPassenger; //$request['passengers'];
        $RequestDetails->Driver                       = $request['driver'];
        $RequestDetails->LateDaysNo                   = $CompDaysLate;
        $RequestDetails->Status                       ='Processing';
        $RequestDetails->Active                       ='1';
        $RequestDetails->QuoteExpiryStatus            = 0 ;
        $RequestDetails->BodyColor                    = 0 ;
        $RequestDetails->MortgageBankName             = 0 ;
        $RequestDetails->ChassisNo                    = 0 ;
        $RequestDetails->MvFileNo                     = 0 ;
        $RequestDetails->EngineNo                     = 0 ;
        $RequestDetails->RequestModify                = 0 ;
        $RequestDetails->InchargeAcctNo               = 0 ;
        $RequestDetails->AcceptedOption               = 0 ;
        $RequestDetails->ForSignature                 = 0 ;
        $RequestDetails->TotalCommission              = 0 ;
        $RequestDetails->StatusCashOut                = "Processing" ;
        $RequestDetails->AssignCRD                    = $DefaultCRD->Name ;
        $RequestDetails->CocNoRequest                 = '0';
        $RequestDetails->PaymentMode                  = '0';
        $RequestDetails->CashOutAmount                = 0;
        $RequestDetails->CashOutPaidAmount            = 0;
        
        
        $RequestDetails->save();
      $RequestCoverages     = RequestCoverages::where('RequestNo',$AccountNo)->get();
  
   
   $TotalPremium = 0;  $TotalCoverages = 0; 
    foreach($RequestCoverages as $RequestCoveragess){ 
              $TotalCoverages    += $RequestCoveragess->CoveragesAmount;
              $TotalPremium      += $RequestCoveragess->CoveragesPremium;

     
      if ( $RequestCoveragess->PerilsCode == 'AOG'  ){   
            $WithAOGPremium     =  $RequestCoveragess->CoveragesPremium;
            $WithAOGCoverages   =  $RequestCoveragess->CoveragesAmount;
            $WithAOG = "YES";
      }else{
            $WithAOGPremium     =  0.00;
            $WithAOGCoverages   =  0.00;
            $WithAOG = "NO";
      }         
             
             
              $RequestCoveragess->WithAOGPremium         =  round($WithAOGPremium , 2); 
              $RequestCoveragess->WithAOGCoverages       =  round($WithAOGCoverages , 2); 
              $RequestCoveragess->WithAOG                = $WithAOG ;
              $RequestCoveragess->save(); 

             
    }
    $RequestCoveragesUpdate1    = RequestCoverages::where('RequestNo',$AccountNo)->get();
    foreach($RequestCoveragesUpdate1 as $RequestCoveragesUpdate){ 

          $RequestCoveragesAOG1    = RequestCoverages::where('RequestNo',$AccountNo)->where('PerilsCode','AOG')->first();

          if ( !empty($RequestCoveragesAOG1->PerilsCode)){
             $NoAOGPremiumTotal     =      $TotalPremium       -  $RequestCoveragesAOG1->CoveragesPremium;
             $NoAOGCoveragesTotal   =      $TotalCoverages     -  $RequestCoveragesAOG1->CoveragesAmount;
          }else{
            $NoAOGPremiumTotal       =      $TotalPremium  ;
            $NoAOGCoveragesTotal     =      $TotalCoverages ;
          }
        
          

          $RequestCoveragesUpdate->NoAOGPremiumTotal      = round($NoAOGPremiumTotal , 2); 
          $RequestCoveragesUpdate->NoAOGCoveragesTotal    = round($NoAOGCoveragesTotal , 2); 
          $RequestCoveragesUpdate->TotalPremium           = round($TotalPremium , 2); 
          $RequestCoveragesUpdate->TotalCoverages         = round($TotalCoverages , 2); 
          
          $RequestCoveragesUpdate->save(); 
    }

              $RequestCoveragesAOG    = RequestCoverages::where('RequestNo',$AccountNo)->where('PerilsCode','AOG')->first();
              if ( !empty($RequestCoveragesAOG->PerilsCode)){
                  $WithAOGUpdate  ="YES";
              }else{
                  $WithAOGUpdate  ="NO";
              }

              $RequestCoveragesCTPL    = RequestCoverages::where('RequestNo',$AccountNo)->where('PerilsCode','CT')->first();
              if ( !empty($RequestCoveragesCTPL->PerilsCode)){
                  $HasCTPL   = 1;
              }else{
                  $HasCTPL   = 0;
              }
              
             
              $RequestDetailsUpdate                   = RequestDetails::where('RequestNo',$AccountNo)->first();
              $RequestDetailsUpdate->WithAOG          = $WithAOGUpdate ;
              $RequestDetailsUpdate->HasCTPL          =  $HasCTPL  ;
              $RequestDetailsUpdate->save(); 



     
                $RequestCoveragesOD    = RequestCoverages::where('RequestNo',$AccountNo)->where('PerilsCode','OD')->first();
                $RequestCoveragesTF    = RequestCoverages::where('RequestNo',$AccountNo)->where('PerilsCode','TF')->first();
                if ( !empty($RequestCoveragesOD->PerilsCode)){
                      $CAmountODTF           = $RequestCoveragesOD->CoveragesAmount +   $RequestCoveragesTF->CoveragesAmount;
                      $PAmountODTF           = $RequestCoveragesOD->CoveragesPremium +  $RequestCoveragesTF->CoveragesPremium; 
                        
                      $RequestCoveragesOD->CAmountODTF            =  round($CAmountODTF , 2); 
                      $RequestCoveragesOD->PAmountODTF            = round($PAmountODTF , 2); 
                      $RequestCoveragesOD->save(); 
        
                      $RequestCoveragesTF->CAmountODTF            = round($CAmountODTF , 2); 
                      $RequestCoveragesTF->PAmountODTF            = round($PAmountODTF , 2); 
                      $RequestCoveragesTF->save(); 
               
                }else{
                  $CAmountODTF    = 0.00; $PAmountODTF   = 0.00;
 } 
                 //Deductable
                 $GetDenomination     = RequestDetails::where('RequestNo',$AccountNo)->first();
                 $GetDenominationExplode  =  explode('-' ,$GetDenomination->Denomination);

            if (trim($GetDenomination->Denomination) === "2019-PC-0001" ) {
                  $FindDefaultDeductible     = DefaultData::where('DefaultDataNo','2019-DE-0004')->first();
                  $PAmountODTF1  = $CAmountODTF;
             }else if (trim($GetDenomination->Denomination) === "2019-PC-0002" ) {
                  $FindDefaultDeductible     = DefaultData::where('DefaultDataNo','2019-DE-0005')->first();
                  $PAmountODTF1  = $CAmountODTF;
            }else if (trim($GetDenominationExplode[1] ) === "CV"   ) {
                $FindDefaultDeductible     = DefaultData::where('DefaultDataNo','2019-CV-0006')->first();
                $PAmountODTF1  = $CAmountODTF;
           }else if (trim($GetDenominationExplode[1] ) === "MC"   ) {
              $FindDefaultDeductible     = DefaultData::where('DefaultDataNo','2019-MC-0007')->first();
              $PAmountODTF1  = 1;
          }


          if (trim($ExplodePerilsNo[1]) === "OD" || trim($ExplodePerilsNo[1]) === "TF" ){
                    $Deductable =  $PAmountODTF1  * $FindDefaultDeductible->Amount; 
                    if ($Deductable < $FindDefaultDeductible->MinAmount){  //less than the declare amount
                        $DeductableNew             =  $FindDefaultDeductible->MinAmount;
                    }else{
                        $DeductableNew =  $PAmountODTF1  * $FindDefaultDeductible->Amount;
                    }
           }else{
                    $DeductableNew =  $FindDefaultDeductible->MinAmount;

          } 

      
          
          $TowingLimit   = DefaultData::where('DefaultDataNo','2019-TL-0013')->first();
          $CoveragesDeductible   = RequestCoverages::where('RequestNo',$AccountNo)->get();
           foreach($CoveragesDeductible as $CoveragesDeductibles){ 
                     $CoveragesDeductibles->Deductible           = round($DeductableNew , 2);
                     $CoveragesDeductibles->TowingLimit          = round($TowingLimit->Amount, 2);
                     $CoveragesDeductibles->save(); 
           }

   

            //--------------Charges-----------------------
              $FindProductLineCharge1  = ProductLinesCharges::select('*')->where('ProductLine','2019-MC-0001')->where('Active','1')->get();
              
              $CompCharges1=0;
              foreach($FindProductLineCharge1 as $FindProductLineChargess)
              { 

                $RequestAOGCoverages     = RequestCoverages::where('RequestNo',$AccountNo)->first();
                if ( trim($FindProductLineChargess->ChargesType) === 'Percent'){
                  if ( trim($FindProductLineChargess->ChargesNo) === '2019-DP-0001'){
                      $val 		      = $FindProductLineChargess->ChargesAmount  * $RequestAOGCoverages->NoAOGPremiumTotal ;
                      $num 		      = round($val,2);
                      $StringVal 	  = strval($num );
                      $int 		      = (int)$num;
                      $float 		    = (float)$num;
                      $Value51      = 51; 
          
                        if(is_float($num)){
                              $numpart    = explode(".",$StringVal);  
                              if( empty($numpart[1]) ){
                                    $CompChargesAmount1   = $num ;
                              }else{
                                  $Val 		= round($numpart[1],2);
                                  if (  $Val <= $Value51){
                                    $CompChargesAmount1   = $int . '.'. 50;
                                  }else{
                                  
                                    $CompChargesAmount1   = $int +  1;
                                  }
                              }
                        }
            
                }else{
                  $CompChargesAmount1 =  $FindProductLineChargess->ChargesAmount * $RequestAOGCoverages->NoAOGPremiumTotal ; 
                }  
              

            }else{
                  $CompChargesAmount1 =  $FindProductLineChargess->ChargesAmount ;  
            }

                
                  $CompCharges1 += $CompChargesAmount1; 
                  $UpdateCharges2    = RequestCharges::where('RequestNo',$AccountNo)->where('ChargesNo',$FindProductLineChargess->ChargesNo)->get();
                  foreach($UpdateCharges2 as $UpdateCharges22){ 
                        $UpdateCharges22->ChargesPremiumAOG             = round($CompChargesAmount1 , 2);
                        //$UpdateCharges22->TotalChargesAOG               = $CountCharges;
                        $UpdateCharges22->save();
                  
                }  
          }  
          
          $UpdateCharges2    = RequestCharges::where('RequestNo',$AccountNo)->get();
          foreach($UpdateCharges2 as $UpdateCharges22){ 
                //$UpdateCharges22->ChargesPremiumAOG             = $CompChargesAmount;
                $UpdateCharges22->TotalChargesAOG               =  round($CompCharges1 , 2);
                $UpdateCharges22->save();
          
        }  


///report / Logs---------------

$CurrentDate              = date('Y-m-d H:i:s');
    $ReportQuotation = new ReportQuotation;
    $ReportQuotation->Action               =  "ADDNEW";   
    $ReportQuotation->TransaID             =  $AccountNo;   
    $ReportQuotation->AcctNo               =  $request['CustAcctNo'];  
    $ReportQuotation->Transaction          = 'Request Quotation by:' . $AccountNo . ". with RequestNo: " . $request['CustAcctNo'] . ". Identification: " . $request['PlateNumber'] . ". Date /Time:" . $CurrentDate ; 
    $ReportQuotation->TransactionDate      = $CurrentDate ;
    $ReportQuotation->Status               = 1 ;
    $ReportQuotation->Active               = 1;
    $ReportQuotation->save();


          /*$CountSurcharges = RequestSurcharge::count() + 1;
              
          $RequestSurcharge = new RequestSurcharge;
            $RequestSurcharge->SurchargeNo             = $CountSurcharges;
            $RequestSurcharge->RequestNo               = $AccountNo;
            $RequestSurcharge->SurchargeName           = $AccountNo;
            $RequestSurcharge->SurchargeAmount         = $AccountNo;
            $RequestSurcharge->SurchargePremium        = $AccountNo;
            $RequestSurcharge->Active                   ='1';*/
    

 


      
    }


    public function GetSubLines( $id)
    {
        //$id = "PC";
       // return PerilsAmount::find($id);
       // return PerilsAmount::select('*')->where('Active', 1);

       return SubLinesCount::select('*')->where('SubLinesNO',trim($id))->paginate(10);
    }

    public function GetSubLinesTaripa( $id)
    {
       
       return ProductLinesPerilsTaripa::select('*')->where('_id',trim($id))->paginate(10);
    }

    public function GetPerilsList( $id)
    {
       
       return ProductLinesPerils::select('*')->where('LinesNo', trim($id))->paginate(10);
    }

    public function GetDenomination()
    {
       
       return ProductLinesSub::select('*')->where('Active', '1')->paginate(10);
    }
    public function GetSurcharge()
    {
       
       return ProductSurcharge::select('*')->where('Active', '1')->paginate(10);
    }

    

    public function GetPerilsTaripa($id)
    {
      $CoverageAmount = '100000';
       return ProductLinesPerilsTaripa::select('*')
              ->where('SubLinesNo', trim($id))
              ->where('CoverageAmount',$CoverageAmount)
             // ->orWhere('CoverageAmount',10000)
              //->orWhere('CoverageAmount',0)
              ->paginate(10);
    }

    public function GetPerilsTaripaByAmount($id)
    {
     
      $numpart = explode(";;", $id); 
       return ProductLinesPerilsTaripa::select('*')
              ->where('SubLinesNo', trim($numpart[0]))
              ->where('CoverageAmount',round($numpart[1]))
              ->where('PerilsNo', trim($numpart[2]))
              ->paginate(10);
    }

    public function GetPerilsCoverageAmount($id)
    {
    
       return ProductLinesPerilsTaripa::select('*')
              ->where('SubLinesNo', trim($id))
              //->orderBy('CoverageAmount','ASC')
              ->orderBy('CoverageAmount','ASC')
              ->groupBy('CoverageAmount')
              //->orWhere('CoverageAmount',0)
              ->paginate(30);
    }

    public function GetPerilsCoverageAmountByDefault($id)
    {
    
      $GetDenomination = RequestDetails::select('*')->where('RequestNo',trim($id))->first();
       return ProductLinesPerilsTaripa::select('*')
              ->where('SubLinesNo',$GetDenomination->Denomination)
              ->orderBy('CoverageAmount','ASC')
              ->groupBy('CoverageAmount')
              //->orWhere('CoverageAmount',0)
              ->paginate(30);
    }


    

    public function SelectByAmount($id)
    {
      $PassValue = explode(";;", trim($id)); 
       return ProductLinesPerilsTaripa::select('*')
            ->where('CoverageAmount',trim($PassValue[0]))
            ->where('PerilsNo',  trim($PassValue[1]))
             // ->where('CoverageAmount',$id)
              ->paginate(10);
    }
    
    

    public function RequestQuotation(Request $request)
    {
      $curYear          = date('Y'); 
      $Counter          = RequestDetails::count() + 1;
      $Request          = str_pad($Counter, 4, '0' , STR_PAD_LEFT);  
      $RequestNo        =  $curYear. "-".$Request;
      
 


      $RequestPersonlDetails = new RequestDetails;
            $RequestPersonlDetails->RequestNo     = $RequestNo;
            $RequestPersonlDetails->TINNo         = $request['platenumber'];
            $RequestPersonlDetails->First_Name    = ucfirst($request['firstname']);
            $RequestPersonlDetails->Middle_Name   = ucfirst($request['middlename']);
            $RequestPersonlDetails->Last_Name     = ucfirst($request['lastname']);
            $RequestPersonlDetails->Address       = $request['address'];
            $RequestPersonlDetails->Province      = $request['bodytype'];
            $RequestPersonlDetails->EmailAddress  = $request['email'];
            $RequestPersonlDetails->ContactNo     = $request['contactnumber'];
            $RequestPersonlDetails->Status        = 'Processing';
            $RequestPersonlDetails->Active        = 1;

            $RequestPersonlDetails->PlateNumber    = $request['platenumber'];
            $RequestPersonlDetails->Year           = $request['year'];
            $RequestPersonlDetails->Brand          = $request['brand'];
            $RequestPersonlDetails->Model          = $request['model'];
            $RequestPersonlDetails->BodyType       = $request['bodytype'];
            $RequestPersonlDetails->amountPO       = $request['amount'];
            $RequestPersonlDetails->Denomination   = $request['denomination'];            
            $RequestPersonlDetails->Mortgagee      = $request['platenumber'];
            $RequestPersonlDetails->Driver         = $request['platenumber'];
            $RequestPersonlDetails->Helper         = $request['platenumber'];
            $RequestPersonlDetails->Accessories    = $request['platenumber'];
            $RequestPersonlDetails->Surcharge      = $request['platenumber'];
    //$RequestPersonlDetails->save();


    }

    

   
    public function URLQueryRequest($id)
    {
      $ExplodeOption =  explode(";;", trim($id));  
      return RequestDetails::select('*')
                ->where('Active','1')
                ->where('RequestNo',trim($ExplodeOption[0]))
                ->paginate(10);
    }


    public function URLQueryRequestNew($id)
    {
      $ExplodeOption =  explode(";;", trim($id));  
      return RequestDetails::select('*')
                ->where('Active','1')
                ->where('RequestNo',$ExplodeOption[0])
                ->first();
    }

  
    public function URLQueryRequestModify($id)
    {
      //$id = "2020-0002" ;
      return RequestDetails::select('*')
                ->where('Active','1')
                ->where('RequestNo',trim($id))
                ->first();
    }

    public function URLQueryPerilsCoveragesPreview($id)
    {
      
      //$PerilsNameForDisplay     = 2;
        //for($k=0 ;$k < count($PerilsNameForDisplay)  ;$k++)
         // {    
            //$ExplodeOption =  explode(";;", trim($id));      
              return RequestCoverages::select('*')
                        ->where('Active','1')
                        ->where('RequestNo',$id)
                       // ->where('OptionNo',round($ExplodeOption[1]))
                       ->groupBy('OptionNo')
                      //->where('OptionNo',1)
                      //->where('OptionNo',2)
                        
                        ->paginate(100);
          //}
    }

   
    public function URLQueryPerilsCharges($id)
    {
      return RequestCharges::select('*')
                ->where('Active','1')
                ->where('RequestNo',trim($id))
                ->paginate(10);
    }

   
    



    public function GetAllFieldsRequest()
    {
      $keys = DB::collection('product_lines_sub_perils_taripa')->raw(function($collection)
      {
          $cursor = $collection->find();
          $array = iterator_to_array($cursor);
          $fields = array();
          foreach ($array as $k=>$v) {
              foreach ($v as $a=>$b) {
                $fields[] = $a;
            
              }
              
          }
        
         // $fields[2]
       //echo $fields[2];
        //return array_values(array_unique($fields));    
        //echo $fields[3];
        

      });
     
      //$tra = '2019-PC-0001';
     // return ProductLinesPerilsTaripa::select('*')->where('SubLinesNo', trim($tra))->paginate(10);

    }

    public function UpdateQuotation( Request $request)
    {
      $id = trim($request['RequestNoPass']); 

      ///Report / Logs ----------------
      date_default_timezone_set('Asia/Hong_Kong');
      $CurrentDate         = date('Y-m-d H:i:s');

      $RequestCoveragess    = RequestCoverages::select('*')->where('RequestNo',trim($id))->groupBy('OptionNo')->get();
      foreach($RequestCoveragess as $RequestCoveragesss)
         { 	
          
            $GetAllRequestCoveragess = RequestCoverages::select('*') 
                  ->where('RequestNo',$id)
                  ->where('OptionNo',$RequestCoveragesss->OptionNo)
                  ->where('Active','1')
                  ->orderBy('Sort','ASC')
                  ->get();
                $ListCoverages = array();
                $OldTotalPremium = 0 ;$OldTotalCharges = 0 ; $OldTotalAmount= 0 ;  $OldTotalAmountDue = 0 ; 
                   foreach($GetAllRequestCoveragess as $GetAllRequestCoverages)
                    { 
                         $OldTotalPremium += $GetAllRequestCoverages->CoveragesPremium;
                         $OldTotalAmount  += $GetAllRequestCoverages->CoveragesAmount;
                        $ListCoverages[] = [
                       
                        'CoveragesName'					          => $GetAllRequestCoverages->CoveragesName,
                        'PerilsName'					            => $GetAllRequestCoverages->PerilsName, 
                        'CoveragesAmount'					        => $GetAllRequestCoverages->CoveragesAmount,
                        'CoveragesPremium'					      => $GetAllRequestCoverages->CoveragesPremium, 
                        'RequestNo'					    		      => $GetAllRequestCoverages->RequestNo,   
                        'CoverageRates'					          => $GetAllRequestCoverages->CoverageRates, 
                        'AccountNo'					              => $GetAllRequestCoverages->AccountNo, 
                    
                      ] ;
                    
                   $RequestDetails = RequestDetails::select('*')->where('Active', '1')->where('RequestNo',$id )->first();
                    }

                     
                    $GetAllRequestCharges = RequestCharges::select('*')
                    ->where('Active','1')
                    ->where('RequestNo',trim($id))
                    ->where('OptionNo',$GetAllRequestCoverages->OptionNo)
                    ->orderBy('ChargesNo','ASC')
                    ->get();

                    $Charges = array();
                    
                    foreach($GetAllRequestCharges as $GetAllRequestChargess){
                      $OldTotalCharges += $GetAllRequestChargess->ChargesPremium;
                          $Charges[] = [
                            '_id'                   => $GetAllRequestChargess->_id,
                            'ChargesName'           => $GetAllRequestChargess->ChargesName,
                            'ChargesAmount'         => $GetAllRequestChargess->ChargesAmount,
                            'ChargesPremium'        => $GetAllRequestChargess->ChargesPremium,
                            'ChargesType'	        => $GetAllRequestChargess->ChargesType,
                            'ChargesNo'	            => $GetAllRequestChargess->ChargesNo,
                            'OptionNo'	            => $GetAllRequestChargess->OptionNo,
                            
                           
                          ];
							    }	
         
                       //$OldTotalAmountDue =  
                        $CoveragesCustDetails[] = [
                        
                          'OptionNo'					            => $GetAllRequestCoverages->OptionNo,  
                          'FirstName'					            => $RequestDetails->FirstName,
                          'MiddleName'					          => $RequestDetails->MiddleName, 
                          'LastName'					            => $RequestDetails->LastName,
                          'TINNumber'					            => $RequestDetails->TINNumber,
                          'PlateNumber'					          => $RequestDetails->PlateNumber,
                          'Denomination'					        => $RequestDetails->Denomination,
                          'RequestNo'					            => $RequestDetails->RequestNo,
                          'Status'					              => $RequestDetails->Status,
                          'RequestModify'					        => $RequestDetails->RequestModify,
                          'OldTotalPremium'               => $OldTotalPremium,
                          'OldTotalCharges'               => $OldTotalCharges,
                          'OldTotalAmount'                => $OldTotalAmount,
                          'OldTotalAmountDue'             => $OldTotalPremium +  $OldTotalCharges,
                          'OldCoverages' 		              => $ListCoverages,	
                          'OldChargers'				            => $Charges,
                        
                          
                          
                      ] ;
            }
      $ReportQuotation = new ReportQuotation;
      $ReportQuotation->Action               =  "Update"; 
      $ReportQuotation->TransaID             =  $id;   
      $ReportQuotation->AcctNo               =  $request['CustAcctNo'];  
      //$ReportQuotation->Transaction          = 'Add New Option: ' .  $optionNo  . ". Added by " . $request['CustAcctCName'] . ". Identification " . $request['PlateNumber'] . ". Date /Time:" . $CurrentDate ; 
     
     $ReportQuotation->OldRecord            = $CoveragesCustDetails ;
      $ReportQuotation->TransactionDate      = $CurrentDate ;
      $ReportQuotation->Status               = 1 ;
      $ReportQuotation->Active               = 1;
      $ReportQuotation->save();
//-----------------End Report------------------------------------------>	


     
         
          $totalPerilsName1         = $request['ToSAvedAmountRequest'];          
          $PerilsNameForDisplay     = $request['PerilsNameForDisplay'];

          for($k=0 ;$k < count($totalPerilsName1 )  ;$k++)
          {  
            $CoveragesNameID            =  trim($request['PerilsNameForDisplay'][$k]);
            $RequestCoveragess          = RequestCoverages::where('_id',$CoveragesNameID)->first(); 
         
                    $RequestCoveragess->CoveragesAmount    = $request['PerilsNameAmountForDisplay'][$k];
                    $RequestCoveragess->CoveragesPremium   = $request['ToSAvedAmountRequest'][$k];
					$RequestCoveragess->CoverageRates      = $request['CoveragesRateSave'][$k];
                    $RequestCoveragess->save();


          }
           //------------Charges------Charges-------Charges----->   
           $totalChargesName         = $request['ToSAvedAmountRequest'];          
           $ChargesForDisplay        = $request['TxtChargesNameID'];
               
                for($P=0 ;$P < count($ChargesForDisplay )  ;$P++)
                {   
                       
                        $ChargesQueryID                      =  trim($request['TxtChargesNameID'][$P]);
                       $RequestCharges                       = RequestCharges::where('_id',$ChargesQueryID)->first(); 
                       $RequestCharges->ChargesPremium       = $request['TxtChargesPremiumForDisplay'][$P];
                       $RequestCharges->save();
            
            
                }

//-----------------Coverages------------------------------------------>		

	     
          $CoveragesNameID1            = $request['PerilsNameForDisplay'];
          //$RequestNoOptionNo           = $request['RequestNoOptionNo'];
		  $RequestCoverageGrp    = RequestCoverages::select('*')->where('RequestNo',trim($id))->groupBy('OptionNo')->get();
        foreach($RequestCoverageGrp as $RequestCoverageGrps)
         { 	
          $TotalPremium = 0;  $TotalCoverages = 0; 
            $RequestCoveragesss   = RequestCoverages::where('RequestNo',$id)->where('OptionNo',$RequestCoverageGrps->OptionNo)->get();
           
              foreach($RequestCoveragesss as $RequestCoveragess1){ 
                    $TotalCoverages    += $RequestCoveragess1->CoveragesAmount;
                    $TotalPremium      += $RequestCoveragess1->CoveragesPremium;

            
                if ( $RequestCoveragess1->PerilsCode == 'AOG'  ){   
                  $WithAOGPremium     =  $RequestCoveragess1->CoveragesPremium;
                  $WithAOGCoverages   =  $RequestCoveragess1->CoveragesAmount;
                  $WithAOG = "YES";
                }else{
                  $WithAOGPremium     =  0.00;
                  $WithAOGCoverages   =  0.00;
                  $WithAOG = "NO";
                }         
             
             
                  $RequestCoveragess1->WithAOGPremium         = round($WithAOGPremium,2) ;
                  $RequestCoveragess1->WithAOGCoverages       = round($WithAOGCoverages,2)  ;
                  $RequestCoveragess1->WithAOG                = $WithAOG ;
                  $RequestCoveragess1->save(); 

		
              $RequestCoveragesUpdate1   = RequestCoverages::where('RequestNo',$id)->where('OptionNo',$RequestCoverageGrps->OptionNo)->get();

              
              foreach($RequestCoveragesUpdate1 as $RequestCoveragesUpdate){ 
                    
                  $RequestCoveragesAOG1    = RequestCoverages::where('RequestNo',$id)->where('OptionNo',$RequestCoverageGrps->OptionNo)->where('PerilsCode','AOG')->first();

                  if ( !empty($RequestCoveragesAOG1->PerilsCode)){
                      $NoAOGPremiumTotal      =      $TotalPremium       -  $RequestCoveragesAOG1->CoveragesPremium;
                      $NoAOGCoveragesTotal    =      $TotalCoverages     -  $RequestCoveragesAOG1->CoveragesAmount;
                  }else{
                      $NoAOGPremiumTotal       =      $TotalPremium  ;
                      $NoAOGCoveragesTotal     =      $TotalCoverages ;
                  }
                  
                  $RequestCoveragesUpdate->NoAOGPremiumTotal      = round($NoAOGPremiumTotal,2)  ; 
                  $RequestCoveragesUpdate->NoAOGCoveragesTotal    = round($NoAOGCoveragesTotal,2)  ;
                  $RequestCoveragesUpdate->TotalPremium           = round($TotalPremium,2)  ;
                  $RequestCoveragesUpdate->TotalCoverages         = round($TotalCoverages,2)  ;
                  $RequestCoveragesUpdate->save(); 
              }
              

              $RequestCoveragesOD    = RequestCoverages::where('RequestNo',$id)->where('OptionNo',$RequestCoverageGrps->OptionNo)->where('PerilsCode','OD')->first();
              $RequestCoveragesTF    = RequestCoverages::where('RequestNo',$id)->where('OptionNo',$RequestCoverageGrps->OptionNo)->where('PerilsCode','TF')->first();
              $CAmountODTF   = $RequestCoveragesOD->CoveragesAmount   +  $RequestCoveragesTF->CoveragesAmount;
              $PAmountODTF   = $RequestCoveragesOD->CoveragesPremium  +  $RequestCoveragesTF->CoveragesPremium; 
                
              $RequestCoveragesOD->CAmountODTF            = round($CAmountODTF,2)  ;
              $RequestCoveragesOD->PAmountODTF            = round($PAmountODTF,2)  ;
              $RequestCoveragesOD->save(); 

              $RequestCoveragesTF->CAmountODTF            =  round($CAmountODTF,2)  ;
              $RequestCoveragesTF->PAmountODTF            = round($PAmountODTF,2)  ;
              $RequestCoveragesTF->save(); 



                    //Deductable
                    $GetDenomination     = RequestDetails::where('RequestNo',$id)->first();
                    $GetDenominationExplode  =  explode('-' ,$GetDenomination->Denomination);

                    if (trim($GetDenomination->Denomination) === "2019-PC-0001" ) {
                      $FindDefaultDeductible     = DefaultData::where('DefaultDataNo','2019-DE-0004')->first(); //0.005

                      //$MinAmount  = $FindDefaultDeductible->MinAmount;
                      $PAmountODTF1  = $CAmountODTF;
                      }else if (trim($GetDenomination->Denomination) === "2019-PC-0002" ) {
                      $FindDefaultDeductible     = DefaultData::where('DefaultDataNo','2019-DE-0005')->first(); //0.01
                      $PAmountODTF1  = $CAmountODTF;
                      }else if (trim($GetDenominationExplode[1] ) === "CV"   ) {
                      $FindDefaultDeductible     = DefaultData::where('DefaultDataNo','2019-CV-0006')->first(); //0.01
                      $PAmountODTF1  = $CAmountODTF;
                      }else if (trim($GetDenominationExplode[1] ) === "MC"   ) {
                      $FindDefaultDeductible     = DefaultData::where('DefaultDataNo','2019-MC-0007')->first();
                      $PAmountODTF1  = 1;
                    }

                    if (trim($RequestCoveragesOD->PerilsCode) === "OD" || trim($RequestCoveragesTF->PerilsCode) === "TF") {
                   // if (   $GetDenomination->WithAOG !== "YES" ) {
                      $Deductable =  $PAmountODTF1  * $FindDefaultDeductible->Amount; 
                      if ($Deductable < $FindDefaultDeductible->MinAmount){  //less than the declare amount
                          $DeductableNew             =  $FindDefaultDeductible->MinAmount;
                      }else{
                          $DeductableNew =  $Deductable;
                      }
                    }else{
                        $DeductableNew =  $FindDefaultDeductible->MinAmount ;

                    } 

                    $CoveragesDeductible   = RequestCoverages::where('RequestNo',$id)->where('OptionNo',$RequestCoverageGrps->OptionNo)->get();
                    foreach($CoveragesDeductible as $CoveragesDeductibles){ 
                        $CoveragesDeductibles->Deductible           = round($DeductableNew , 2);
                        $CoveragesDeductibles->save(); 
                    }

        }  

    
	//-----------------Coverages------------------------------------------>		

				$RequestCoveragesAOG    = RequestCoverages::where('RequestNo',$id)->where('OptionNo',$RequestCoverageGrps->OptionNo)->where('PerilsCode','AOG')->first();
         
	      $FindProductLineCharge1  = ProductLinesCharges::select('*')->where('ProductLine','2019-MC-0001')->where('Active','1')->get();
      
              $CompCharges1=0;
              foreach($FindProductLineCharge1 as $FindProductLineChargess)
              { 
                  if ( trim($FindProductLineChargess->ChargesType) === 'Percent'){
                     
                        //-------Doc Stamp Comp-------------------->
                          if ( trim($FindProductLineChargess->ChargesNo) === '2019-DP-0001'){
                            $Newvalue = $FindProductLineChargess->ChargesAmount  * $RequestCoveragesAOG->NoAOGPremiumTotal;
                            $value =  round($Newvalue, 2);
                            $numpart = explode(".",$value); 
                                if(is_float($value)){
                                      if ($numpart[1] < 51){
                                      //    it's a decimal that is greater than zero
                                      $CompChargesAmount1   = $numpart[0]. '.'. 50;
                                        // echo "Less 50=== " . $NewValue;
                                      }else{
                                      // its not a decimal, or the decimal is zero
                                      $CompChargesAmount1   = $numpart[0] +  1;
                                      //echo "Greather 50=== " . $NewValue;
                                      }
                                }else{
                                  $CompChargesAmount1   = $value;
                                }
                        }else{
                          $CompChargesAmount1 =  $FindProductLineChargess->ChargesAmount * $RequestCoveragesAOG->NoAOGPremiumTotal ; 
                        }  
                      
      
                  }else{
                          $CompChargesAmount1 =  $FindProductLineChargess->ChargesAmount ;  
                  }
                
                  $CompCharges1 += $CompChargesAmount1; 
                  $UpdateCharges2    = RequestCharges::where('RequestNo',$id)->where('OptionNo',$RequestCoverageGrps->OptionNo)->where('ChargesNo',$FindProductLineChargess->ChargesNo)->get();
                  foreach($UpdateCharges2 as $UpdateCharges22){ 
                        $UpdateCharges22->ChargesPremiumAOG             = $CompChargesAmount1;
                        $UpdateCharges22->save();
                  
                }  
          }  
          
          $UpdateCharges2    = RequestCharges::where('RequestNo',$id)->where('OptionNo',$RequestCoverageGrps->OptionNo)->get();
          $TotalCharges = 0 ;
		  foreach($UpdateCharges2 as $UpdateCharges222){ 
		  $TotalCharges +=  $UpdateCharges222->ChargesPremium  ;
                $UpdateCharges222->TotalChargesAOG           = $CompCharges1;
                $UpdateCharges222->save();
          
			} 
		foreach($UpdateCharges2 as $UpdateCharges2220){ 
		 
                $UpdateCharges2220->TotalCharges           = $TotalCharges;
				$UpdateCharges2220->TotalAmountDue         = $TotalCharges + $TotalPremium ;
                $UpdateCharges2220->save();
          
			}  			
    } //close KK Loop     
		//------------Charges------Charges-------Charges----->     

                if ( $request['QuoteExpiryStatus'] === 2  ){
                  $QuoteExpiryStatus  = 0 ;
                  $QuoteExpiryRemarks = 'Re-quote';
                }else{
                  $QuoteExpiryStatus  = $request['QuoteExpiryStatus'] ;
                  $QuoteExpiryRemarks = ' ';
                }

               $RequestDetails      = RequestDetails::where('RequestNo',$id)->first(); 
			   
                $RequestDetails->FirstName              = $request['FirstName'];
                $RequestDetails->MiddleName             = $request['MiddleName'];
                $RequestDetails->LastName               = $request['LastName'];
                $RequestDetails->Address                = $request['Address'];
                $RequestDetails->Barangay               = $request['Barangay'];
                $RequestDetails->City               	   = $request['City'];
                $RequestDetails->TINNumber              = $request['TINNumber'];
                $RequestDetails->EmailAddress           = $request['EmailAddress'];
                $RequestDetails->ContactNumber          = $request['ContactNumber'];
                $RequestDetails->AmountDue              = 0.00;
                $RequestDetails->PremiumAmount          = 0.00;
                $RequestDetails->TotalCharges           = 0.00;
                        //$RequestDetails->MotorUsage             = 0.00;
                $RequestDetails->QuoteExpiryStatus      = $QuoteExpiryStatus;
                $RequestDetails->QuoteExpiryRemarks      = $QuoteExpiryRemarks;
                        
              $RequestDetails->save();

        
     
    }

    

   


    public function URLQueryPerilsCoverages($id)
    {

        $RequestCoverage      = RequestCoverages::where('RequestNo',trim($id))->get();

        foreach($RequestCoverage as $RequestCoverages)
        { 
         
                return RequestCoverages::select('*')
                        ->where('Active','1')
                        ->where('RequestNo', $RequestCoverages->RequestNo)
                        ->where('OptionNo',round($RequestCoverages->OptionNo))
                        ->paginate(100);
        }


        // $ExplodeOption =  explode(";;", trim($id));      
     // return RequestCoverages::select('*')
               // ->where('Active','1')
               // ->where('RequestNo',trim($id))
               // ->where('OptionNo',round($ExplodeOption[1]))
              // ->groupBy('OptionNo')
               //->where('OptionNo',1)
               //->where('OptionNo',2)
                
               // ->paginate(100);
   
    }

   // $PerilsNo       = $ArrayPerilsName[$k]; 
    //$ExplodePerilsNo = explode('-' ,$PerilsNo);
    public function URLQueryPerilsCoveragesPreviewNew($id)
    {         
                  $ExplodeOption  =  explode(";;", trim($id)); 
                                $ReturnData =  RequestCoverages::select('*')
                                          ->where('RequestNo', $ExplodeOption[0])
                                          ->where('OptionNo',round($ExplodeOption[1]))
                                          ->paginate(7);
                                      
                                      return $ReturnData;
    }
    public function GetProductLineCharges()
    {
          return ProductLinesCharges::select('*')
                  ->where('ProductLine','2019-MC-0001')
                  ->where('Active','1')
                  ->paginate(100);
    }


    public function  URLQueryPerilsCoveragesGroup($id, request $request)
    {
      
        $RequestCoverage          = RequestCoverages::select('*')->where('RequestNo',trim($id))->where('CoveragesPremium','!=',0)->groupBy('OptionNo')->orderBy("OptionNo",'ASC')->get();

       foreach($RequestCoverage as $RequestCoverages)
        { 
          //echo $RequestCoverages->RequestNo;      
           $GetAllRequestCoverages = RequestCoverages::select('*') 
                ->where('Active','1')
                ->where('RequestNo',trim($id))
                ->where('CoveragesPremium','!=',0)   
                ->where('PerilsCode','!=','TF')             
                ->where('OptionNo',$RequestCoverages->OptionNo)
                ->orderBy('Sort','ASC')
                ->get();
                $CoveragesTotalAmount = 0 ;  $CoveragesPremium  =0;
                $Coverages = array();
                    foreach($GetAllRequestCoverages as $GetAllRequestCoveragess){


                      if ( $GetAllRequestCoveragess->PerilsCode == 'OD'  ){
                        $ComputeCoveragesAmount = $GetAllRequestCoveragess->CoveragesAmount; //$GetAllRequestCoveragess->CAmountODTF ;
                        $CoveragesPremium       = $GetAllRequestCoveragess->PAmountODTF;
                    }else{
                        $ComputeCoveragesAmount  = $GetAllRequestCoveragess->CoveragesAmount;
                        $CoveragesPremium        = $GetAllRequestCoveragess->CoveragesPremium;
                    } 

                    if ( $GetAllRequestCoveragess->PerilsCode === 'AOG'  ){
                      $NoAOG                  = "YES";
                      $NoAOGCoverageAmount    = $ComputeCoveragesAmount;
                      $NoAOGCoveragePremium   = $CoveragesPremium;
                     
                  }else{
                       $NoAOG                 = "NO";
                       $NoAOGCoverageAmount    = $ComputeCoveragesAmount - $GetAllRequestCoveragess->CoveragesAmount;
                       $NoAOGCoveragePremium   = $CoveragesPremium  - $GetAllRequestCoveragess->CoveragesPremium;
                  } 

                    
                      
                      $CoveragesTotalAmount  += $GetAllRequestCoveragess->TotalPremiumAmount;

                          $Coverages[] = [
                            '_id'                   => $GetAllRequestCoveragess->_id,
                            'Status'                => $GetAllRequestCoveragess->Status,
                            'Active'                => $GetAllRequestCoveragess->Active,
                            'CoveragesName'         => $GetAllRequestCoveragess->CoveragesName,
                            //'CoveragesPremium'      => $GetAllRequestCoveragess->CoveragesPremium, 
                            'CoveragesPremium'      => $CoveragesPremium , 
                            'PremiumAmount'         => $GetAllRequestCoveragess->PremiumAmount,
                            'CoveragesAmount'       => $GetAllRequestCoveragess->CoveragesAmount,  //$ComputeCoveragesAmount 
                            //'TotalCoveragesPremium' => $GetAllRequestCoveragess->TotalPremiumAmount,
                            'OptionNo'	            => $GetAllRequestCoveragess->OptionNo,
                            'PerilsName'	          => $GetAllRequestCoveragess->PerilsName,
                            'PerilsCode'	          => $GetAllRequestCoveragess->PerilsCode,
                            'CoveragesTotalAmount'  => $CoveragesTotalAmount,
                            'ApproverRemarks'	      => $GetAllRequestCoveragess->ApproverRemarks,
                            'Approver'	            => $GetAllRequestCoveragess->Approver,
                            'ApproverName'	        => $GetAllRequestCoveragess->ApproverName,
                            'CoverageRates'	        => $GetAllRequestCoveragess->CoverageRates,
                            'ApproverRemarksDate'   => $GetAllRequestCoveragess->ApproverRemarksDate,
                            'ClientRemarksDate'     => $GetAllRequestCoveragess->ClientRemarksDate,
                            'ClientRemarks'         => $GetAllRequestCoveragess->ClientRemarks,  
                            'ApproverNameQuote'     => $GetAllRequestCoveragess->ApproverNameQuote, 
                            'NoAOG'                 => $NoAOG ,
                            'NoAOGCoverageAmount'   => $GetAllRequestCoveragess->NoAOGCoveragesTotal ,
                            'NoAOGCoveragePremium'  => $GetAllRequestCoveragess->NoAOGPremiumTotal, //$NoAOGCoveragePremium ,
                          ];
                        
              }	


              
              $GetAllRequestCharges = RequestCharges::select('*')
                ->where('Active','1')
                ->where('RequestNo',trim($id))
                ->where('OptionNo',$RequestCoverages->OptionNo)
                ->orderBy('ChargesNo','ASC')
                ->get();

                $Charges = array();
                    foreach($GetAllRequestCharges as $GetAllRequestChargess){
                        
                          $Charges[] = [
                            '_id'                   => $GetAllRequestChargess->_id,
                            'ChargesName'           => $GetAllRequestChargess->ChargesName,
                            'ChargesAmount'         => $GetAllRequestChargess->ChargesAmount,
                            'ChargesPremium'        => $GetAllRequestChargess->ChargesPremium,
                            'TotalCharges'	        => $GetAllRequestChargess->TotalCharges,
                            'ChargesType'	          => $GetAllRequestChargess->ChargesType,
                            'ChargesNo'	            => $GetAllRequestChargess->ChargesNo,
                            'OptionNo'	            => $GetAllRequestChargess->OptionNo,
                            'ChargesPremiumAOG'	    => $GetAllRequestChargess->ChargesPremiumAOG,
							
                            
                           
                          ];
							}	

              //$user = Auth::user();
              $Case[] = [
                         '_id'                            => $RequestCoverages->_id,
                        'OptionNo'					              => $RequestCoverages->OptionNo,
                        'RequestNo'					              => $GetAllRequestCoveragess->RequestNo, 
                        'CoverageRates'	        		      => $GetAllRequestCoveragess->CoverageRates,
                        'TotalCoverages'	        		    => $GetAllRequestCoveragess->TotalCoverages,
                        'TotalPremium'	        		      => $GetAllRequestCoveragess->TotalPremium,
                        'NoAOGCoveragesTotal'	            => $GetAllRequestCoveragess->NoAOGCoveragesTotal,
                        'NoAOGPremiumTotal'	        		  => $GetAllRequestCoveragess->NoAOGPremiumTotal,
                        'TotalCharges'	                  => $GetAllRequestChargess->TotalCharges,
                        'TotalAmountDue'	                => $GetAllRequestChargess->TotalAmountDue,
                        'TotalChargesAOG'	                => $GetAllRequestChargess->TotalChargesAOG,
                        'StatusCovetages'                 => $GetAllRequestCoveragess->Status,
                        'Deductible'                      => $GetAllRequestCoveragess->Deductible,
                        'ListCoverages' 		              => $Coverages,
                        'ListCharges' 		                => $Charges
                
                      ] ;						
          }
        return response()->json($Case);	
     
    }





   
    
    public function SubmitNewCoverages( Request $request)
    {
      $id                       = trim($request['RequestNoPass']);
      $PerilsNameForDisplay     = $request['PerilsNameForDisplayADD'];
     // $RequestCoverageORDER     = RequestCoverages::select('OptionNo')->orderBy("OptionNo",'desc')->first();
      $RequestCoverageORDER      = RequestCoverages::select('*')->where('RequestNo',trim($id))->groupBy('OptionNo')->orderBy("OptionNo",'DESC')->first();

      $RequestDetails               = RequestDetails::where('RequestNo',$id)->first(); 
          for($k=0 ;$k < count($PerilsNameForDisplay)  ;$k++)
          {   
             $CountCoverages = RequestCoverages::count() + 1;
            $RequestCoverageGetPremiumAmount      = RequestCoverages::select('*')->where('RequestNo',trim($id))->where('CoveragesName',$request['ToSAvedAmountRequestADD'][$k])->where('OptionNo',$RequestCoverageORDER->OptionNo)->first();  
            $ProductLinesPerils                   = ProductLinesPerils::where('PerilsNo',trim($request['ToSAvedAmountRequestADD'][$k]))->first();
			      $PerilsDescription                    = str_replace("4",$request['passengers'], trim($ProductLinesPerils->Description));
            $RequestCoverages = new RequestCoverages;
                    $RequestCoverages->CoveragesNo             = $CountCoverages;
                    $RequestCoverages->RequestNo               = $id;
                    $RequestCoverages->CoveragesName           = $request['ToSAvedAmountRequestADD'][$k];
                    $RequestCoverages->CoveragesAmount         = $request['PerilsNameAmountForDisplayADD'][$k];
                    $RequestCoverages->CoveragesPremium        = round($request['PerilsPremiumForDisplayADD'][$k], 2);
                    $RequestCoverages->OptionNo                = $RequestCoverageORDER->OptionNo + 1 ; 
                    $RequestCoverages->PremiumAmount           = $RequestCoverageGetPremiumAmount->PremiumAmount ;
                    $RequestCoverages->PerilsName              = $ProductLinesPerils->PerilsName ;
                    $RequestCoverages->PerilsCode              = $ProductLinesPerils->PerilsCode ; 
					          $RequestCoverages->Description             = $PerilsDescription ;					
                    $RequestCoverages->CoverageRates           = $request['RatePercent'];
                    $RequestCoverages->Status                  = 1 ;
                    $RequestCoverages->Active                  = '1' ;
                    $RequestCoverages->DenominationType        = $request['Denomination'];
                    $RequestCoverages->Section                 = $ProductLinesPerils->Section ;
                    $RequestCoverages->RequestModify           = $RequestDetails->RequestModify ;
                    $RequestCoverages->RequestModifyCoverages  = $RequestDetails->RequestModify ;
					          $RequestCoverages->TotalPremium            = $request['TxtPremiumAmountAdd'];
					//$RequestCoverages->TotalCoverages          = round($request['PerilsPremiumForDisplayADD'][$k] * 7,2) ;
                    
                    $RequestCoverages->save();
          }
		  
		  
		  
		  
         $PassChargesChargesNo     = $request['PassChargesChargesNo'];
         //$PassChargesChargesNo     = $FindProductLineCharges->ChargesAmount;
         // foreach($FindProductLineCharge as $FindProductLineCharges){
              //$ChargesAmountDist =     $FindProductLineCharges->ChargesAmount ; 
              $RequestRequestCharges      = RequestCharges::select('OptionNo','RequestNo','Active')->where('RequestNo',trim($id))->groupBy('OptionNo')->orderBy("OptionNo",'DESC')->first();

                    for($p=0 ;$p < count($PassChargesChargesNo)  ;$p++)
                    {    
                  
                      $FindProductLineCharge  = ProductLinesCharges::select('*')->where('ProductLine','2019-MC-0001')->where('ChargesNo',trim($request['PassChargesChargesNo'][$p]))->where('Active','1')->first();
 
                          $RequestCharges = new RequestCharges;
                          $RequestCharges->RequestNo                   = $id;
                          $RequestCharges->ChargesNo                   = $request['PassChargesChargesNo'][$p];
                          $RequestCharges->ChargesName                 = $request['PassChargesChargesName'][$p];
                          $RequestCharges->ChargesPremium              = $request['PassChargesChargesPremium'][$p];
                          $RequestCharges->OptionNo                    = $RequestRequestCharges->OptionNo + 1 ; 
                          $RequestCharges->ChargesAmount               = $FindProductLineCharge->ChargesAmount ; 
                          $RequestCharges->ChargesType                 = $FindProductLineCharge->ChargesType ; 
						              $RequestCharges->TotalCharges            	   =  $request['TotalChargesAdd'];
						              $RequestCharges->TotalAmountDue          		 =  $request['AmountDueAdd']; 
                          $RequestCharges->Active                      = '1' ;
                          $RequestCharges->save(); 
                  }
				  
				  
				  $OptionNumber = $RequestCoverageORDER->OptionNo + 1;
			
				  
	 $RequestCoverages   = RequestCoverages::where('RequestNo',trim($id))->where('OptionNo',$OptionNumber)->get();
                 
   
     $TotalPremium = 0;  $TotalCoverages = 0; 
    foreach($RequestCoverages as $RequestCoveragess){ 
              $TotalCoverages    += $RequestCoveragess->CoveragesAmount;
              $TotalPremium      += $RequestCoveragess->CoveragesPremium;

     
      if ( $RequestCoveragess->PerilsCode == 'AOG'  ){   
            $WithAOGPremium     =  $RequestCoveragess->CoveragesPremium;
            $WithAOGCoverages   =  $RequestCoveragess->CoveragesAmount;
            $WithAOG = "YES";
      }else{
            $WithAOGPremium     =  0.00;
            $WithAOGCoverages   =  0.00;
            $WithAOG = "NO";
      }         
             
            
              $RequestCoveragess->WithAOGPremium         = $WithAOGPremium ;
              $RequestCoveragess->WithAOGCoverages       = $WithAOGCoverages ;
              $RequestCoveragess->WithAOG                = $WithAOG ;
              $RequestCoveragess->save(); 

             
    }
    $RequestCoveragesUpdate1    = RequestCoverages::where('RequestNo',trim($id))->where('OptionNo',$OptionNumber)->get();
    foreach($RequestCoveragesUpdate1 as $RequestCoveragesUpdate){ 

          $RequestCoveragesAOG1    = RequestCoverages::where('RequestNo',trim($id))->where('OptionNo',$OptionNumber)->where('PerilsCode','AOG')->first();

          if ( !empty($RequestCoveragesAOG1->PerilsCode)){
             $NoAOGPremiumTotal     =      $TotalPremium       -  $RequestCoveragesAOG1->CoveragesPremium;
             $NoAOGCoveragesTotal   =      $TotalCoverages     -  $RequestCoveragesAOG1->CoveragesAmount;
          }else{
            $NoAOGPremiumTotal       =      $TotalPremium  ;
            $NoAOGCoveragesTotal     =      $TotalCoverages ;
          }
       
          $RequestCoveragesUpdate->NoAOGPremiumTotal      = $NoAOGPremiumTotal  ;
          $RequestCoveragesUpdate->NoAOGCoveragesTotal    = $NoAOGCoveragesTotal ;
          $RequestCoveragesUpdate->TotalPremium           = $TotalPremium ;
          $RequestCoveragesUpdate->TotalCoverages         = $TotalCoverages ;
          
          $RequestCoveragesUpdate->save(); 
    }

    $RequestCoveragesOD    = RequestCoverages::where('RequestNo',trim($id))->where('OptionNo',$OptionNumber)->where('PerilsCode','OD')->first();
    $RequestCoveragesTF    = RequestCoverages::where('RequestNo',trim($id))->where('OptionNo',$OptionNumber)->where('PerilsCode','TF')->first();
    $CAmountODTF   = $RequestCoveragesOD->CoveragesAmount +  $RequestCoveragesTF->CoveragesAmount;
    $PAmountODTF   = $RequestCoveragesOD->CoveragesPremium +  $RequestCoveragesTF->CoveragesPremium; 
      
    $RequestCoveragesOD->CAmountODTF            = $CAmountODTF ;
    $RequestCoveragesOD->PAmountODTF            = $PAmountODTF ;
    $RequestCoveragesOD->save(); 

    $RequestCoveragesTF->CAmountODTF            = $CAmountODTF ;
    $RequestCoveragesTF->PAmountODTF            = $PAmountODTF ;
    $RequestCoveragesTF->save(); 

        //Deductable
        $GetDenomination     = RequestDetails::where('RequestNo',$id)->first();
        $GetDenominationExplode  =  explode('-' ,$GetDenomination->Denomination);

        if (trim($GetDenomination->Denomination) === "2019-PC-0001" ) {
              $FindDefaultDeductible     = DefaultData::where('DefaultDataNo','2019-DE-0004')->first();
              //$MinAmount  = $FindDefaultDeductible->MinAmount;
              $PAmountODTF1  = $CAmountODTF;
          }else if (trim($GetDenomination->Denomination) === "2019-PC-0002" ) {
              $FindDefaultDeductible     = DefaultData::where('DefaultDataNo','2019-DE-0005')->first();
              $PAmountODTF1  = $CAmountODTF;
        }else if (trim($GetDenominationExplode[1] ) === "CV"   ) {
            $FindDefaultDeductible     = DefaultData::where('DefaultDataNo','2019-CV-0006')->first();
            $PAmountODTF1  = $CAmountODTF;
        }else if (trim($GetDenominationExplode[1] ) === "MC"   ) {
          $FindDefaultDeductible     = DefaultData::where('DefaultDataNo','2019-MC-0007')->first();
          $PAmountODTF1  = 1;
      }


          if (trim($RequestCoveragesOD->PerilsCode) === "OD" || trim($RequestCoveragesTF->PerilsCode) === "TF") {
                  $Deductable =  $PAmountODTF1  * $FindDefaultDeductible->Amount; 
                  if ($Deductable < $FindDefaultDeductible->MinAmount){  //less than the declare amount
                      $DeductableNew             =  $FindDefaultDeductible->MinAmount;
                  }else{
                      $DeductableNew =  $PAmountODTF1  * $FindDefaultDeductible->Amount;
                  }
          }else{
                $DeductableNew =  $FindDefaultDeductible->MinAmount;

        } 

        $CoveragesDeductible   = RequestCoverages::where('RequestNo',trim($id))->where('OptionNo',$OptionNumber)->get();
          foreach($CoveragesDeductible as $CoveragesDeductibles){ 
                    $CoveragesDeductibles->Deductible           = round($DeductableNew , 2);
                    $CoveragesDeductibles->save(); 
          }

	///-------------------------End Coverages----------------------
	$RequestCoveragesAOG    = RequestCoverages::where('RequestNo',trim($id))->where('OptionNo',$OptionNumber)->where('PerilsCode','AOG')->first();
         
	 $FindProductLineCharge1  = ProductLinesCharges::select('*')->where('ProductLine','2019-MC-0001')->where('Active','1')->get();
      
              $CompCharges1=0;
              foreach($FindProductLineCharge1 as $FindProductLineChargess)
              { 
                  if ( trim($FindProductLineChargess->ChargesType) === 'Percent'){
                     
                        //-------Doc Stamp Comp-------------------->
                          if ( trim($FindProductLineChargess->ChargesNo) === '2019-DP-0001'){
                            $Newvalue = $FindProductLineChargess->ChargesAmount  * $RequestCoveragesAOG->NoAOGPremiumTotal;
                            $value =  round($Newvalue, 2);
                            $numpart = explode(".",$value); 
                                if(is_float($value)){
                                      if ($numpart[1] < 51){
                                      //    it's a decimal that is greater than zero
                                      $CompChargesAmount1   = $numpart[0]. '.'. 50;
                                        // echo "Less 50=== " . $NewValue;
                                      }else{
                                      // its not a decimal, or the decimal is zero
                                      $CompChargesAmount1   = $numpart[0] +  1;
                                      //echo "Greather 50=== " . $NewValue;
                                      }
                                }else{
                                  $CompChargesAmount1   = $value;
                                }
                        }else{
                          $CompChargesAmount1 =  $FindProductLineChargess->ChargesAmount * $RequestCoveragesAOG->NoAOGPremiumTotal ; 
                        }  
                      
      
                  }else{
                          $CompChargesAmount1 =  $FindProductLineChargess->ChargesAmount ;  
                  }
                
                  $CompCharges1 += $CompChargesAmount1; 
                  $UpdateCharges2    = RequestCharges::where('RequestNo',trim($id))->where('OptionNo',$OptionNumber)->where('ChargesNo',$FindProductLineChargess->ChargesNo)->get();
                  foreach($UpdateCharges2 as $UpdateCharges22){ 
                        $UpdateCharges22->ChargesPremiumAOG             = $CompChargesAmount1;
                        //$UpdateCharges22->TotalChargesAOG               = $CountCharges;
                        $UpdateCharges22->save();
                  
                }  
          }  
          
          $UpdateCharges2    = RequestCharges::where('RequestNo',trim($id))->where('OptionNo',$OptionNumber)->get();
          foreach($UpdateCharges2 as $UpdateCharges22){ 
                //$UpdateCharges22->ChargesPremiumAOG             = $CompChargesAmount;
                $UpdateCharges22->TotalChargesAOG               = $CompCharges1;
                $UpdateCharges22->save();
          
        }  
       


        //Report ----Logs---
                   
                  date_default_timezone_set('Asia/Hong_Kong');
                  $CurrentDate              = date('Y-m-d H:i:s');
                  $ReportQuotation = new ReportQuotation;
                  $ReportQuotation->Action               =  "ADDNEW";   
                  $ReportQuotation->TransaID             =  $id;   
                  $ReportQuotation->AcctNo               =  $request['CustAcctNo'];  
                  $ReportQuotation->Transaction          = 'Add New Option: ' .  $OptionNumber  . ". Added by " . $request['CustAcctCName'] . ". Identification " . $request['PlateNumber'] . ". Date /Time:" . $CurrentDate ; 
                  $ReportQuotation->TransactionDate      = $CurrentDate ;
                  $ReportQuotation->Status               = 1 ;
                  $ReportQuotation->Active               = 1;
                  $ReportQuotation->save();


                 // return view('home');

                  

    }
   

    public function GetRequestQuotationAccepted()
    {
          return RequestDetails::select('*')->where('Active', '1')->where('Status', 'Accepted')->where('ForSignature',0)->paginate(15);
    }

    

    public function GetPerilsTaripaByAmountLoop( Request $request )
    {
     
              $id = $request['PostRequestNO'] ;//'2019-0002';  
              $SubLinesNo           =trim($request['Denomination']);
             
           
               //$RequestCoverage      = RequestCoverages::select('CoveragesName','PerilsName','PremiumAmount','CoveragesAmount','OptionNo','RequestNo','Active','Status')->where('RequestNo',$id)->get();

               $totalQueryCoveragesAmount  = $request['QueryCoveragesAmount'];   

               for($k=0 ;$k < count($totalQueryCoveragesAmount )  ;$k++)
               {    
                 // $RequestCoverage      = RequestCoverages::select('CoveragesName','PerilsName','PremiumAmount','CoveragesAmount','OptionNo','RequestNo','Active','Status')->where('RequestNo',$id)->first();
              /* } 
             foreach($RequestCoverage as $RequestCoverages)
               { 
               
                $QueryCoveragesAmount  = $RequestCoverages->CoveragesAmount;
              */
               
                  $ProductLinesPerilsTaripas = ProductLinesPerilsTaripa::select('*')
                        ->where('Active','1')
                        ->where('SubLinesNo', $SubLinesNo)
                        ->where('PerilsNo',$request['QueryCoveragesName'][$k]) 
                        ->where('CoverageAmount',round($request['QueryCoveragesAmount'][$k])) 
                     // ->where('CoverageAmount',$request['QueryCoveragesName'])
                        //->orderBy('OptionNo','ASC')
                        ->get();
                      
                         foreach($ProductLinesPerilsTaripas as $ProductLinesPerilsTaripa)
                          { 
                                  $GetLoopTaripa[] = [
                                  '_id'                           => $request['QueryCoveragesID'][$k], //$RequestCoverage->QueryCoveragesID,
                                  'TaripaNo'					            => $ProductLinesPerilsTaripa->TaripaNo,
                                  'PerilsNo'					            => $ProductLinesPerilsTaripa->PerilsNo,  
                                  'CoverageAmount'					      => $ProductLinesPerilsTaripa->CoverageAmount,
                                  'PremiumAmount'					        => $ProductLinesPerilsTaripa->PremiumAmount,
                                  //'CoveragesAmount'					      => $RequestCoverages->CoveragesAmount,

                                
                          
                                ] ;
                        }	
                      	
            }
            return response()->json($GetLoopTaripa);	
    }


    public function GetDefaultPerilsForADD($id)
    {
         
     $DefaultData     = DefaultData::select('DefaultDataNo','Amount')->where("DefaultDataNo",'2019-CT-0003')->first(); 
      return ProductLinesPerilsTaripa::select('*')
                  ->where('SubLinesNo',trim($id))
                  ->where('CoverageAmount',$DefaultData->Amount)                  
                  ->where('Active','1')
                  ->orderBy("Formula",'ASC')
                  
                  ->paginate(100);
    }

    public function UploadRecordTaripa()
    {
    
         return view('upload.upload-taripa');
         //$user_id = Auth::user()->user_fname;

         //$user = Auth::user();
         //dd(Auth::user());

    }

    public function SubmitUploadRecordTaripa()
    {
      $handle = fopen($_FILES['ClientsRecord']['tmp_name'], "r");
      while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            $TaripaNo	        = trim($data[0]); 
            $SubLinesNo	      = trim($data[1]); 
            $PerilsNo	        = trim($data[2]); 
            $CoverageAmount	  = trim($data[3]); 
            $PremiumAmount	  = trim($data[4]); 
            $Formula	        = trim($data[5]); 
            $Active	          = trim($data[6]); 
            $PerilsName	      = trim($data[7]); 

           
      
      $UploadTaripa = new ProductLinesPerilsTaripa;
         $UploadTaripa->TaripaNo            = $TaripaNo	;
         $UploadTaripa->SubLinesNo          = $SubLinesNo	;
         $UploadTaripa->PerilsNo            = $PerilsNo	;
         $UploadTaripa->CoverageAmount      =  round($CoverageAmount, 2) ;
         $UploadTaripa->PremiumAmount       =  round($PremiumAmount, 2) ; 
         $UploadTaripa->Formula             =  $Formula;
         $UploadTaripa->Active              =  $Active	;
         $UploadTaripa->PerilsName          =  $PerilsName	;



      $UploadTaripa->save();

    }

   
    }


    public function GetPeril()
    {
       
       return ProductLinesPerils::select('*')
              ->where('Active', '1')
              ->where('Checkbox', 'true')
             //->orderBy("Formula",'ASC')
              //->orderBy('Checked','ASC')
             // ->groupBy('Checked')
              ->paginate(10);
    }


   
 
  

 

  public function ApproverQuotation(Request $request)
  {
    
    date_default_timezone_set('Asia/Hong_Kong');
    $CurrentDate                   = date('Y-m-d H:i:s');
    $ExpiryDate                    = date('Y-m-d H:i:s', strtotime("+30 days"));
    $QuoteExpiryDate               = date('Y-m-d', strtotime("+30 days"));
    $QuoteExpiryTime               = date('H:i:s', strtotime("+30 days"));
    $AcceptData = explode(';;' ,trim($request['AcceptQuotationPassData']));
     $CompCoveragesPremium  = 0; $CompChargesPremium   = 0;
    $RequestCoverages                = RequestCoverages::where('OptionNo',round($AcceptData[0]))->where('RequestNo',$AcceptData[1])->get();
    foreach($RequestCoverages as $RequestCoveragess){ 
              $RequestCoveragess->Status                          = 3 ;  //Pass to Customer
              $RequestCoveragess->ApproverNameQuote             = $AcceptData[3] ;//$request['ListApprover'] ;
              $RequestCoveragess->ApproverAcctNoQuote           = $AcceptData[2] ;//$request['ListApprover'] ;
              $RequestCoveragess->ApproverRemarksDate           = $CurrentDate;//$request['ListApprover'] ;
              $RequestCoveragess->ApproverIDQuote               = $AcceptData[4] ;//$request['ListApprover'] ;
              $RequestCoveragess->ApproverRemarksQuote          = $AcceptData[5] ;//$request['ListApprover'] ;
              

              
              $RequestCoveragess->save(); 
              $CompCoveragesPremium += $RequestCoveragess->CoveragesPremium  ;
    }


    $RequestCharges                = RequestCharges::where('OptionNo',round($AcceptData[0]))->where('RequestNo',$AcceptData[1])->get();
    foreach($RequestCharges as $RequestChargess){ 
              $RequestChargess->Status        = 3 ;
              $RequestChargess->save(); 
              $CompChargesPremium += $RequestChargess->ChargesPremium  ;
    }

    $RequestRequestDetails               = RequestDetails::where('RequestNo',$AcceptData[1])->first();
    //foreach($RequestCharges as $RequestChargess){ 
              $RequestRequestDetails->PremiumAmount        = 0.00 ;
              $RequestRequestDetails->TotalCharges         = 0.00;
              $RequestRequestDetails->AmountDue            = 0.00 ;
              $RequestRequestDetails->QuoteExpiry          = $ExpiryDate;
              $RequestRequestDetails->QuoteExpiryDate      = $QuoteExpiryDate;
              $RequestRequestDetails->QuoteExpiryTime      = $QuoteExpiryTime;
              $RequestRequestDetails->QuoteExpiryStatus    = 1;
              $RequestRequestDetails->OktoAccept            = 1;             
              $RequestRequestDetails->QuoteExpiryRemarks   = ' ';
              $RequestRequestDetails->save(); 
           
    //}





  }


  public function  CustomerAcceptedCoverage($id, request $request)
  {
    
   // $PassData = explode(';;' ,trim($id));
    $GetOptionWithAOG    = RequestDetails::where('RequestNo',$id)->first();
   $AOG             = $GetOptionWithAOG->OptionWithAOG  ;
   $AcceptedOption  = $GetOptionWithAOG->AcceptedOption  ;
    $ProductLinesPerils      = RequestCoverages::select('*')->where('RequestNo', $id)->where('OptionNo',$AcceptedOption)->where('Active','1')->orderBy('Section','ASC')->groupBy('Section')->get();
  
    $RequestCoverage         = RequestCoverages::select('*')->where('RequestNo',$id)->where('OptionNo',$AcceptedOption)->where('Status',4)->where('CoveragesPremium','!=',0)->groupBy('OptionNo')->get();
     


    foreach($ProductLinesPerils as $ProductLinesPerilss)
    { 
     
     foreach($RequestCoverage as $RequestCoverages)
      { 
        //echo $RequestCoverages->RequestNo;  
        if  ( trim($AOG) === 'NO'){   ///OPtion WithOut AOG
          $not_perils = ['AOG','TF'];
         $GetAllRequestCoverages = RequestCoverages::select('*') 
            //->whereIn('PerilsCode','!=',['AOG','TF'])
              ->where('PerilsCode', '!=','TF')
           // ->orWhere('PerilsCode', '!=','TF')
              ->where('Active','1')
              ->where('Status',4)
              //->where('RequestModifyCoverages',0)
              //->where('RequestModify',0)
              ->Where('RequestNo',$id)
           
              ->where('CoveragesPremium','!=',0)  
             ->where('Section',$ProductLinesPerilss->Section)              
              ->where('OptionNo',$RequestCoverages->OptionNo)
              ->orderBy('Section','ASC')
              //->orderBy('Sort','ASC')
              ->get();
        }else{ ///OPtion With AOG
                $GetAllRequestCoverages = RequestCoverages::select('*') 
                ->where('Active','1')
                ->where('Status',4)
                //->where('RequestModifyCoverages',0)
                //->where('RequestModify',0)
                ->where('RequestNo',$id)
                ->where('PerilsCode','!=','TF')
                ->where('CoveragesPremium','!=',0)  
                ->where('Section',$ProductLinesPerilss->Section)              
                ->where('OptionNo',$RequestCoverages->OptionNo)
                ->orderBy('Section','ASC')
               // ->orderBy('Sort','ASC')
                ->get();
        }
              $CoveragesTotalAmount = 0 ;  $CoveragesPremium  =0;
              $Coverages = array();
              
                  foreach($GetAllRequestCoverages as $GetAllRequestCoveragess){
                   
                    $CoveragesTotalAmount  += $GetAllRequestCoveragess->TotalPremiumAmount;
                      if ( $GetAllRequestCoveragess->PerilsCode == 'OD'  ){
                          $ComputeCoveragesAmount = $GetAllRequestCoveragess->CAmountODTF ;
                          $CoveragesPremium       = $GetAllRequestCoveragess->PAmountODTF;
                       
                      }else{
                          $ComputeCoveragesAmount  = $GetAllRequestCoveragess->CoveragesAmount;
                          $CoveragesPremium        = $GetAllRequestCoveragess->CoveragesPremium;
                       
                      } 
                      
                    
                      
                      $Coverages[] = [
                        '_id'                   => $GetAllRequestCoveragess->_id,
                        'Status'                => $GetAllRequestCoveragess->Status,
                        'Active'                => $GetAllRequestCoveragess->Active,
                        //'CoveragesName'         => $CoveragesName,
                        'CoveragesPremium'      => $CoveragesPremium, //$GetAllRequestCoveragess->CoveragesPremium, 
                        'PremiumAmount'         => $GetAllRequestCoveragess->PremiumAmount,
                        'CoveragesAmount'       => $GetAllRequestCoveragess->CoveragesAmount,
                        //'TotalCoveragesPremium' => $GetAllRequestCoveragess->TotalPremiumAmount,
                        'OptionNo'	            => $GetAllRequestCoveragess->OptionNo,
                        'PerilsName'	          => $GetAllRequestCoveragess->PerilsName,
                        'CoveragesTotalAmount'  => $CoveragesTotalAmount,
                        'ApproverRemarks'	      => $GetAllRequestCoveragess->ApproverRemarksQuote,
                        'Approver'	            => $GetAllRequestCoveragess->Approver,
                        'ApproverName'	        => $GetAllRequestCoveragess->ApproverName,
                        'ClientRemarks'	        => $GetAllRequestCoveragess->ClientRemarks,
                        'CoverageRates'	        => $GetAllRequestCoveragess->CoverageRates,
                        'ApproverRemarksDate'   => $GetAllRequestCoveragess->ApproverRemarksDate,
                        'ClientRemarksDate'     => $GetAllRequestCoveragess->ClientRemarksDate,
                        'PerilsCode'            => $GetAllRequestCoveragess->PerilsCode,
                        'ComputeCoveagesAmount' =>  $ComputeCoveragesAmount, //$GetAllRequestCoveragess->CoveragesAmount, //$ComputeCoveragesAmount,
                        'Description'           => $GetAllRequestCoveragess->Description,
                        'CoverageSection'       => $GetAllRequestCoveragess->Section,
                        
                        
                      ];
                     
                      
            }	
            
            $GetAllRequestCharges = RequestCharges::select('*')
              ->where('Active','1')
              ->where('Status',4)
              ->where('RequestNo',$id)
              ->where('OptionNo',$RequestCoverages->OptionNo)
              ->orderBy('ChargesNo','ASC')
              ->get();

              $Charges = array();
                  foreach($GetAllRequestCharges as $GetAllRequestChargess){
                    if  ( trim($AOG) == 'NO'){   ///OPtion WithOut AOG   
                        $Charges[] = [
                          '_id'                   => $GetAllRequestChargess->_id,
                          'ChargesName'           => $GetAllRequestChargess->ChargesName,
                          'ChargesAmount'         => $GetAllRequestChargess->ChargesAmount,
                          'ChargesPremium'        => $GetAllRequestChargess->ChargesPremiumAOG,
                          'TotalCharges'	        => $GetAllRequestChargess->TotalChargesAOG,
                          'ChargesType'	          => $GetAllRequestChargess->ChargesType,
                          'ChargesNo'	            => $GetAllRequestChargess->ChargesNo,
                          'OptionNo'	            => $GetAllRequestChargess->OptionNo,
                          
                         
                        ];
                  }else{

                    $Charges[] = [
                      '_id'                   => $GetAllRequestChargess->_id,
                      'ChargesName'           => $GetAllRequestChargess->ChargesName,
                      'ChargesAmount'         => $GetAllRequestChargess->ChargesAmount,
                      'ChargesPremium'        => $GetAllRequestChargess->ChargesPremium,
                      'TotalCharges'	        => $GetAllRequestChargess->TotalCharges,
                      'ChargesType'	          => $GetAllRequestChargess->ChargesType,
                      'ChargesNo'	            => $GetAllRequestChargess->ChargesNo,
                      'OptionNo'	            => $GetAllRequestChargess->OptionNo,
                      
                     
                    ];

                  }
            }	


            $GetClause = RequestClauses::select('*')  
                      ->where('RequestNo',$id)
                      ->where('OptionNo',$RequestCoverages->OptionNo)
                      ->where('Active',1)
                      ->where('Status',1)
                      ->get();

            $ClausesWarranties = array();
                foreach($GetClause as $GetClauses){
                      $ClausesWarranties[] = [
                        '_id'                   => $GetClauses->_id,
                        'ClausesNo'             => $GetClauses->ClausesNo,
                        'ClausesName'           => $GetClauses->ClausesName,
                        'ClausesStatement'      => $GetClauses->ClausesStatement,
                        'Belong'                => $GetClauses->Belong,
                        'ClausesRequired'       => $GetClauses->ClausesRequired,
                      ];
          }	


          $GetAccessories = RequestAccessories::select('*')  
          ->where('RequestNo',$id)
          ->where('OptionNo',$RequestCoverages->OptionNo)
          ->where('Active',1)
          ->where('Status',1)
          ->get();

          $Accessories = array();
              foreach($GetAccessories as $GetAccessoriess){
                    $Accessories[] = [
                      '_id'                   => $GetAccessoriess->_id,
                      'Name'                  => $GetAccessoriess->Name,
                      'Amount'                => $GetAccessoriess->Amount,
                      
                    ];
          }	


        }
        
   

            //$user = Auth::user();
            $Case[] = [
                       '_id'                          => $RequestCoverages->_id,
                      'TowingLimit'                  => $GetAllRequestCoveragess->TowingLimit,
                      'TotalCoverages'               => $GetAllRequestCoveragess->TotalCoverages,
                       'Deductible'                   => $GetAllRequestCoveragess->Deductible,
                       'AuthRepairLimit'              => $GetAllRequestCoveragess->Deductible +  $GetAllRequestCoveragess->TowingLimit,
                       'Section'                      => $ProductLinesPerilss->Section,
                      'OptionNo'					            => $RequestCoverages->OptionNo,
                      'RequestNo'					            => $GetAllRequestCoveragess->RequestNo,  
                      'ListCoverages' 		            => $Coverages,
                      'ListCharges' 		              => $Charges,
                      'ClausesWarranties' 		        => $ClausesWarranties,
                      'Accessories' 		              => $Accessories,
              
                    ] ;						
        
      }
      return response()->json($Case);	
   
  }


//   public function  TryAccessAuth()
//   {
//     $user = User::first();
//     \Auth::login($user);
//     $auth_user = \Auth::user();
//     dd(auth()->user());
//     $first_name = $auth_user->user_fname;
//     $last_name = $auth_user->user_lname;

//     $auth = [
//       'first' => $first_name,
//       'last' => $last_name,
//     ];

//     return $auth;

// }



public function  ListCoveragesForApproval($id, request $request)
    {
      //$id = "2019-0001;;2019-0003";
      $AcceptData       =  explode(';;' ,trim($id));
      $AcctNO           =  $AcceptData[1]; // '2019-0002';
      //$AcceptData[1]    =  '2019-0001';
     // $AcceptData[0]    =  '2019-0001';
     $Status = [ 2, 3]; 
      $RequestCoverage      = RequestCoverages::select('*')->where('RequestNo',$AcceptData[0])->where('AccountNo',$AcceptData[1])->where('CoveragesPremium','!=',0)->groupBy('OptionNo')->orderBy("OptionNo",'ASC')->get();

       foreach($RequestCoverage as $RequestCoverages)
        { 
           
           $GetAllRequestCoverages = RequestCoverages::select('*') 
                ->where('Active','1')
                ->where('RequestNo',trim($AcceptData[0]))
                ->where('AccountNo',trim($AcceptData[1]))
                ->where('CoveragesPremium','!=',0) 
                ->where('PerilsCode','!=','TF')               
                ->where('OptionNo',$RequestCoverages->OptionNo)
               //->where('Status',2)    
                ->orderBy('Sort','ASC')
                ->get();
                $CoveragesTotalAmount = 0 ;
                $Coverages = array();
                    foreach($GetAllRequestCoverages as $GetAllRequestCoveragess){
                      
                      $CoveragesTotalAmount  += $GetAllRequestCoveragess->TotalPremiumAmount;

                      if ( $GetAllRequestCoveragess->PerilsCode == 'OD'  ){
                        $ComputeCoveragesAmount = $GetAllRequestCoveragess->CAmountODTF ;
                        $CoveragesPremium       = $GetAllRequestCoveragess->PAmountODTF;
                    }else{
                        $ComputeCoveragesAmount  = $GetAllRequestCoveragess->CoveragesAmount;
                        $CoveragesPremium        = $GetAllRequestCoveragess->CoveragesPremium;
                    } 


                          $Coverages[] = [
                            '_id'                   => $GetAllRequestCoveragess->_id,
                            'Status'                => $GetAllRequestCoveragess->Status,
                            'Active'                => $GetAllRequestCoveragess->Active,
                            'CoveragesName'         => $GetAllRequestCoveragess->CoveragesName,
                            'PerilsCode'         => $GetAllRequestCoveragess->PerilsCode,
                            'CoveragesPremium'      => $CoveragesPremium, 
                            'PremiumAmount'         => $GetAllRequestCoveragess->PremiumAmount,
                            'CoveragesAmount'       => $GetAllRequestCoveragess->CoveragesAmount, //$ComputeCoveragesAmount,
                            //'TotalCoveragesPremium' => $GetAllRequestCoveragess->TotalPremiumAmount,
                            'OptionNo'	            => $GetAllRequestCoveragess->OptionNo,
                            'PerilsName'	                            => $GetAllRequestCoveragess->PerilsName,
                            'CoveragesTotalAmount'                    => $CoveragesTotalAmount,
                            'AssignApproverRemarksQuote'	            => $GetAllRequestCoveragess->AssignApproverRemarksQuote,
                            'AssignApproverAcctNoQuote'	              => $GetAllRequestCoveragess->AssignApproverAcctNoQuote,
                            'AssignApproverNameQuote'	                => $GetAllRequestCoveragess->AssignApproverNameQuote,
                            'AssignApproverIDQuote'	                  => $GetAllRequestCoveragess->AssignApproverIDQuote,
                            'AssignApproverRemarksDate'	              => $GetAllRequestCoveragess->AssignApproverRemarksDate,
                          ];
                        
              }	
              
              $GetAllRequestCharges = RequestCharges::select('*')
                ->where('Active','1')
                ->where('RequestNo',trim($AcceptData[0]))
                ->where('OptionNo',$RequestCoverages->OptionNo)
                ->orderBy('ChargesNo','ASC')
                ->get();

                $Charges = array();
                    foreach($GetAllRequestCharges as $GetAllRequestChargess){
                        
                          $Charges[] = [
                            '_id'                   => $GetAllRequestChargess->_id,
                            'ChargesName'           => $GetAllRequestChargess->ChargesName,
                            'ChargesAmount'         => $GetAllRequestChargess->ChargesAmount,
                            'ChargesPremium'        => $GetAllRequestChargess->ChargesPremium,
                            'TotalCharges'	        => $GetAllRequestChargess->TotalCharges,
                            'ChargesType'	          => $GetAllRequestChargess->ChargesType,
                            'ChargesNo'	            => $GetAllRequestChargess->ChargesNo,
                            'OptionNo'	            => $GetAllRequestChargess->OptionNo,
							'ChargesPremiumAOG'	    => $GetAllRequestChargess->ChargesPremiumAOG,

                            
                           
                          ];
							}	

              //$user = Auth::user();
              $Case[] = [
                        '_id'                      => $RequestCoverages->_id,
                        'OptionNo'				      	  => $RequestCoverages->OptionNo,
                        'RequestNo'					        => $GetAllRequestCoveragess->RequestNo,  
                        'CoverageRates'	        	  => $GetAllRequestCoveragess->CoverageRates,
						            'TotalCoverages'	          => $GetAllRequestCoveragess->TotalCoverages,
						            'TotalPremium'	        	  => $GetAllRequestCoveragess->TotalPremium,
                        'NoAOGCoveragesTotal'	      => $GetAllRequestCoveragess->NoAOGCoveragesTotal,
                        'NoAOGPremiumTotal'	        => $GetAllRequestCoveragess->NoAOGPremiumTotal,
                        'TotalCharges'	            => $GetAllRequestChargess->TotalCharges,
                        'TotalAmountDue'	          => $GetAllRequestChargess->TotalAmountDue,
                        'TotalChargesAOG'	          => $GetAllRequestChargess->TotalChargesAOG,
                        'StatusCovetages'           => $GetAllRequestCoveragess->Status,
                        'Deductible'                => $GetAllRequestCoveragess->Deductible,
                        'ListCoverages' 		        => $Coverages,
                        'ListCharges' 		           => $Charges
                
                      ] ;						
          }
        return response()->json($Case);	
     
    }

    public function MktgApprovedQuotation(Request $request)
    {
      date_default_timezone_set('Asia/Hong_Kong');
    $CurrentDate              = date('Y-m-d H:i:s');
    $ExpiryDate               = date('Y-m-d H:i:s', strtotime("+30 days"));
    $QuoteExpiryDate          = date('Y-m-d', strtotime("+30 days"));
    $QuoteExpiryTime          = date('H:i:s', strtotime("+30 days"));

      $GetUserRole            = Userrole::where('RoleAlias','AQ')->first(); 
      $AcceptData             = explode(';;' ,trim($request['AcceptQuotationPassData']));
       $CompCoveragesPremium  = 0; $CompChargesPremium   = 0;
       $RequestCoverages      = RequestCoverages::where('OptionNo',round($AcceptData[0]))->where('RequestNo',$AcceptData[1])->get();
      foreach($RequestCoverages as $RequestCoveragess){ 
                $RequestCoveragess->Status                           = 3 ;   //Pass to Customer
                $RequestCoveragess->AccountNo                        = $GetUserRole->AccountNo  ;   //Pass to Customer
                $RequestCoveragess->AssignApproverRemarksDate        = $CurrentDate ;
                
                
                $RequestCoveragess->AssignApproverRemarksQuote        ='Auto Approved by the User'; //$request['RemarksApprover'];
                $RequestCoveragess->AssignApproverIDQuote             = $GetUserRole->_id   ;//$request['ListApprover'] ;
                $RequestCoveragess->AssignApproverNameQuote           = $GetUserRole->CName  ;//$request['ListApprover'] ;
				        $RequestCoveragess->InchargeName         			        = trim($AcceptData[3]); 
				        $RequestCoveragess->InchargeAcctNo       			        = trim($AcceptData[2]);
                $RequestCoveragess->save(); 
                $CompCoveragesPremium += $RequestCoveragess->CoveragesPremium  ;
      }
  
  
      $RequestCharges                = RequestCharges::where('OptionNo',round($AcceptData[0]))->where('RequestNo',$AcceptData[1])->get();
      foreach($RequestCharges as $RequestChargess){ 
                $RequestChargess->Status        = 3 ;
                $RequestChargess->save(); 
                $CompChargesPremium += $RequestChargess->ChargesPremium  ;
      }

      $RequestDetails                      = RequestDetails::where('RequestNo',trim($AcceptData[1]))->first();
      $RequestDetails->PremiumAmount        = 0 ;
      $RequestDetails->TotalCharges         = 0;
      $RequestDetails->AmountDue            = 0 ;
      $RequestDetails->OktoAccept          = 1 ;
      $RequestDetails->QuoteExpiry          = $ExpiryDate;
      $RequestDetails->QuoteExpiryDate      = $QuoteExpiryDate;
      $RequestDetails->QuoteExpiryTime      = $QuoteExpiryTime;
      $RequestDetails->QuoteExpiryStatus    = 1;
      $RequestDetails->QuoteExpiryRemarks   = ' ';
	    $RequestDetails->InchargeName         = trim($AcceptData[3]); 
      $RequestDetails->InchargeAcctNo       = trim($AcceptData[2]);
      $RequestDetails->save(); 

      

        //Report / Logs-------------------
        $ReportQuotation = new ReportQuotation;
        $ReportQuotation->Action               =  "SET";   
        $ReportQuotation->TransaID             =  $AcceptData[1];   
        $ReportQuotation->AcctNo               =  $GetUserRole->AccountNo;  
        $ReportQuotation->AcctName             =  $GetUserRole->CName ; 
        $ReportQuotation->Transaction          = 'System Set Auto Approver:' . $GetUserRole->CName . ". Assigned to: " . $GetUserRole->CName  .  ". Option #: " . $AcceptData[0] . ". Date /Time:" . $CurrentDate ; 
        $ReportQuotation->TransactionDate      = $CurrentDate ;
        $ReportQuotation->Status               = 1 ;
        $ReportQuotation->Active               = 1;
        $ReportQuotation->save();

  
    }


    
  


  public function ListApproverQuotation()
    {
	   
     $Userrole = Userrole::select('*')->where('RoleAlias', 'AQ')->where('active',1)->get();
          foreach($Userrole as $Userroles)
          { 
                  $GetApprover[] = [
                        '_id'					        => $Userroles->_id,
                        'AccountNo'					  => $Userroles->AccountNo,
                        'role_name'					  => $Userroles->role_name,
                        'role_number'					=> $Userroles->role_number,
                        'Limit'					      => $Userroles->Limit,
                        'acctTypeName'			  => $Userroles->acctTypeName,
                        'acctType'					  => $Userroles->acctType,
                        'RoleAlias'					  => $Userroles->RoleAlias,
                        'CName'					      => $Userroles->CName,


                    ] ;
          }

       return response()->json($GetApprover);	
  
  
    }


    public function GetListProposal()
    {
          
      //$id = "2019-0003";
          $RequestDetails = RequestDetails::select('*')->where('Status', 'Checking')->where('Active', '1')->get();
          foreach($RequestDetails as $RequestDetailss)
            { 
              $GetAllRequestCoverages = RequestCoverages::select('*') 
              ->where('Active','1')
              //->where('RequestNo',$RequestDetailss->RequestNo)
              ->where('CoveragesPremium','!=',0)                
              //->where('AccountNo',trim($id))
              //->where('Approver','!=',null)
              ->where('Status',41)
              ->orderBy('Sort','ASC')
              ->first();
                //foreach($GetAllRequestCoverages as $GetAllRequestCoveragess)
                  //{ 
                          $GetResultDetailsApprover[] = [
                        
                          'FirstName'					            => $RequestDetailss->FirstName,
                          'MiddleName'					          => $RequestDetailss->MiddleName, 
                          'LastName'					            => $RequestDetailss->LastName,
                          'TINNumber'					            => $RequestDetailss->TINNumber,
                          'PlateNumber'					          => $RequestDetailss->PlateNumber,
                          'Denomination'					        => $RequestDetailss->Denomination,
                          'RequestNo'					            => $RequestDetailss->RequestNo,
                          'Status'					              => $RequestDetailss->Status,
    
    
                          'OptionNo'					            => $GetAllRequestCoverages->OptionNo,  
                          'CoveragesName'					        => $GetAllRequestCoverages->CoveragesName,
                          'PerilsName'					          => $GetAllRequestCoverages->PerilsName, 
                          'CoveragesAmount'					      => $GetAllRequestCoverages->CoveragesAmount,
                          'CoveragesPremium'					    => $GetAllRequestCoverages->CoveragesPremium, 
                          'CoveragesPremium'					    => $GetAllRequestCoverages->CoveragesPremium,   
                          'Approver'					            => $GetAllRequestCoverages->Approver, 
                          'AccountNo'					            => $GetAllRequestCoverages->AccountNo, 
    
                        
                  
                        ] ;
               // }
            }	
          return response()->json($GetResultDetailsApprover);	
    
    }


  


  public function GetRequestQuotationCustomer($id)
    {
      
//$QueryData        = explode(';;' ,$id);
          //$QueryData        = 'test1@gmail.com';
          $RequestDetails   = RequestDetails::select('*')->where('Active', '1')->where('CustAcctNO',$id)->get();  
           
          foreach($RequestDetails as $RequestDetailss)
            { 
             // $GetAllRequestCoverages = RequestCoverages::select('*') 
              //->where('Active','1')
             //->where('RequestNo',$RequestDetailss->RequestNo)
            //  ->where('CoveragesPremium','!=',0) 
              //->where('AccountNo',trim($QueryData[0]))
              //->where('Approver','!=',null)
              //->where('Status',3)
              //->orderBy('Sort','ASC')
              //->first();
                //foreach($GetAllRequestCoverages as $GetAllRequestCoveragess)
                  //{ 
                          $GetResultDetailsApprover[] = [
                        
                          'FirstName'					            => $RequestDetailss->FirstName,
                          'MiddleName'					          => $RequestDetailss->MiddleName, 
                          'LastName'					            => $RequestDetailss->LastName,
                          'TINNumber'					            => $RequestDetailss->TINNumber,
                          'PlateNumber'					          => $RequestDetailss->PlateNumber,
                          'Denomination'					        => $RequestDetailss->Denomination,
                          'RequestNo'					            => $RequestDetailss->RequestNo,
                          'Status'					              => $RequestDetailss->Status,
                          'AmountDue'					            => $RequestDetailss->AmountDue,
                          'QuoteExpiry'					          => $RequestDetailss->QuoteExpiry,
                          'QuoteExpiryRemarks'					  => $RequestDetailss->QuoteExpiryRemarks,
                          //'CustMessage'					          => $RequestDetailss->CustMessage,
                          'RequestModify'					        => $RequestDetailss->RequestModify,
                          'AcceptedOption'					      => $RequestDetailss->AcceptedOption,
                          'PaymentMode'					          => $RequestDetailss->PaymentMode,
                          'OktoAccept'					          => $RequestDetailss->OktoAccept ,
    
    
                          // 'OptionNo'					            => $GetAllRequestCoverages->OptionNo,  
                          // 'CoveragesName'					        => $GetAllRequestCoverages->CoveragesName,
                          // 'PerilsName'					          => $GetAllRequestCoverages->PerilsName, 
                          // 'CoveragesAmount'					      => $GetAllRequestCoverages->CoveragesAmount,
                          // 'CoveragesPremium'					    => $GetAllRequestCoverages->CoveragesPremium, 
                          // 'CoveragesPremium'					    => $GetAllRequestCoverages->CoveragesPremium,   
                          // 'Approver'					            => $GetAllRequestCoverages->Approver, 
                          // 'AccountNo'					            => $GetAllRequestCoverages->AccountNo, 
                         
    
                        
                  
                        ] ;
               // }
            }	
          return response()->json($GetResultDetailsApprover);
          
          $this->DetectExpirationQuotation();
    
    }



    public function ListApproverQuotationUW($id)
    {
		 //return Userrole::select('*')->where('RoleAlias', 'AQ')->where('Limit', '>=',round($id))->where('active', '1')->paginate(15);
        $Userrole = Userrole::select('*')->where('RoleAlias', 'AP')->where('Limit', '>=',round($id))->where('active', '1')->get();
          foreach($Userrole as $Userroles)
          { 
                  $GetApprover[] = [
                        '_id'					        => $Userroles->_id,
                        'AccountNo'					  => $Userroles->AccountNo,
                        'role_name'					  => $Userroles->role_name,
                        'role_number'					=> $Userroles->role_number,
                        'Limit'					      => $Userroles->Limit,
                        'acctTypeName'			  => $Userroles->acctTypeName,
                        'acctType'					  => $Userroles->acctType,
                        'RoleAlias'					  => $Userroles->RoleAlias,
                        'CName'					      => $Userroles->CName,


                    ] ;
          }

       return response()->json($GetApprover);	
  
  
    }


    public function GetRequestProposalApprover($id)
    {
      
      //$id = "2019-0003";
          $RequestDetails = RequestDetails::select('*')->where('Status', 'Checking')->where('Active', '1')->get();
          foreach($RequestDetails as $RequestDetailss)
            { 
              $GetAllRequestCoverages = RequestCoverages::select('*') 
              ->where('Active','1')
              //->where('RequestNo',$RequestDetailss->RequestNo)
              ->where('CoveragesPremium','!=',0)                
              ->where('AssignRevieweeAcctNO',$id)
              ->where('Status',41)
              ->orderBy('Sort','ASC')
              ->first();
                //foreach($GetAllRequestCoverages as $GetAllRequestCoveragess)
                  //{ 
                          $GetResultDetailsApprover[] = [
                        
                          'FirstName'					            => $RequestDetailss->FirstName,
                          'MiddleName'					          => $RequestDetailss->MiddleName, 
                          'LastName'					            => $RequestDetailss->LastName,
                          'TINNumber'					            => $RequestDetailss->TINNumber,
                          'PlateNumber'					          => $RequestDetailss->PlateNumber,
                          'Denomination'					        => $RequestDetailss->Denomination,
                          'RequestNo'					            => $RequestDetailss->RequestNo,
                          'Status'					              => $RequestDetailss->Status,
    
    
                          'OptionNo'					            => $GetAllRequestCoverages->OptionNo,  
                          'CoveragesName'					        => $GetAllRequestCoverages->CoveragesName,
                          'PerilsName'					          => $GetAllRequestCoverages->PerilsName, 
                          'CoveragesAmount'					      => $GetAllRequestCoverages->CoveragesAmount,
                          'CoveragesPremium'					    => $GetAllRequestCoverages->CoveragesPremium, 
                          'CoveragesPremium'					    => $GetAllRequestCoverages->CoveragesPremium,   
                          'AssignRevieweeAcctNO'				  => $GetAllRequestCoverages->AssignRevieweeAcctNO, 
                          'AssignRevieweeCName'					  => $GetAllRequestCoverages->AssignRevieweeCName, 
    
                        
                  
                        ] ;
               // }
            }	
          return response()->json($GetResultDetailsApprover);	
    
    }



    public function SetApproverQuotation(Request $request)
    {
      
      date_default_timezone_set('Asia/Hong_Kong');
      $CurrentDate              = date('Y-m-d H:i:s');
      $ExpiryDate               = date('Y-m-d H:i:s', strtotime("+30 days"));
      $AcceptData               = explode(';;' ,trim($request['AcceptQuotationPassData']));
      //Report / Logs-------------------
      $ReportQuotation = new ReportQuotation;
      $ReportQuotation->Action               =  "SET";   
      $ReportQuotation->TransaID             =  $AcceptData[1];   
      $ReportQuotation->AcctNo               =  $AcceptData[6] ;  
      $ReportQuotation->AcctName             =  $AcceptData[7] ; 
      $ReportQuotation->Transaction          = 'Set Quotation Approver by:' . $AcceptData[7] . ". Assigned to: " . $AcceptData[4] .  ". Option #: " . $AcceptData[0] . ". Date /Time:" . $CurrentDate ; 
      $ReportQuotation->TransactionDate      = $CurrentDate ;
      $ReportQuotation->Status               = 1 ;
      $ReportQuotation->Active               = 1;
      $ReportQuotation->save();

  
     
       $CompCoveragesPremium  = 0; $CompChargesPremium   = 0;
      $RequestCoverages                = RequestCoverages::where('OptionNo',round($AcceptData[0]))->where('RequestNo',$AcceptData[1])->get();
      foreach($RequestCoverages as $RequestCoveragess){ 
                $RequestCoveragess->Status                            = 2 ;   //Approver Pass
                $RequestCoveragess->AssignApproverRemarksQuote        =$AcceptData[2]; //$request['RemarksApprover'];
                $RequestCoveragess->AssignApproverIDQuote             =$AcceptData[3] ;//$request['ListApprover'] ;
                $RequestCoveragess->AssignApproverNameQuote           =$AcceptData[4] ;//$request['ListApprover'] ;
                $RequestCoveragess->AccountNo                         =$AcceptData[5] ;//$request['ListApprover'] ;
                $RequestCoveragess->AssignApproverAcctNoQuote         =$AcceptData[5] ;//$request['ListApprover'] ;
                $RequestCoveragess->AssignApproverRemarksDate         =$CurrentDate ;
				        $RequestCoveragess->InchargeAcctNo                    =$AcceptData[6] ;
                $RequestCoveragess->InchargeName                      =$AcceptData[7] ;
                
                $RequestCoveragess->save(); 
                $CompCoveragesPremium += $RequestCoveragess->CoveragesPremium  ;
      }
  
  
      $RequestCharges                = RequestCharges::where('OptionNo',round($AcceptData[0]))->where('RequestNo',$AcceptData[1])->get();
      foreach($RequestCharges as $RequestChargess){ 
                $RequestChargess->Status        = 2 ;
                $RequestChargess->save(); 
                $CompChargesPremium += $RequestChargess->ChargesPremium  ;
      }

      $RequestDetails                      = RequestDetails::where('RequestNo',$AcceptData[1])->first();
      $RequestDetails->PremiumAmount       = 0.00;
      $RequestDetails->TotalCharges        = 0.00;
      $RequestDetails->AmountDue           = 0.00;
	    $RequestDetails->InchargeAcctNo      =$AcceptData[6] ;
      $RequestDetails->InchargeName        =$AcceptData[7] ;
      $RequestDetails->save(); 
  
    }



    public function  ListCoveragesForApprovalUW($id, request $request)
    {
      //$id = "2019-0001;;2019-0007";
      $AcceptData       =  explode(';;' ,trim($id));
      
      $RequestCoverage      = RequestCoverages::select('*')->where('RequestNo',$AcceptData[0])->where('AssignRevieweeAcctNO',$AcceptData[1])->where('Status',41)->where('CoveragesPremium','!=',0)->groupBy('OptionNo')->orderBy("OptionNo",'ASC')->get();

       foreach($RequestCoverage as $RequestCoverages)
        { 
           
           $GetAllRequestCoverages = RequestCoverages::select('*') 
                ->where('Active','1')
                ->where('RequestNo',trim($AcceptData[0]))
                ->where('AssignRevieweeAcctNO',trim($AcceptData[1]))
                ->where('CoveragesPremium','!=',0)                
                ->where('OptionNo',$RequestCoverages->OptionNo)
                ->where('Status',41)    
                ->orderBy('Sort','ASC')
                ->get();
                $CoveragesTotalAmount = 0 ;
                $Coverages = array();
                    foreach($GetAllRequestCoverages as $GetAllRequestCoveragess){
                      
                      $CoveragesTotalAmount  += $GetAllRequestCoveragess->TotalPremiumAmount;
                          $Coverages[] = [
                            '_id'                   => $GetAllRequestCoveragess->_id,
                            'Status'                => $GetAllRequestCoveragess->Status,
                            'Active'                => $GetAllRequestCoveragess->Active,
                            'CoveragesName'         => $GetAllRequestCoveragess->CoveragesName,
                            'CoveragesPremium'      => $GetAllRequestCoveragess->CoveragesPremium, 
                            'PremiumAmount'         => $GetAllRequestCoveragess->PremiumAmount,
                            'CoveragesAmount'       => $GetAllRequestCoveragess->CoveragesAmount,
                            //'TotalCoveragesPremium' => $GetAllRequestCoveragess->TotalPremiumAmount,
                            'OptionNo'	            => $GetAllRequestCoveragess->OptionNo,
                            'PerilsName'	          => $GetAllRequestCoveragess->PerilsName,
                            'CoveragesTotalAmount'  => $CoveragesTotalAmount,
                            'ApproverRemarks'	      => $GetAllRequestCoveragess->AssignRevieweeRemarks,
                            'ApproverRemarksDate'	  => $GetAllRequestCoveragess->AssignRevieweeDate,
                            'ApproverName'	        => $GetAllRequestCoveragess->ApproverName,
                            'ClientRemarks'	        => $GetAllRequestCoveragess->ClientRemarks,
                            'ClientRemarksDate'	   => $GetAllRequestCoveragess->ClientRemarksDate,
                            
                          ];
                        
              }	


             
              
              $GetAllRequestCharges = RequestCharges::select('_id','ChargesNo','ChargesType','ChargesNo','RequestNo','ChargesName','OptionNo','ChargesAmount','ChargesPremium','Active')
                ->where('Active','1')
                ->where('RequestNo',trim($AcceptData[0]))
                ->where('OptionNo',$RequestCoverages->OptionNo)
                ->orderBy('ChargesNo','ASC')
                ->get();

                $Charges = array();
                    foreach($GetAllRequestCharges as $GetAllRequestChargess){
                        
                          $Charges[] = [
                            '_id'                   => $GetAllRequestChargess->_id,
                            'ChargesName'           => $GetAllRequestChargess->ChargesName,
                            'ChargesAmount'         => $GetAllRequestChargess->ChargesAmount,
                            'ChargesPremium'        => $GetAllRequestChargess->ChargesPremium,
                            'TotalCharges'	        => $GetAllRequestChargess->TotalCharges,
                            'ChargesType'	          => $GetAllRequestChargess->ChargesType,
                            'ChargesNo'	            => $GetAllRequestChargess->ChargesNo,
                            'OptionNo'	            => $GetAllRequestChargess->OptionNo,
                            
                           
                          ];
							}	

              //$user = Auth::user();
              $Case[] = [
                         '_id'                          => $RequestCoverages->_id,
                        'OptionNo'					            => $RequestCoverages->OptionNo,
                        'RequestNo'					            => $GetAllRequestCoveragess->RequestNo,  
                        'ListCoverages' 		            => $Coverages,
                        'ListCharges' 		              => $Charges
                
                      ] ;						
          }
        return response()->json($Case);	
     
    }



    
  

    public function DetectExpirationQuotation()
    {
      date_default_timezone_set('Asia/Hong_Kong');
      $CurrentDate              = date('Y-m-d H:i:s');
      $RequestDetails         = RequestDetails::where('QuoteExpiryStatus',1)->where('QuoteExpiry','<=',$CurrentDate )->get();
      foreach($RequestDetails as $RequestDetailss){
        $RequestDetailss->QuoteExpiryStatus                = 2;
        $RequestDetailss->QuoteExpiryRemarks               = "Expired";
        $RequestDetailss->save(); 
        return  $RequestDetailss->QuoteExpiryRemarks ;
      }

      
  
    }


    public function GetRequestQuotation()
    {
        $this->DetectExpirationQuotation();
        return RequestDetails::select('*')->where('Active', '1')->where('Status', 'Processing')->paginate(100);
    }




    public function ComposeMessageCustomer(Request $request)
  {
    
    date_default_timezone_set('Asia/Hong_Kong');
    $CurrentDate              = date('Y-m-d H:i:s');

    $AcceptData = explode(';;' ,trim($request['AcceptQuotationPassData']));
    
              $RequestDetails                      = RequestDetails::where('RequestNo',$AcceptData[1])->first();
              $RequestDetails->CustMessage         = $AcceptData[2];
              $RequestDetails->CustMessageDate     = $CurrentDate;
              $RequestDetails->save(); 
  
  }


  public function PassForReviewedQuotation(Request $request)
    {
      date_default_timezone_set('Asia/Hong_Kong');
      $CurrentDate              = date('Y-m-d H:i:s');
      $AcceptData               = explode(';;' ,trim($request['AcceptQuotationPassData']));
       //$CompCoveragesPremium    = 0; 
       //$CompChargesPremium      = 0;
      $RequestCoverages         = RequestCoverages::where('OptionNo',round($AcceptData[0]))->where('RequestNo',$AcceptData[1])->get();
      foreach($RequestCoverages as $RequestCoveragess){ 
                $RequestCoveragess->Status                       = 41 ; //user accepted
                $RequestCoveragess->AssignRevieweeRemarks        = $AcceptData[2];
                $RequestCoveragess->AssignRevieweeDate           = $CurrentDate;
                $RequestCoveragess->AssignRevieweeCName          = $AcceptData[3];
                $RequestCoveragess->AssignRevieweeAcctNO         = $AcceptData[4];
                $RequestCoveragess->AssignRevieweeID             = $AcceptData[5];
  
                $RequestCoveragess->save(); 
                //$CompCoveragesPremium += $RequestCoveragess->CoveragesPremium  ;
      }
  
  
      $RequestCharges                = RequestCharges::where('OptionNo',round($AcceptData[0]))->where('RequestNo',$AcceptData[1])->get();
      foreach($RequestCharges as $RequestChargess){ 
                $RequestChargess->Status        = 41 ; //Reviewed  by the Under Writing
                $RequestChargess->save(); 
               // $CompChargesPremium += $RequestChargess->ChargesPremium  ;
      }
  
              $RequestDetails    = RequestDetails::where('RequestNo',$AcceptData[1])->first();
              $RequestDetails->Status                = "Checking";
              $RequestDetails->save(); 
    
    }



    public function ReviewedQuotation(Request $request)
  {
    date_default_timezone_set('Asia/Hong_Kong');
    $CurrentDate              = date('Y-m-d H:i:s');
    $AcceptData               = explode(';;' ,trim($request['AcceptQuotationPassData']));
  
    $RequestCoverages         = RequestCoverages::where('OptionNo',round($AcceptData[0]))->where('RequestNo',$AcceptData[1])->get();
    foreach($RequestCoverages as $RequestCoveragess){ 
              $RequestCoveragess->Status                       = 5 ; //user accepted
              $RequestCoveragess->RevieweeRemarks              = $AcceptData[2];
              $RequestCoveragess->RevieweeRemarksDate          = $CurrentDate;
              $RequestCoveragess->save(); 
           
    }


    $RequestCharges                = RequestCharges::where('OptionNo',round($AcceptData[0]))->where('RequestNo',$AcceptData[1])->get();
    foreach($RequestCharges as $RequestChargess){ 
              $RequestChargess->Status        = 5 ; //Reviewed  by the Under Writing
              $RequestChargess->save(); 
        
    }

              $RequestDetails    = RequestDetails::where('RequestNo',$AcceptData[1])->first();
              $RequestDetails->Status                = "Passed";
              $RequestDetails->save(); 
  
  }


  public function AutoReviewedQuotation(Request $request)
  {
    date_default_timezone_set('Asia/Hong_Kong');
    $CurrentDate              = date('Y-m-d H:i:s');
    $AcceptData               = explode(';;' ,trim($request['AcceptQuotationPassData']));
 
    $RequestCoverages         = RequestCoverages::where('OptionNo',round($AcceptData[0]))->where('RequestNo',$AcceptData[1])->get();
    foreach($RequestCoverages as $RequestCoveragess){ 
              $RequestCoveragess->Status                       = 5 ; //user accepted
              $RequestCoveragess->AssignRevieweeRemarks        = 'Auto Reviewed';
              $RequestCoveragess->AssignRevieweeDate           = $CurrentDate;
              $RequestCoveragess->AssignRevieweeCName          = $AcceptData[2];
              $RequestCoveragess->AssignRevieweeAcctNO         = $AcceptData[3];
              $RequestCoveragess->AssignRevieweeID             = $AcceptData[4];

              //$RequestCoveragess->save(); 
            
    }


    $RequestCharges                = RequestCharges::where('OptionNo',round($AcceptData[0]))->where('RequestNo',$AcceptData[1])->get();
    foreach($RequestCharges as $RequestChargess){ 
              $RequestChargess->Status        = 5 ; //Reviewed  by the Under Writing
              //$RequestChargess->save(); 
           
    }

            $RequestDetails    = RequestDetails::where('RequestNo',$AcceptData[1])->first();
            $RequestDetails->Status                = "Passed";
            //$RequestDetails->save(); 
  
  }


  public function AcceptQuotation(Request $request)
  {
    
    date_default_timezone_set('Asia/Hong_Kong');
    $CurrentDate              = date('Y-m-d H:i:s');

    $AcceptData = explode(';;' ,trim($request['AcceptQuotationPassData']));
    
    $RequestCoverages                = RequestCoverages::where('OptionNo',round($AcceptData[0]))->where('RequestNo',$AcceptData[1])->get();
   
    foreach($RequestCoverages as $RequestCoveragess){ 
           
              $RequestCoveragess->Status                 = 4 ; //user accepted
              $RequestCoveragess->ClientRemarks          = $AcceptData[2];
              $RequestCoveragess->ClientRemarksDate      = $CurrentDate ;
              $RequestCoveragess->save(); 
         
    }


    //UPLOAD IMAGE OR----CR-----------------
    if(!empty($request['UploadORCR']))
    {
      // $image = $request->get('image');
       $image =  $request['UploadORCR'];
       $name = $AcceptData[1] .'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1]; //time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
       \Image::make($request['UploadORCR'])->save(public_path('OR-CR/') . $name);
     }else{
      $name ="none";
     }

    $RequestCharges                = RequestCharges::where('OptionNo',round($AcceptData[0]))->where('RequestNo',$AcceptData[1])->get();
    foreach($RequestCharges as $RequestChargess){ 
              $RequestChargess->Status        = 4 ; //accepted by the customer
              $RequestChargess->save(); 
              //$CompChargesPremium += $RequestChargess->ChargesPremium  ;
    }

    $RequestCoveragesODTF                = RequestCoverages::where('OptionNo',round($AcceptData[0]))->where('RequestNo',$AcceptData[1])->where('PerilsCode','TF')->first();
    $RequestCoveragesAOG                 = RequestCoverages::where('OptionNo',round($AcceptData[0]))->where('RequestNo',$AcceptData[1])->where('PerilsCode','AOG')->first();
    //use to display on the policy
    if ( !empty($RequestCoveragesAOG->PerilsCode) &&  !empty($RequestCoveragesODTF->PerilsCode)){  ///with AOG and OD/TF   --ok
         
           if (trim($request['OptionWithAOG']) === "NO") {   //no AOG
            $TotalCoverages        = $RequestCoveragesODTF->NoAOGCoveragesTotal  ; 

          }else{      //yes AOG
            $TotalCoverages        = $RequestCoveragesODTF->TotalCoverages   ;

          }
        

    }else if ( !empty($RequestCoveragesAOG->PerilsCode) ){    //ok na to AOG only
            
          
            if (trim($request['OptionWithAOG']) === "NO") { 
              $TotalCoverages        = $RequestCoveragesAOG->NoAOGCoveragesTotal ; 

            }else{
              $TotalCoverages        = $RequestCoveragess->TotalCoverages   ;

            }
          
  
    }else if ( !empty($RequestCoveragesODTF->PerilsCode) ){  ///if OD/TF only
      //  $TotalCoverages        = $RequestCoveragess->NoAOGCoveragesTotal  - $RequestCoveragesODTF->CoveragesAmount ;
              if (trim($request['OptionWithAOG']) === "NO") {   //no AOG
                $TotalCoverages        = $RequestCoveragesODTF->NoAOGCoveragesTotal  ;   //same result

              }else{      //yes AOG
                $TotalCoverages        = $RequestCoveragesODTF->TotalCoverages   ; //same result

              }
  
  }else{

        $TotalCoverages        = $RequestCoveragess->TotalCoverages    ;
  }

  $CompChargesPremium    = $RequestChargess->TotalChargesAOG ;  //for Charges
    if (trim($request['OptionWithAOG']) === "NO") { 
          $CompCoveragesPremium  = $RequestCoveragess->NoAOGPremiumTotal ;
      if(!empty($RequestCoveragesAOG  )){
          $RequestCoveragesAOG->Active        = "0"; //update active to 0 if user select no AOG , need into dispay of AOG on Policy
          $RequestCoveragesAOG->save(); 
      }

    }else{
     // $TotalCoverages        = $RequestCoveragess->TotalCoverages - $RequestCoveragess->CoveragesAmount  ;
      $CompChargesPremium    = $RequestChargess->TotalCharges  ;
      $CompCoveragesPremium  = $RequestCoveragess->TotalPremium ;
      $RequestCoveragesAOG->Active        = "1"; //update active to 0 if user select no AOG
      $RequestCoveragesAOG->save(); 
      }
              $RequestDetails                      = RequestDetails::where('RequestNo',$AcceptData[1])->first();
              $RequestDetails->Status              = "Accepted";
              $RequestDetails->PremiumAmount       = $CompCoveragesPremium;
              $RequestDetails->TotalCoverages      = $TotalCoverages ;
              $RequestDetails->TotalCharges        = $CompChargesPremium;
              $RequestDetails->AmountDue           = $CompChargesPremium  + $CompCoveragesPremium;
              $RequestDetails->DiscountedAmountDue   = round($request['DiscountedAmount'],2);
              $RequestDetails->DiscountAmount        = round($request['DiscountDeduct'],2);
			        $RequestDetails->AOGAmountDue        = $CompChargesPremium  + $CompCoveragesPremium;
              $RequestDetails->AcceptedOption      = round($AcceptData[0]);
              $RequestDetails->MvFileNo            = $request['mvFileNo'];
              $RequestDetails->EngineNo            = $request['engineNo'];
              $RequestDetails->ChassisNo           = $request['chassisNo'];
              $RequestDetails->Mortgage            = $request['mortgage'];
              $RequestDetails->MortgageBankName    = $request['bankName'];
			        $RequestDetails->BodyColor           = $request['color'];
              $RequestDetails->MortgageBankAddress  = $request['bankNameAddress'];
              $RequestDetails->HardCopy           = $request['hardCopy'];
              $RequestDetails->NormalDelivery     = $request['delivery'];
              $RequestDetails->PaymentGateway     = $request['PaymentGateway'];
              $RequestDetails->DeliveryAddress    = $request['deliveryAddress'];
              // $RequestDetails->Address            = $request['address'];
              // $RequestDetails->Barangay           = $request['barangay'];
              // $RequestDetails->City               = $request['city'];
              $RequestDetails->AutoRenew          = $request['AutoRenew'];
              $RequestDetails->ForSignature       = 0;
              $RequestDetails->AcceptanceDate     = $CurrentDate ;
              $RequestDetails->OptionWithAOG      = $request['OptionWithAOG'];
              $RequestDetails->UploadedORCR       = $name;
              $RequestDetails->OktoAccept         = 2; //accepted
              $RequestDetails->PaymentGateway     = $request['PaymentMode'];
              $RequestDetails->TotalCommission    = round($request['TotalAmountComm'] - $request['DiscountDeduct'] ,2);
              $RequestDetails->CommissionAmount   = round($request['TotalAmountComm'] - $request['DiscountDeduct'] ,2);
              $RequestDetails->save(); 
            
             
              $RequestDetails1                  = RequestDetails::where('RequestNo',$AcceptData[1])->first();
              if ($RequestDetails1->LateDaysNo > 0 ){  //condition if late days greather to 1
                    $ClausesWarranties         =  ClausesWarranties ::where('Active',1)->where('Belong','No Known')->get(); 
                    $GetRequestDetails         = RequestDetails::where('RequestNo',$AcceptData[1])->first();
                    //$DateSave                  = $GetRequestDetails->MotorEffectiveDate;
                    $date= date_create($GetRequestDetails->MotorEffectiveDate);
                    $date1= date_create($CurrentDate);
                    //echo date_format($date,"F d, Y");
                    $DateSave                     = date_format($date,"F d, Y");
                    $DateSave1                    = date_format($date1,"F d, Y");
                    foreach($ClausesWarranties as $ClausesWarrantiess){ 
                      $ClausesStatementNoKNow     = str_replace("July 1, 2019",$DateSave, trim($ClausesWarrantiess->Statement));
                      $ClausesStatementNoKNow1    = str_replace("September 9, 2019",$DateSave1, trim($ClausesStatementNoKNow));
                  
                        $RequestClauses = new RequestClauses;
                        $RequestClauses->RequestNo               = $AcceptData[1];
                        $RequestClauses->OptionNo                = round($AcceptData[0]);
                        $RequestClauses->Active                  = 1;
                        $RequestClauses->Status                  = 1;
                        $RequestClauses->ClausesRequired         = $ClausesWarrantiess->Required;
                        $RequestClauses->Belong                  = $ClausesWarrantiess->Belong;
                        $RequestClauses->ClausesNo               = $ClausesWarrantiess->Number;
                        $RequestClauses->ClausesName             = $ClausesWarrantiess->Name;
                        $RequestClauses->ClausesStatement        = $ClausesStatementNoKNow1;
                        $RequestClauses->save(); 
                      }    
            }



            ///-----Compute Commission---------------- PerilsCode
      //  if ($request['DiscountDeduct'] >=1){  //if user input >=1 record commission
          if ($request['TotalAmountComm'] >=1){  
        
         $CoveragesForComm     = RequestCoverages::where('OptionNo',round($AcceptData[0]))->where('RequestNo',$AcceptData[1])->where('PerilsCode','!=','TF')->get();
          
        // $CoveragesForComm     = RequestCoverages::where('OptionNo',round(1) )->where('RequestNo','2020-0001')->where('PerilsCode','!=','TF')->get();
       // return response()->json(['success' =>    $CoveragesForComm ], 200);  
        
           
            foreach($CoveragesForComm as $CoveragesForComms){ 
                $AgentComs        = AgentCom::where('AccountNo',$RequestDetails1->CustAcctNO)->where('PerilsCode',$CoveragesForComms->PerilsCode)->where('Class',$CoveragesForComms->DenominationType)->first();
               // return response()->json(['success' =>    $AgentComs ], 200);  
                      $AgentComReport = new AgentComReport;
                      $AgentComReport->AccountNo            = $RequestDetails1->CustAcctNO;
                      $AgentComReport->ClassName            = $AgentComs->ClassName ;
                      $AgentComReport->PerilsName           = $AgentComs->PerilsName ;
                      $AgentComReport->PerilsNo             = $AgentComs->PerilsNo ;
                      $AgentComReport->PerilsCode           = $AgentComs->PerilsCode ;
                      $AgentComReport->AmountCom            = $AgentComs->AmountCom ;
                      $AgentComReport->RequestNo            = $AcceptData[1];
                      $AgentComReport->TotalAmountCom       = round($request['TotalAmountComm'] - $request['DiscountDeduct'] ,2);
                      $AgentComReport->TotalAmountMaxCom    = round($request['TotalAmountComm'],2);
                      $AgentComReport->status               = 1 ;
                      $AgentComReport->active               = 1;
                      $AgentComReport->save();
             
           }  

           //-------Update User Cash Out Discount
                $UsersDiscount   = User::where('AccountNo',$RequestDetails1->CustAcctNO)->first();
                $UsersDiscount->CashOutDiscount   = round($request['CashOutDiscount'] ,2);
                $UsersDiscount->save(); 
          }
                    $ClausesWarranties     =  ClausesWarranties ::where('Active',1)->where('Required','YES')->get(); 
                    foreach($ClausesWarranties as $ClausesWarrantiess){ 
                        $RequestClauses = new RequestClauses;
                        $RequestClauses->RequestNo               = $AcceptData[1];
                        $RequestClauses->OptionNo                = round($AcceptData[0]);
                        $RequestClauses->Active                  = 1;
                        $RequestClauses->Status                  = 1;
                        $RequestClauses->ClausesRequired         = $ClausesWarrantiess->Required;
                        $RequestClauses->Belong                  = $ClausesWarrantiess->Belong;
                        $RequestClauses->ClausesNo               = $ClausesWarrantiess->Number;
                        $RequestClauses->ClausesName             = $ClausesWarrantiess->Name;
                        $RequestClauses->ClausesStatement        = $ClausesWarrantiess->Statement;
                        $RequestClauses->save(); 
                    }


                    //$RequestCoveragesPA         = RequestCoverages::where('OptionNo',round($AcceptData[0]))->where('RequestNo',$AcceptData[1])->where('PerilsCode','PA')->where('Status',3)->get();
                    $RequestCoveragesPA         = RequestCoverages::where('OptionNo',round($AcceptData[0]))->where('RequestNo',$AcceptData[1])->where('PerilsCode','PA')->first();
                    if ( !empty($RequestCoveragesPA->PerilsCode)){   
                    $GetClausesWarranties     =  ClausesWarranties ::where('Active',1)->where('Belong',$RequestCoveragesPA->PerilsCode)->get(); 
                            foreach($GetClausesWarranties as $GetClausesWarrantiess){ 
                                  $RequestClauses = new RequestClauses;
                                  $RequestClauses->RequestNo               = $AcceptData[1];
                                  $RequestClauses->OptionNo                = round($AcceptData[0]);
                                  $RequestClauses->Active                  = 1;
                                  $RequestClauses->Status                  = 1;
                                  $RequestClauses->ClausesRequired         = $GetClausesWarrantiess->Required;
                                  $RequestClauses->Belong                  = $GetClausesWarrantiess->Belong;
                                  $RequestClauses->ClausesNo               = $GetClausesWarrantiess->Number;
                                  $RequestClauses->ClausesName             = $GetClausesWarrantiess->Name;
                                  $RequestClauses->ClausesStatement        = $GetClausesWarrantiess->Statement;
                                  $RequestClauses->save(); 
                            
                             }
                    }
                  


                    if ($request['mortgage'] != ''){
                             $GetClausesWarrantiesM     =  ClausesWarranties ::where('Active',1)->where('Belong','Bank')->first(); 
                             $BankDetails            = $request['bankName'] . ' - '. $request['bankNameAddress'] ;
                             $ClausesStatement        = str_replace("EAST West Bank- Paco Branch",$BankDetails, trim($GetClausesWarrantiesM->Statement));
                      
							              $RequestClauses = new RequestClauses;
                            $RequestClauses->RequestNo               = $AcceptData[1];
                            $RequestClauses->OptionNo                = round($AcceptData[0]);
                            $RequestClauses->Active                  = 1;
                            $RequestClauses->Status                  = 1;
                            $RequestClauses->ClausesRequired         = $GetClausesWarrantiesM->Required;
                            $RequestClauses->Belong                  = $GetClausesWarrantiesM->Belong;
                            $RequestClauses->ClausesNo               = $GetClausesWarrantiesM->Number;
                            $RequestClauses->ClausesName             = $GetClausesWarrantiesM->Name;
                            $RequestClauses->ClausesStatement        = $ClausesStatement;
                           $RequestClauses->save(); 
                            
                     }

                     if ($request['Accessories'] != ''){
                      $GetClausesWarrantiesM     =  ClausesWarranties ::where('Active',1)->where('Belong','Accessories')->first(); 
                        $RequestClauses = new RequestClauses;
                        $RequestClauses->RequestNo               = $AcceptData[1];
                        $RequestClauses->OptionNo                = round($AcceptData[0]);
                        $RequestClauses->Active                  = 1;
                        $RequestClauses->Status                  = 1;
                        $RequestClauses->ClausesRequired         = $GetClausesWarrantiesM->Required;
                        $RequestClauses->Belong                  = $GetClausesWarrantiesM->Belong;
                        $RequestClauses->ClausesNo               = $GetClausesWarrantiesM->Number;
                        $RequestClauses->ClausesName             = $GetClausesWarrantiesM->Name;
                        $RequestClauses->ClausesStatement        = $GetClausesWarrantiesM->Statement;
                        $RequestClauses->save(); 
                        
                 }


           ///--------------------------Accessories--------------------------
           $ExplodeDenomination  = explode('-' ,trim($RequestDetails->Denomination));
                 $Accessories         = Accessories::where('Active',1)->where('SubLinesNO',$ExplodeDenomination[1])->get();
                 foreach($Accessories as $Accessoriess){ 
                  $RequestCoverages     = RequestCoverages::where('OptionNo',round($AcceptData[0]))->where('RequestNo',$AcceptData[1])->where('PerilsCode','TF')->first();  
                  
                  if ( !empty($RequestCoverages->PerilsCode)){
                        $CoverageAmountTF = $RequestCoverages->CoveragesAmount ;
                  }else{
                         $CoverageAmountTF = 0.00;

                  }

                  $ComputeAmount  = ($CoverageAmountTF *  ($Accessoriess->Formula1 / $Accessoriess->ForType  )) * ($Accessoriess->Formula2 / $Accessoriess->ForType);
                  
                 $FloorComputeAmount =  floor($ComputeAmount / 100) * 100;

                 if ( $FloorComputeAmount >= $Accessoriess->Greater){
                       $SaveAmount =  $Accessoriess->Greater;
                 }else{
                         $SaveAmount =  $FloorComputeAmount ;
                 }
                  
                  $RequestAccessories = new RequestAccessories;
                         $RequestAccessories->RequestNo               = $AcceptData[1];
                         $RequestAccessories->OptionNo                = round($AcceptData[0]);
                         $RequestAccessories->Active                  = 1;
                         $RequestAccessories->Status                  = 1;
                         $RequestAccessories->CoverageAmount          = $CoverageAmountTF;
                         
                         $RequestAccessories->AcsID                   = $Accessoriess->_id;
                         $RequestAccessories->Number                  = $Accessoriess->Number;
                         $RequestAccessories->Name                    = $Accessoriess->Name;
                         $RequestAccessories->Formula                 = $Accessoriess->Formula;
                         $RequestAccessories->Greater                 = $Accessoriess->Greater;
                         $RequestAccessories->Amount                  =  $SaveAmount;
                         $RequestAccessories->save(); 
                         
                  }
              //Report / Logs-------------------
              $ReportQuotation = new ReportQuotation;
              $ReportQuotation->Action               =  "SET";   
              $ReportQuotation->TransaID             =  $AcceptData[1];   
              $ReportQuotation->AcctNo               =  $request['AcctNo'];
              $ReportQuotation->AcctName             =  $request['AcctName'];
              $ReportQuotation->Transaction          = 'Customer Accept Quotation :' . $AcceptData[1] .  ". with Option #: " . $AcceptData[0] .  ". under Customer Name: " . $request['AcctName'] . ". Date /Time:" . $CurrentDate ; 
              $ReportQuotation->TransactionDate      = $CurrentDate ;
              $ReportQuotation->Status               = 1 ;
              $ReportQuotation->Active               = 1;
            $ReportQuotation->save();
            
                   
  }


  public function GetListSection()
  {
    return ProductLinesPerils::select('*')->where('Active','1')->orderBy('Section','ASC')->groupBy('Section')->paginate(100);
  }




  public function ViewOptionCustApproved($id, request $request)
  {
    
    $PassData = explode(';;' ,trim($id));
      
    $RequestCoverage         = RequestCoverages::select('*')->where('RequestNo',trim($PassData[0]))->where('Status',4)->where('CoveragesPremium','!=',0)->groupBy('OptionNo')->get();
    //foreach($ProductLinesPerils as $ProductLinesPerilss)
   // { 
     foreach($RequestCoverage as $RequestCoverages)
      { 
        //echo $RequestCoverages->RequestNo;      
         $GetAllRequestCoverages = RequestCoverages::select('*') 
              ->where('Active','1')
              ->where('Status',4)
              ->where('RequestNo',trim($PassData[0]))
              //->where('PerilsCode','!=','TF')
              ->where('CoveragesPremium','!=',0)  
             // ->where('Section',$ProductLinesPerilss->Section)              
              ->where('OptionNo',$RequestCoverages->OptionNo)
              ->orderBy('Section','ASC')
              ->get();
              $CoveragesTotalAmount = 0 ;
              $Coverages = array();
        
                  foreach($GetAllRequestCoverages as $GetAllRequestCoveragess){
                   
                    $CoveragesTotalAmount  += $GetAllRequestCoveragess->TotalPremiumAmount;
                     
             
                      $Coverages[] = [
                        '_id'                   => $GetAllRequestCoveragess->_id,
                        'Status'                => $GetAllRequestCoveragess->Status,
                        'Active'                => $GetAllRequestCoveragess->Active,
                        //'CoveragesName'         => $CoveragesName,
                        'CoveragesPremium'      =>$GetAllRequestCoveragess->CoveragesPremium, 
                        'PremiumAmount'         => $GetAllRequestCoveragess->PremiumAmount,
                        'CoveragesAmount'       => $GetAllRequestCoveragess->CoveragesAmount,
                        //'TotalCoveragesPremium' => $GetAllRequestCoveragess->TotalPremiumAmount,
                        'OptionNo'	            => $GetAllRequestCoveragess->OptionNo,
                        'PerilsName'	          => $GetAllRequestCoveragess->PerilsName,
                        'CoveragesTotalAmount'  => $CoveragesTotalAmount,
                        'ApproverRemarks'	      => $GetAllRequestCoveragess->ApproverRemarksQuote,
                        'Approver'	            => $GetAllRequestCoveragess->Approver,
                        'ApproverName'	        => $GetAllRequestCoveragess->ApproverName,
                        'ClientRemarks'	        => $GetAllRequestCoveragess->ClientRemarks,
                        'CoverageRates'	        => $GetAllRequestCoveragess->CoverageRates,
                        'ApproverRemarksDate'   => $GetAllRequestCoveragess->ApproverRemarksDate,
                        'ClientRemarksDate'     => $GetAllRequestCoveragess->ClientRemarksDate,
                        'PerilsCode'            => $GetAllRequestCoveragess->PerilsCode,
                      //  'ComputeCoveagesAmount' => $ComputeCoveragesAmount,
                        
                        
                      ];
           
                      
            }	

            $GetAllRequestCharges = RequestCharges::select('*')
              ->where('Active','1')
              ->where('Status',4)
              ->where('RequestNo',trim($PassData[0]))
              ->where('OptionNo',$RequestCoverages->OptionNo)
              ->orderBy('ChargesNo','ASC')
              ->get();

              $Charges = array();
                  foreach($GetAllRequestCharges as $GetAllRequestChargess){
                      
                        $Charges[] = [
                          '_id'                   => $GetAllRequestChargess->_id,
                          'ChargesName'           => $GetAllRequestChargess->ChargesName,
                          'ChargesAmount'         => $GetAllRequestChargess->ChargesAmount,
                          'ChargesPremium'        => $GetAllRequestChargess->ChargesPremium,
                          'TotalCharges'	        => $GetAllRequestChargess->TotalCharges,
                          'ChargesType'	          => $GetAllRequestChargess->ChargesType,
                          'ChargesNo'	            => $GetAllRequestChargess->ChargesNo,
                          'OptionNo'	            => $GetAllRequestChargess->OptionNo,
                          
                         
                        ];
            }	


   

            //$user = Auth::user();
            $Case[] = [
                       '_id'                          => $RequestCoverages->_id,
                      // 'Section'                       => $ProductLinesPerilss->Section,
                      'OptionNo'					            => $RequestCoverages->OptionNo,
                      'RequestNo'					            => $GetAllRequestCoveragess->RequestNo,  
                      'ListCoverages' 		            => $Coverages,
                      'ListCharges' 		              => $Charges,
                      //'ClausesWarranties' 		        => $ClausesWarranties,
                     // 'Accessories' 		              => $Accessories,
              
                    ] ;						
        
      }
      return response()->json($Case);	
   
  }


  public function DeleteRequestClauses($id)
    {
        // Force Delete
        //$clause = RequestClauses::findOrFail($id);
       // $clause->forceDelete();
				//$RequestAccessories = new RequestAccessories;
			  $RequestClauses                  = RequestClauses::where('_id',trim($id))->get();
			 foreach($RequestClauses as $RequestClausess)
				{ 
					  $RequestClausess->Active          		 =0;
					  //$RequestClausess->ClausesStatement         = "2";
					  $RequestClausess->save(); 
					  return  $RequestClausess->Active    ;
				}
			  
			  
			
			  
    }
	
	
  
 public function  AddClausesWarrantiesToPolicy($id){
	 $AcceptData = explode(';;' ,trim($id));
       $ClausesWarranties         =  ClausesWarranties ::where('Active',1)->where('_id',trim($AcceptData[0]))->first(); 
       $GetRequestDetails         = RequestDetails::where('RequestNo',trim($AcceptData[1]))->first();
          
       if (strpos($ClausesWarranties->Statement, 'EAST West Bank- Paco Branch') !== false){
        $BankDetails            = $AcceptData[3] . ' - '. $AcceptData[4] ;
        $ClausesStatement       = str_replace("EAST West Bank- Paco Branch",$BankDetails, trim($ClausesWarranties->Statement));
       }elseif(strpos($ClausesWarranties->Statement, 'July 1, 2019') !== false){
             $date                      = date_create($GetRequestDetails->MotorEffectiveDate);
             $date1                     = date_create($GetRequestDetails->AcceptanceDate);

             $DateSave                  = date_format($date,"F d, Y");
             $DateSave1                 = date_format($date1,"F d, Y");

             $ClausesStatementNoKNow    = str_replace("July 1, 2019",$DateSave, trim($ClausesWarranties->Statement));
             $ClausesStatementNoKNow1   = str_replace("September 9, 2019",$DateSave1, trim($ClausesStatementNoKNow));

             $ClausesStatement       = $ClausesStatementNoKNow1;
      
       } else{
            $ClausesStatement       = $ClausesWarranties->Statement;

       }

     
                        $RequestClauses = new RequestClauses;
                        $RequestClauses->RequestNo               = $AcceptData[1];
                        $RequestClauses->OptionNo                = round($AcceptData[2]);
                        $RequestClauses->Active                  = 1;
                        $RequestClauses->Status                  = 1;
                        $RequestClauses->ClausesNo               = $ClausesWarranties->Number;
                        $RequestClauses->ClausesName             = $ClausesWarranties->Name;
                        $RequestClauses->ClausesStatement        =  $ClausesStatement;
                        $RequestClauses->save(); 
                   
 
 }
 
 

  
  
  public function GetListBanks()
  {

        $BankDetails = BankDetails::select('*') 
            ->where('Active',"1")
            ->orderBy('BankName','ASC')
            ->get();
      $ResultBankDetails = array();
        foreach($BankDetails as $BankDetailss)
      { 
            $ResultBankDetails[] = [
            '_id'	  	  	    => $BankDetailss->_id,
            'BankName'	  	  => $BankDetailss->BankName,
            'Address'	  	    => $BankDetailss->Address,
            'Remarks'	        => $BankDetailss->Remarks,
          ] ;
        
          
      }
    return response()->json($ResultBankDetails);	


  } 
  
   public function UpdateScheduleVehicle($id)
  {
          $PassData                               = explode(';;' ,trim($id));
          $RequestDetailss                        = RequestDetails::where('RequestNo',trim($PassData[0]))->first();
		      $RequestDetailss->PlateNumber          	 =$PassData[1];
          $RequestDetailss->ChassisNo          		 =$PassData[2];
          $RequestDetailss->EngineNo          		 =$PassData[3];
          $RequestDetailss->BodyColor          		 =$PassData[4];
          $RequestDetailss->MotorBrand          	 =$PassData[5];
          $RequestDetailss->MotorModel          	 =$PassData[6];
          $RequestDetailss->MotorBodyType          =$PassData[7];
          $RequestDetailss->save(); 
          return  $RequestDetailss->Active    ;
 
  }

  public function EditAmountPolicyMktg($id)
  {
      $PassData = explode(';;',$id);
        //   //$RequestCoverages   = RequestCoverages::where('RequestNo',$PassData[0])->where('OptionNo',round($PassData[3]))->get();
        //   $RequestCoverages   = RequestCoverages::where('RequestNo',$PassData[0])->get();
        //   foreach($RequestCoverages as $RequestCoveragess){
        //       $RequestCoveragess->RequestModify                  = 1;
        //       $RequestCoveragess->RequestModifyCoverages          = 1 ;
        //       $RequestCoveragess->RequestModifyPassByAcctNo      =trim($PassData[1]); 
        //       $RequestCoveragess->RequestModifyPassByName        =$PassData[2]; 
        //       $RequestCoveragess->RequestModifyRemarks           =$PassData[4];
        //       $RequestCoveragess->save(); 
           
        // }

        $RequestCoveragessUpdate    = RequestCoverages::where('RequestNo',$PassData[0])->where('OptionNo',round($PassData[3]))
				        ->update([
                    'RequestModify'               => 1,
                    'RequestModifyCoverages'      => 1, 
                    'RequestModifyPassByAcctNo'   => $PassData[1] , 
                    'RequestModifyPassByName'     =>  $PassData[2] ,  // Add as many as you need
                    'RequestModifyRemarks'        => $PassData[4] ,  
                ]);
		
		$RequestDetails   = RequestDetails::where('RequestNo',$PassData[0])->first();
              $RequestDetails->RequestModifyPassByAcctNo      =trim($PassData[1]); 
              $RequestDetails->RequestModifyPassByName        =$PassData[2];   
              $RequestDetails->RequestModify                  =1;
              $RequestDetails->RequestModifyRemarks           =$PassData[4];
              $RequestDetails->save(); 
         

  }
  
  
 
    
     public function  PolicyModificationAmount($id, request $request)
    {
     
        $RequestDetailss          = RequestDetails::select('*')->where('InchargeAcctNo',$id)->where('RequestModify',1)->get();

     foreach($RequestDetailss as $RequestDetails)
     { 
          //echo $RequestCoverages->RequestNo;      
           $GetAllRequestCoverages = RequestCoverages::select('*') 
                ->where('Active','1')
				        ->where('RequestModify',1)
                ->where('RequestNo',$RequestDetails->RequestNo)
                ->where('CoveragesPremium','!=',0)  
                ->orderBy('Sort','ASC')
                ->get();
                $CoveragesTotalAmount = 0 ;
                $Coverages = array();
                    foreach($GetAllRequestCoverages as $GetAllRequestCoveragess){
                      
                      $CoveragesTotalAmount  += $GetAllRequestCoveragess->TotalPremiumAmount;
                          $Coverages[] = [
                            '_id'                   => $GetAllRequestCoveragess->_id,
                            'Status'                => $GetAllRequestCoveragess->Status,
                            'Active'                => $GetAllRequestCoveragess->Active,
                            'CoveragesName'         => $GetAllRequestCoveragess->CoveragesName,
                            'CoveragesPremium'      => $GetAllRequestCoveragess->CoveragesPremium, 
                            'PremiumAmount'         => $GetAllRequestCoveragess->PremiumAmount,
                            'CoveragesAmount'       => $GetAllRequestCoveragess->CoveragesAmount,
                            //'TotalCoveragesPremium' => $GetAllRequestCoveragess->TotalPremiumAmount,
                            'OptionNo'	            => $GetAllRequestCoveragess->OptionNo,
                            'PerilsName'	          => $GetAllRequestCoveragess->PerilsName,
                            'CoveragesTotalAmount'  => $CoveragesTotalAmount,
                            'ApproverRemarks'	      => $GetAllRequestCoveragess->ApproverRemarks,
                            'Approver'	            => $GetAllRequestCoveragess->Approver,
                            'ApproverName'	        => $GetAllRequestCoveragess->ApproverName,
                            'CoverageRates'	        => $GetAllRequestCoveragess->CoverageRates,
                            'ApproverRemarksDate'   => $GetAllRequestCoveragess->ApproverRemarksDate,
                            'ClientRemarksDate'     => $GetAllRequestCoveragess->ClientRemarksDate,
                            'ClientRemarks'         => $GetAllRequestCoveragess->ClientRemarks,  
                            'ApproverNameQuote'     => $GetAllRequestCoveragess->ApproverNameQuote, 
                            //'CoverageRates'   		=> $GetAllRequestCoveragess->CoverageRates,   
                          ];
                        
               }	


              
              $GetAllRequestCharges = RequestCharges::select('*')
                ->where('Active','1')
                ->where('RequestNo',$RequestDetails->RequestNo)
                ->where('OptionNo',$GetAllRequestCoveragess->OptionNo)
                ->orderBy('ChargesNo','ASC')
                ->get();

                $Charges = array();
                    foreach($GetAllRequestCharges as $GetAllRequestChargess){
                        
                          $Charges[] = [
                            '_id'                   => $GetAllRequestChargess->_id,
                            'ChargesName'           => $GetAllRequestChargess->ChargesName,
                            'ChargesAmount'         => $GetAllRequestChargess->ChargesAmount,
                            'ChargesPremium'        => $GetAllRequestChargess->ChargesPremium,
                            'TotalCharges'	        => $GetAllRequestChargess->TotalCharges,
                            'ChargesType'	        => $GetAllRequestChargess->ChargesType,
                            'ChargesNo'	            => $GetAllRequestChargess->ChargesNo,
                            'OptionNo'	            => $GetAllRequestChargess->OptionNo,
                            
                           
                          ];
							}	
			}
            
              $Case[] = [
                        '_id'                             => $RequestDetails->_id,
						'RequestNo'                       => $RequestDetails->RequestNo,
						'Denomination'                    => $RequestDetails->Denomination,
						'FirstName'                       => $RequestDetails->FirstName,
						'MiddleName'                      => $RequestDetails->MiddleName,
						'LastName'                        => $RequestDetails->LastName,
						'PremiumAmount'                   => $RequestDetails->PremiumAmount,
						'AmountDue'                       => $RequestDetails->AmountDue,
						'Deductable'                      => $RequestDetails->Deductable,
						'QuoteExpiry'                     => $RequestDetails->QuoteExpiry,
						'Status'                      	  => $RequestDetails->Status,
						'RequestModifyRemarks'            => $RequestDetails->RequestModifyRemarks,
					    'PlateNumber'            		  => $RequestDetails->PlateNumber,
						
                        'ListCoverages' 		          => $Coverages,
                        'ListCharges' 		              => $Charges
                
                      ] ;						
         
        return response()->json($Case);	
     
    }




 public function  PolicyAmountForModification($id, request $request)
    {
      
        //$RequestCoverage          = RequestCoverages::select('*')->where('RequestNo',trim($id))->where('RequestModify',0)->where('Status',1)->where('RequestModifyCoverages',0)->where('CoveragesPremium','!=',0)->groupBy('OptionNo')->orderBy("OptionNo",'ASC')->get();
        $RequestCoverage          = RequestCoverages::select('*')->where('RequestNo',trim($id))->where('RequestModify',1)->where('RequestModifyCoverages',1)->where('CoveragesPremium','!=',0)->groupBy('OptionNo')->orderBy("OptionNo",'ASC')->get();
        //$Case = array();
       foreach($RequestCoverage as $RequestCoverages)
        { 
          //echo $RequestCoverages->RequestNo;      
           $GetAllRequestCoverages = RequestCoverages::select('*') 
                ->where('Active','1')
                ->where('RequestModify',1)
                ->where('RequestModifyCoverages',1)
                ->where('PerilsCode','!=','TF')  
				        ->where('RequestNo',trim($id))
                ->where('CoveragesPremium','!=',0)                
                ->where('OptionNo',$RequestCoverages->OptionNo)
                ->orderBy('Sort','ASC')
                ->get();
                $CoveragesTotalAmount = 0 ;  $CoveragesPremium  =0;
               
                $Coverages = array();
                    foreach($GetAllRequestCoverages as $GetAllRequestCoveragess){

                      if ( $GetAllRequestCoveragess->PerilsCode == 'OD'  ){
                        $ComputeCoveragesAmount = $GetAllRequestCoveragess->CAmountODTF ;
                        $CoveragesPremium       = $GetAllRequestCoveragess->PAmountODTF;
                    }else{
                        $ComputeCoveragesAmount  = $GetAllRequestCoveragess->CoveragesAmount;
                        $CoveragesPremium        = $GetAllRequestCoveragess->CoveragesPremium;
                    } 

                    if ( $GetAllRequestCoveragess->PerilsCode === 'AOG'  ){
                      $NoAOG                  = "YES";
                      $NoAOGCoverageAmount    = $ComputeCoveragesAmount;
                      $NoAOGCoveragePremium   = $CoveragesPremium;
                     
                  }else{
                       $NoAOG                 = "NO";
                       $NoAOGCoverageAmount    = $ComputeCoveragesAmount - $GetAllRequestCoveragess->CoveragesAmount;
                       $NoAOGCoveragePremium   = $CoveragesPremium  - $GetAllRequestCoveragess->CoveragesPremium;
                  } 
                      
                      $CoveragesTotalAmount  += $GetAllRequestCoveragess->TotalPremiumAmount;
                          $Coverages[] = [
                            '_id'                   => $GetAllRequestCoveragess->_id,
                            'Status'                => $GetAllRequestCoveragess->Status,
                            'Active'                => $GetAllRequestCoveragess->Active,
                            'CoveragesName'         => $GetAllRequestCoveragess->CoveragesName,
                            'CoveragesPremium'      => $CoveragesPremium, 
                            'PremiumAmount'         => $GetAllRequestCoveragess->PremiumAmount,
                            'CoveragesAmount'       => $GetAllRequestCoveragess->CoveragesAmount,
                            //'TotalCoveragesPremium' => $GetAllRequestCoveragess->TotalPremiumAmount,
                            'PerilsCode'	          => $GetAllRequestCoveragess->PerilsCode,
                            'OptionNo'	            => $GetAllRequestCoveragess->OptionNo,
                            'PerilsName'	          => $GetAllRequestCoveragess->PerilsName,
                            'CoveragesTotalAmount'  => $CoveragesTotalAmount,
                            'ApproverRemarks'	      => $GetAllRequestCoveragess->ApproverRemarks,
                            'Approver'	            => $GetAllRequestCoveragess->Approver,
                            'ApproverName'	        => $GetAllRequestCoveragess->ApproverName,
                            'CoverageRates'	        => $GetAllRequestCoveragess->CoverageRates,
                            'ApproverRemarksDate'   => $GetAllRequestCoveragess->ApproverRemarksDate,
                            'ClientRemarksDate'     => $GetAllRequestCoveragess->ClientRemarksDate,
                            'ClientRemarks'         => $GetAllRequestCoveragess->ClientRemarks,  
                            'ApproverNameQuote'     => $GetAllRequestCoveragess->ApproverNameQuote, 
                            //'RequestModify'   		=> $GetAllRequestCoveragess->CoverageRates,   
                            'NoAOG'                 => $NoAOG ,
                            'NoAOGCoverageAmount'   => $NoAOGCoverageAmount ,
                            'NoAOGCoveragePremium'  => $NoAOGCoveragePremium ,
                          ];
                        
              }	


              
              $GetAllRequestCharges = RequestCharges::select('*')
                ->where('Active','1')
                ->where('RequestNo',trim($id))
                ->where('OptionNo',$RequestCoverages->OptionNo)
                ->orderBy('ChargesNo','ASC')
                ->get();

                $Charges = array();
                    foreach($GetAllRequestCharges as $GetAllRequestChargess){
                        
                          $Charges[] = [
                            '_id'                   => $GetAllRequestChargess->_id,
                            'ChargesName'           => $GetAllRequestChargess->ChargesName,
                            'ChargesAmount'         => $GetAllRequestChargess->ChargesAmount,
                            'ChargesPremium'        => $GetAllRequestChargess->ChargesPremium,
                            'TotalCharges'	        => $GetAllRequestChargess->TotalCharges,
                            'ChargesType'	          => $GetAllRequestChargess->ChargesType,
                            'ChargesNo'	            => $GetAllRequestChargess->ChargesNo,
                            'OptionNo'	            => $GetAllRequestChargess->OptionNo,
                            'ChargesPremiumAOG'	    => $GetAllRequestChargess->ChargesPremiumAOG,
                            
                           
                          ];
							}	

              //$user = Auth::user();
              $Case[] = [
                         '_id'                            => $RequestCoverages->_id,
                        'OptionNo'					              => $RequestCoverages->OptionNo,
                        'RequestNo'					              => $GetAllRequestCoveragess->RequestNo, 
                        'CoverageRates'	        		      => $GetAllRequestCoveragess->CoverageRates,
                        
                        'TotalCoverages'	        		    => $GetAllRequestCoveragess->TotalCoverages,
                        'TotalPremium'	        		      => $GetAllRequestCoveragess->TotalPremium,
                        'NoAOGCoveragesTotal'	            => $GetAllRequestCoveragess->NoAOGCoveragesTotal,
                        'NoAOGPremiumTotal'	        		  => $GetAllRequestCoveragess->NoAOGPremiumTotal,
                        'TotalCharges'	                  => $GetAllRequestChargess->TotalCharges,
                        'TotalAmountDue'	                => $GetAllRequestChargess->TotalAmountDue,
                        'TotalChargesAOG'	                => $GetAllRequestChargess->TotalChargesAOG,
                        'StatusCovetages'                 => $GetAllRequestCoveragess->Status,
                        'Deductible'                      => $GetAllRequestCoveragess->Deductible,


                        'ListCoverages' 		          => $Coverages,
                        'ListCharges' 		              => $Charges
                
                      ] ;						
          }
        return response()->json($Case);	
     
    }

 public function  PolicyModificationEditBtn($id, request $request)
    {
      
        $RequestCoverage          = RequestCoverages::select('*')->where('RequestNo',trim($id))->where('CoveragesPremium','!=',0)->groupBy('OptionNo')->orderBy("OptionNo",'ASC')->get();

       foreach($RequestCoverage as $RequestCoverages)
        { 
          //echo $RequestCoverages->RequestNo;      
           $GetAllRequestCoverages = RequestCoverages::select('*') 
                ->where('Active','1')
                ->where('RequestNo',trim($id))
                ->where('CoveragesPremium','!=',0)                
                ->where('OptionNo',$RequestCoverages->OptionNo)
                ->orderBy('Sort','ASC')
                ->get();
                $CoveragesTotalAmount = 0 ;
                $Coverages = array();
                    foreach($GetAllRequestCoverages as $GetAllRequestCoveragess){
                      
                      $CoveragesTotalAmount  += $GetAllRequestCoveragess->TotalPremiumAmount;
                          $Coverages[] = [
                            '_id'                   => $GetAllRequestCoveragess->_id,
                            'Status'                => $GetAllRequestCoveragess->Status,
                            'Active'                => $GetAllRequestCoveragess->Active,
                            'CoveragesName'         => $GetAllRequestCoveragess->CoveragesName,
                            'CoveragesPremium'      => $GetAllRequestCoveragess->CoveragesPremium, 
                            'PremiumAmount'         => $GetAllRequestCoveragess->PremiumAmount,
                            'CoveragesAmount'       => $GetAllRequestCoveragess->CoveragesAmount,
                            //'TotalCoveragesPremium' => $GetAllRequestCoveragess->TotalPremiumAmount,
                            'OptionNo'	            => $GetAllRequestCoveragess->OptionNo,
                            'PerilsName'	          => $GetAllRequestCoveragess->PerilsName,
                            'CoveragesTotalAmount'  => $CoveragesTotalAmount,
                            'ApproverRemarks'	      => $GetAllRequestCoveragess->ApproverRemarks,
                            'Approver'	            => $GetAllRequestCoveragess->Approver,
                            'ApproverName'	        => $GetAllRequestCoveragess->ApproverName,
                            'CoverageRates'	        => $GetAllRequestCoveragess->CoverageRates,
                            'ApproverRemarksDate'   => $GetAllRequestCoveragess->ApproverRemarksDate,
                            'ClientRemarksDate'     => $GetAllRequestCoveragess->ClientRemarksDate,
                            'ClientRemarks'         => $GetAllRequestCoveragess->ClientRemarks,  
                            'ApproverNameQuote'     => $GetAllRequestCoveragess->ApproverNameQuote, 
                            'RequestModify'   		  => $GetAllRequestCoveragess->RequestModify,   
                          ];
                        
              }	


              
              $GetAllRequestCharges = RequestCharges::select('*')
                ->where('Active','1')
                ->where('RequestNo',trim($id))
                ->where('OptionNo',$RequestCoverages->OptionNo)
                ->orderBy('ChargesNo','ASC')
                ->get();

                $Charges = array();
                    foreach($GetAllRequestCharges as $GetAllRequestChargess){
                        
                          $Charges[] = [
                            '_id'                   => $GetAllRequestChargess->_id,
                            'ChargesName'           => $GetAllRequestChargess->ChargesName,
                            'ChargesAmount'         => $GetAllRequestChargess->ChargesAmount,
                            'ChargesPremium'        => $GetAllRequestChargess->ChargesPremium,
                            'TotalCharges'	        => $GetAllRequestChargess->TotalCharges,
                            'ChargesType'	          => $GetAllRequestChargess->ChargesType,
                            'ChargesNo'	            => $GetAllRequestChargess->ChargesNo,
                            'OptionNo'	            => $GetAllRequestChargess->OptionNo,
                            
                           
                          ];
							}	

              //$user = Auth::user();
              $Case[] = [
                         '_id'                            => $RequestCoverages->_id,
                        'OptionNo'					              => $RequestCoverages->OptionNo,
                        'RequestNo'					              => $GetAllRequestCoveragess->RequestNo, 
						            'CoverageRates'	        		      => $GetAllRequestCoveragess->CoverageRates,
                        'ListCoverages' 		              => $Coverages,
                        'ListCharges' 		                 => $Charges
                
                      ] ;						
          }
        return response()->json($Case);	
     
    }



    public function SubmitNewCoveragesModification( Request $request)
    {
      $id                       = trim($request['RequestNoPass']);
      $PerilsNameForDisplay     = $request['PerilsNameForDisplayADD'];
     // $RequestCoverageORDER     = RequestCoverages::select('OptionNo')->orderBy("OptionNo",'desc')->first();
      $RequestCoverageORDER      = RequestCoverages::select('*')->where('RequestNo',trim($id))->groupBy('OptionNo')->orderBy("OptionNo",'DESC')->first();
      $RequestDetails               = RequestDetails::where('RequestNo',$id)->first(); 
      $CountCoverages = RequestCoverages::count() + 1;
          for($k=0 ;$k < count($PerilsNameForDisplay)  ;$k++)
          {    
            $RequestCoverageGetPremiumAmount      = RequestCoverages::select('*')->where('RequestNo',trim($id))->where('CoveragesName',$request['ToSAvedAmountRequestADD'][$k])->where('OptionNo',$RequestCoverageORDER->OptionNo)->first();  
            $ProductLinesPerils                   = ProductLinesPerils::where('PerilsNo',trim($request['ToSAvedAmountRequestADD'][$k]))->first();
			$PerilsDescription    = str_replace("4",$request['passengers'], trim($ProductLinesPerils->Description));
            $RequestCoverages = new RequestCoverages;
                    $RequestCoverages->CoveragesNo             = $CountCoverages;
                    $RequestCoverages->RequestNo               = $id;
                    $RequestCoverages->CoveragesName           = $request['ToSAvedAmountRequestADD'][$k];
                    $RequestCoverages->CoveragesAmount         = $request['PerilsNameAmountForDisplayADD'][$k];
                    $RequestCoverages->CoveragesPremium        = round($request['PerilsPremiumForDisplayADD'][$k], 2);
                    $RequestCoverages->OptionNo                = $RequestCoverageORDER->OptionNo + 1 ; 
                    $RequestCoverages->PremiumAmount           = $RequestCoverageGetPremiumAmount->PremiumAmount ;
                    $RequestCoverages->PerilsName              = $ProductLinesPerils->PerilsName ;
                    $RequestCoverages->PerilsCode              = $ProductLinesPerils->PerilsCode ; 
					          $RequestCoverages->Description             = $PerilsDescription ;					
                    $RequestCoverages->CoverageRates           = $request['RatePercent'];
                    $RequestCoverages->Status                   = 1 ;
                    $RequestCoverages->Active                   = '1' ;
                    $RequestCoverages->DenominationType        = $request['Denomination'];
                    $RequestCoverages->Section                 = $ProductLinesPerils->Section ;
                    $RequestCoverages->RequestModify           = $RequestDetails->RequestModify ;
                    $RequestCoverages->RequestModifyCoverages  = $RequestDetails->RequestModify ;
                    $RequestCoverages->TotalPremium            = $request['TxtPremiumAmountAdd'];
                    
                    $RequestCoverages->save();
          }



          //---------------Update-Charges ----------------------------------------------------
         $PassChargesChargesNo     = $request['PassChargesChargesNo'];
        
              $RequestRequestCharges      = RequestCharges::select('OptionNo','RequestNo','Active')->where('RequestNo',trim($id))->groupBy('OptionNo')->orderBy("OptionNo",'DESC')->first();

                    for($p=0 ;$p < count($PassChargesChargesNo)  ;$p++)
                    {    
                  
                      $FindProductLineCharge  = ProductLinesCharges::select('*')->where('ProductLine','2019-MC-0001')->where('ChargesNo',trim($request['PassChargesChargesNo'][$p]))->where('Active','1')->first();
 
                          $RequestCharges = new RequestCharges;
                          $RequestCharges->RequestNo                   = $id;
                          $RequestCharges->ChargesNo                   = $request['PassChargesChargesNo'][$p];
                          $RequestCharges->ChargesName                 = $request['PassChargesChargesName'][$p];
                          $RequestCharges->ChargesPremium              = $request['PassChargesChargesPremium'][$p];
                          $RequestCharges->OptionNo                    = $RequestRequestCharges->OptionNo + 1 ; 
                          $RequestCharges->ChargesAmount               = $FindProductLineCharge->ChargesAmount ; 
                          $RequestCharges->ChargesType                 = $FindProductLineCharge->ChargesType ; 
                          $RequestCharges->TotalCharges            	   =  $request['TotalChargesAdd'];
						              $RequestCharges->TotalAmountDue          		 =  $request['AmountDueAdd']; 
                          $RequestCharges->Active                      = '1' ;
                          $RequestCharges->save(); 
                  }
            //---------------Update-Coverages ----------------------------------------------------

        $OptionNumber = $RequestCoverageORDER->OptionNo + 1;
                  

        $RequestCoverages   = RequestCoverages::where('RequestNo',trim($id))->where('OptionNo',$OptionNumber)->get();
                 
   
     $TotalPremium = 0;  $TotalCoverages = 0; 
    foreach($RequestCoverages as $RequestCoveragess){ 
              $TotalCoverages    += $RequestCoveragess->CoveragesAmount;
              $TotalPremium      += $RequestCoveragess->CoveragesPremium;

     
      if ( $RequestCoveragess->PerilsCode == 'AOG'  ){   
            $WithAOGPremium     =  $RequestCoveragess->CoveragesPremium;
            $WithAOGCoverages   =  $RequestCoveragess->CoveragesAmount;
            $WithAOG = "YES";
      }else{
            $WithAOGPremium     =  0.00;
            $WithAOGCoverages   =  0.00;
            $WithAOG = "NO";
      }         
             
            
              $RequestCoveragess->WithAOGPremium         = $WithAOGPremium ;
              $RequestCoveragess->WithAOGCoverages       = $WithAOGCoverages ;
              $RequestCoveragess->WithAOG                = $WithAOG ;
              $RequestCoveragess->save(); 

             
    }
    $RequestCoveragesUpdate1    = RequestCoverages::where('RequestNo',trim($id))->where('OptionNo',$OptionNumber)->get();
    foreach($RequestCoveragesUpdate1 as $RequestCoveragesUpdate){ 

          $RequestCoveragesAOG1    = RequestCoverages::where('RequestNo',trim($id))->where('OptionNo',$OptionNumber)->where('PerilsCode','AOG')->first();

          if ( !empty($RequestCoveragesAOG1->PerilsCode)){
             $NoAOGPremiumTotal     =      $TotalPremium       -  $RequestCoveragesAOG1->CoveragesPremium;
             $NoAOGCoveragesTotal   =      $TotalCoverages     -  $RequestCoveragesAOG1->CoveragesAmount;
          }else{
            $NoAOGPremiumTotal       =      $TotalPremium  ;
            $NoAOGCoveragesTotal     =      $TotalCoverages ;
          }
       
          $RequestCoveragesUpdate->NoAOGPremiumTotal      = $NoAOGPremiumTotal  ;
          $RequestCoveragesUpdate->NoAOGCoveragesTotal    = $NoAOGCoveragesTotal ;
          $RequestCoveragesUpdate->TotalPremium           = $TotalPremium ;
          $RequestCoveragesUpdate->TotalCoverages         = $TotalCoverages ;
          
          $RequestCoveragesUpdate->save(); 
    }

    $RequestCoveragesOD    = RequestCoverages::where('RequestNo',trim($id))->where('OptionNo',$OptionNumber)->where('PerilsCode','OD')->first();
    $RequestCoveragesTF    = RequestCoverages::where('RequestNo',trim($id))->where('OptionNo',$OptionNumber)->where('PerilsCode','TF')->first();
    $CAmountODTF   = $RequestCoveragesOD->CoveragesAmount +  $RequestCoveragesTF->CoveragesAmount;
    $PAmountODTF   = $RequestCoveragesOD->CoveragesPremium +  $RequestCoveragesTF->CoveragesPremium; 
      
    $RequestCoveragesOD->CAmountODTF            = $CAmountODTF ;
    $RequestCoveragesOD->PAmountODTF            = $PAmountODTF ;
    $RequestCoveragesOD->save(); 

    $RequestCoveragesTF->CAmountODTF            = $CAmountODTF ;
    $RequestCoveragesTF->PAmountODTF            = $PAmountODTF ;
    $RequestCoveragesTF->save(); 

  
   //Deductable
   $GetDenomination     = RequestDetails::where('RequestNo',$id)->first();
   $GetDenominationExplode  =  explode('-' ,$GetDenomination->Denomination);

   if (trim($GetDenomination->Denomination) === "2019-PC-0001" ) {
         $FindDefaultDeductible     = DefaultData::where('DefaultDataNo','2019-DE-0004')->first();
         //$MinAmount  = $FindDefaultDeductible->MinAmount;
         $PAmountODTF1  = $CAmountODTF;
     }else if (trim($GetDenomination->Denomination) === "2019-PC-0002" ) {
         $FindDefaultDeductible     = DefaultData::where('DefaultDataNo','2019-DE-0005')->first();
         $PAmountODTF1  = $CAmountODTF;
   }else if (trim($GetDenominationExplode[1] ) === "CV"   ) {
       $FindDefaultDeductible     = DefaultData::where('DefaultDataNo','2019-CV-0006')->first();
       $PAmountODTF1  = $CAmountODTF;
   }else if (trim($GetDenominationExplode[1] ) === "MC"   ) {
     $FindDefaultDeductible     = DefaultData::where('DefaultDataNo','2019-MC-0007')->first();
     $PAmountODTF1  = 1;
 }


     if (trim($RequestCoveragesOD->PerilsCode) === "OD" || trim($RequestCoveragesTF->PerilsCode) === "TF") {
             $Deductable =  $PAmountODTF1  * $FindDefaultDeductible->Amount; 
             if ($Deductable < $FindDefaultDeductible->MinAmount){  //less than the declare amount
                 $DeductableNew             =  $FindDefaultDeductible->MinAmount;
             }else{
                 $DeductableNew =  $PAmountODTF1  * $FindDefaultDeductible->Amount;
             }
     }else{
           $DeductableNew =  $FindDefaultDeductible->MinAmount;

   } 

   $CoveragesDeductible   = RequestCoverages::where('RequestNo',trim($id))->where('OptionNo',$OptionNumber)->get();
     foreach($CoveragesDeductible as $CoveragesDeductibles){ 
               $CoveragesDeductibles->Deductible           = round($DeductableNew , 2);
               $CoveragesDeductibles->save(); 
     }

///-------------------------End Coverages----------------------
$RequestCoveragesAOG    = RequestCoverages::where('RequestNo',trim($id))->where('OptionNo',$OptionNumber)->where('PerilsCode','AOG')->first();
    
$FindProductLineCharge1  = ProductLinesCharges::select('*')->where('ProductLine','2019-MC-0001')->where('Active','1')->get();
 
         $CompCharges1=0;
         foreach($FindProductLineCharge1 as $FindProductLineChargess)
         { 
             if ( trim($FindProductLineChargess->ChargesType) === 'Percent'){
                
                   //-------Doc Stamp Comp-------------------->
                     if ( trim($FindProductLineChargess->ChargesNo) === '2019-DP-0001'){
                       $Newvalue = $FindProductLineChargess->ChargesAmount  * $RequestCoveragesAOG->NoAOGPremiumTotal;
                       $value =  round($Newvalue, 2);
                       $numpart = explode(".",$value); 
                           if(is_float($value)){
                                 if ($numpart[1] < 51){
                                 //    it's a decimal that is greater than zero
                                 $CompChargesAmount1   = $numpart[0]. '.'. 50;
                                   // echo "Less 50=== " . $NewValue;
                                 }else{
                                 // its not a decimal, or the decimal is zero
                                 $CompChargesAmount1   = $numpart[0] +  1;
                                 //echo "Greather 50=== " . $NewValue;
                                 }
                           }else{
                             $CompChargesAmount1   = $value;
                           }
                   }else{
                     $CompChargesAmount1 =  $FindProductLineChargess->ChargesAmount * $RequestCoveragesAOG->NoAOGPremiumTotal ; 
                   }  
                 
 
             }else{
                     $CompChargesAmount1 =  $FindProductLineChargess->ChargesAmount ;  
             }
           
             $CompCharges1 += $CompChargesAmount1; 
             $UpdateCharges2    = RequestCharges::where('RequestNo',trim($id))->where('OptionNo',$OptionNumber)->where('ChargesNo',$FindProductLineChargess->ChargesNo)->get();
             foreach($UpdateCharges2 as $UpdateCharges22){ 
                   $UpdateCharges22->ChargesPremiumAOG             = $CompChargesAmount1;
                   //$UpdateCharges22->TotalChargesAOG               = $CountCharges;
                   $UpdateCharges22->save();
             
           }  
     }  
     
     $UpdateCharges2    = RequestCharges::where('RequestNo',trim($id))->where('OptionNo',$OptionNumber)->get();
     foreach($UpdateCharges2 as $UpdateCharges22){ 
           //$UpdateCharges22->ChargesPremiumAOG             = $CompChargesAmount;
           $UpdateCharges22->TotalChargesAOG               = $CompCharges1;
           $UpdateCharges22->save();
     
   }  
                 









    }


    public function GetRequestQuotationApprover($id)
    {
       	  
	 $RequestCoveragess    = RequestCoverages::select('*')->where('Status',2)->where('AssignApproverAcctNoQuote',trim($id))->groupBy('AssignApproverAcctNoQuote','RequestNo')->get();
		foreach($RequestCoveragess as $RequestCoveragesss)
			 { 	
				
					$GetAllRequestCoveragess = RequestCoverages::select('*') 
							  ->where('RequestNo',$RequestCoveragesss->RequestNo)
							  ->where('AssignApproverAcctNoQuote',$RequestCoveragesss->AssignApproverAcctNoQuote)
							  ->where('Active','1')
							  ->where('CoveragesPremium','!=',0)   
							  ->where('Status',2)
							  ->orderBy('Sort','ASC')
							  ->get();
							$ListCoverages = array();
							   foreach($GetAllRequestCoveragess as $GetAllRequestCoverages)
								  { 
								  
										  $ListCoverages[] = [
										 
										  'CoveragesName'					          => $GetAllRequestCoverages->CoveragesName,
										  'PerilsName'					            => $GetAllRequestCoverages->PerilsName, 
										  'CoveragesAmount'					        => $GetAllRequestCoverages->CoveragesAmount,
										  'CoveragesPremium'					      => $GetAllRequestCoverages->CoveragesPremium, 
										  'RequestNo'					    		      => $GetAllRequestCoverages->RequestNo,   
										  'Approver'					              => $GetAllRequestCoverages->AssignApproverNameQuote, 
										  'AccountNo'					              => $GetAllRequestCoverages->AccountNo, 
								  
										] ;
                  
                        $RequestDetails = RequestDetails::select('*')->where('Active', '1')->where('RequestNo',$RequestCoveragesss->RequestNo)->first();
                 

																
								  }
			 
					
											$CoveragesCustDetails[] = [
											
											  'OptionNo'					            => $GetAllRequestCoverages->OptionNo,  
											  'FirstName'					            => $RequestDetails->FirstName,
											  'MiddleName'					          => $RequestDetails->MiddleName, 
											  'LastName'					            => $RequestDetails->LastName,
											  'TINNumber'					            => $RequestDetails->TINNumber,
											  'PlateNumber'					          => $RequestDetails->PlateNumber,
											  'Denomination'					        => $RequestDetails->Denomination,
											  'RequestNo'					            => $RequestDetails->RequestNo,
                        'Status'					              => $RequestDetails->Status,
                        'RequestModify'					        => $RequestDetails->RequestModify,
											  'ListCoverages' 		            => $ListCoverages,					  
											
										] ;
					}
						return response()->json($CoveragesCustDetails);
  }  	
        
  public function  CustomerAcceptedCoverageView($id, request $request)
  {
    
    $PassData = explode(';;' ,trim($id));
    //$PassData[0] = "2020-0002";
   // $ProductLinesPerils      = ProductLinesPerils::select('*')->where('Active','1')->orderBy('Section','ASC')->groupBy('Section')->get();
     
   // $RequestCoverage         = RequestCoverages::select('*')->where('RequestNo',trim($PassData[0]))->where('RequestModify',1)->whereIn('Status',[4,3])->where('CoveragesPremium','!=',0)->groupBy('OptionNo')->get();
     $RequestCoverage         = RequestCoverages::select('*')->where('RequestNo',$PassData[0])->whereIn('Status',[4,3])->where('CoveragesPremium','!=',0)->groupBy('OptionNo')->get();
     $Case = array();
     foreach($RequestCoverage as $RequestCoverages)
      { 
        //echo $RequestCoverages->RequestNo;      
         $GetAllRequestCoverages = RequestCoverages::select('*') 
               //->where('Active','1')   //diabled active
               ->whereIn('Status',[4,3])
               //->where('Status',4)
               //->where('RequestModify',1)
               ->where('RequestNo',$PassData[0])
               ->where('PerilsCode','!=','TF')
               ->where('CoveragesPremium','!=',0)  
             // ->where('Section',$ProductLinesPerilss->Section)              
              ->where('OptionNo',$RequestCoverages->OptionNo)
              ->orderBy('Section','ASC')
              ->get();
             
              $Coverages = array();
              $CoveragesTotalAmount = 0 ; $ComputeCoveragesAmount = 0 ;  $CoveragesPremium  =0;
                  foreach($GetAllRequestCoverages as $GetAllRequestCoveragess){
                   
                    $CoveragesTotalAmount  += $GetAllRequestCoveragess->TotalPremiumAmount;
                      if ( $GetAllRequestCoveragess->PerilsCode === 'OD'  ){
                          $ComputeCoveragesAmount = $GetAllRequestCoveragess->CAmountODTF ;
                          $CoveragesPremium       = $GetAllRequestCoveragess->PAmountODTF;
                      }else{
                          $ComputeCoveragesAmount  = $GetAllRequestCoveragess->CoveragesAmount;
                          $CoveragesPremium        = $GetAllRequestCoveragess->CoveragesPremium;
                      } 


                      if ( $GetAllRequestCoveragess->PerilsCode === 'AOG'  ){
                        $NoAOG                  = "YES";
                        $NoAOGCoverageAmount    = $ComputeCoveragesAmount;
                        $NoAOGCoveragePremium   = $CoveragesPremium;
                       
                    }else{
                         $NoAOG                 = "NO";
                         $NoAOGCoverageAmount    = $ComputeCoveragesAmount - $GetAllRequestCoveragess->CoveragesAmount;
                         $NoAOGCoveragePremium   = $CoveragesPremium  - $GetAllRequestCoveragess->CoveragesPremium;
                    } 
                      
             
                      $Coverages[] = [
                        '_id'                   => $GetAllRequestCoveragess->_id,
                        'Status'                => $GetAllRequestCoveragess->Status,
                        'Active'                => $GetAllRequestCoveragess->Active,
                        //'CoveragesName'         => $CoveragesName,
                        'CoveragesPremium'      => $CoveragesPremium, //$GetAllRequestCoveragess->CoveragesPremium, 
                        'PremiumAmount'         => $GetAllRequestCoveragess->PremiumAmount,
                        'CoveragesAmount'       => $GetAllRequestCoveragess->CoveragesAmount,
                        //'TotalCoveragesPremium' => $GetAllRequestCoveragess->TotalPremiumAmount,
                        'OptionNo'	            => $GetAllRequestCoveragess->OptionNo,
                        'PerilsName'	          => $GetAllRequestCoveragess->PerilsName,
                        'CoveragesTotalAmount'  => $CoveragesTotalAmount,
                        'ApproverRemarks'	      => $GetAllRequestCoveragess->ApproverRemarksQuote,
                        'Approver'	            => $GetAllRequestCoveragess->Approver,
                        'ApproverName'	        => $GetAllRequestCoveragess->ApproverName,
                        'ClientRemarks'	        => $GetAllRequestCoveragess->ClientRemarks,
                        'CoverageRates'	        => $GetAllRequestCoveragess->CoverageRates,
                        'ApproverRemarksDate'   => $GetAllRequestCoveragess->ApproverRemarksDate,
                        'ClientRemarksDate'     => $GetAllRequestCoveragess->ClientRemarksDate,
                        'PerilsCode'            => $GetAllRequestCoveragess->PerilsCode,
                        'ComputeCoveagesAmount' => $ComputeCoveragesAmount,
                        'Description'           => $GetAllRequestCoveragess->Description,
                        'NoAOG'                 => $NoAOG ,
                        'NoAOGCoverageAmount'   => $NoAOGCoverageAmount ,
                        'NoAOGCoveragePremium'  => $NoAOGCoveragePremium ,
                        
                      ];
           
                      
            }	

            $GetAllRequestCharges = RequestCharges::select('*')
              ->where('Active','1')
              ->whereIn('Status',[4,3])
              ->where('RequestNo',trim($PassData[0]))
              ->where('OptionNo',$RequestCoverages->OptionNo)
              ->orderBy('ChargesNo','ASC')
              ->get();

              $Charges = array();
                  foreach($GetAllRequestCharges as $GetAllRequestChargess){
                      
                        $Charges[] = [
                          '_id'                   => $GetAllRequestChargess->_id,
                          'ChargesName'           => $GetAllRequestChargess->ChargesName,
                          'ChargesAmount'         => $GetAllRequestChargess->ChargesAmount,
                          'ChargesPremium'        => $GetAllRequestChargess->ChargesPremium,
                          'TotalCharges'	        => $GetAllRequestChargess->TotalCharges,
                          'ChargesType'	          => $GetAllRequestChargess->ChargesType,
                          'ChargesNo'	            => $GetAllRequestChargess->ChargesNo,
                          'OptionNo'	            => $GetAllRequestChargess->OptionNo,
                          'ChargesPremiumAOG'	    => $GetAllRequestChargess->ChargesPremiumAOG,
                          
                         
                        ];
            }	


            $GetClause = RequestClauses::select('*')  
                      ->where('RequestNo',trim($PassData[0]))
                      ->where('OptionNo',$RequestCoverages->OptionNo)
                      ->where('Active',1)
                      ->where('Status',1)
                      ->get();

            $ClausesWarranties = array();
                foreach($GetClause as $GetClauses){
                      $ClausesWarranties[] = [
                        '_id'                   => $GetClauses->_id,
                        'ClausesNo'             => $GetClauses->ClausesNo,
                        'ClausesName'           => $GetClauses->ClausesName,
                        'ClausesStatement'      => $GetClauses->ClausesStatement,
                      ];
          }	


          $GetAccessories = RequestAccessories::select('*')  
          ->where('RequestNo',trim($PassData[0]))
          ->where('OptionNo',$RequestCoverages->OptionNo)
          ->where('Active',1)
          ->where('Status',1)
          ->get();

          $Accessories = array();
              foreach($GetAccessories as $GetAccessoriess){
                    $Accessories[] = [
                      '_id'                   => $GetAccessoriess->_id,
                      'Name'                  => $GetAccessoriess->Name,
                      'Amount'                => $GetAccessoriess->Amount,
                      
                    ];
          }	


        
        
            //$user = Auth::user();
            $Case[] = [
                       '_id'                           => $RequestCoverages->_id,
                      'OptionNo'					             => $RequestCoverages->OptionNo,
                      'RequestNo'					             => $GetAllRequestCoveragess->RequestNo,  
                      'CoverageRates'	        		     => $GetAllRequestCoveragess->CoverageRates,


                      'TotalCoverages'	        		    => $GetAllRequestCoveragess->TotalCoverages,
                      'TotalPremium'	        		      => $GetAllRequestCoveragess->TotalPremium,
                      'NoAOGCoveragesTotal'	            => $GetAllRequestCoveragess->NoAOGCoveragesTotal,
                      'NoAOGPremiumTotal'	        		  => $GetAllRequestCoveragess->NoAOGPremiumTotal,
                      'TotalCharges'	                  => $GetAllRequestChargess->TotalCharges,
                      'TotalAmountDue'	                => $GetAllRequestChargess->TotalAmountDue,
                      'TotalChargesAOG'	                => $GetAllRequestChargess->TotalChargesAOG,
                      'StatusCovetages'                 => $GetAllRequestCoveragess->Status,
                      'Deductible'                      => $GetAllRequestCoveragess->Deductible,
                    
                      'ListCoverages' 		              => $Coverages,
                      'ListCharges' 		                => $Charges,
                      'ClausesWarranties' 		          => $ClausesWarranties,
                      'Accessories' 		                => $Accessories,
              
                    ] ;						
        
      }
      return response()->json($Case);	
   
  }




  public function  CustomerRequestQuotation($id, request $request)
  {
    
    //$RequestCoverage      = RequestCoverages::select('*')->where('RequestNo',trim($id))->whereIn('Status',[3,1,2])->where('CoveragesPremium','!=',0)->groupBy('OptionNo')->orderBy("OptionNo",'ASC')->get();
    $RequestCoverage      = RequestCoverages::select('*')->where('RequestNo',trim($id))->where('CoveragesPremium','!=',0)->groupBy('OptionNo')->orderBy("OptionNo",'ASC')->get();

     foreach($RequestCoverage as $RequestCoverages)
      { 
        //echo $RequestCoverages->RequestNo;      
         $GetAllRequestCoverages = RequestCoverages::select('*') 
              ->where('Active','1')
              //->where('RequestModify',0)
             // ->whereIn('Status',[3,1,2])
              ->where('RequestNo',trim($id))
              ->where('PerilsCode','!=','TF')
              ->where('CoveragesPremium','!=',0)                
              ->where('OptionNo',$RequestCoverages->OptionNo)
              ->orderBy('Sort','ASC')
              ->get();
              $CoveragesTotalAmount = 0 ;
              $Coverages = array();
                  foreach($GetAllRequestCoverages as $GetAllRequestCoveragess){
                    
                    $CoveragesTotalAmount  += $GetAllRequestCoveragess->TotalPremiumAmount;

                    if ( $GetAllRequestCoveragess->PerilsCode == 'OD'  ){
                      $ComputeCoveragesAmount = $GetAllRequestCoveragess->CAmountODTF ;
                      $CoveragesPremium       = $GetAllRequestCoveragess->PAmountODTF;
                  }else{
                      $ComputeCoveragesAmount  = $GetAllRequestCoveragess->CoveragesAmount;
                      $CoveragesPremium        = $GetAllRequestCoveragess->CoveragesPremium;
                  } 


                        $Coverages[] = [
                          '_id'                   => $GetAllRequestCoveragess->_id,
                          'Status'                => $GetAllRequestCoveragess->Status,
                          'Active'                => $GetAllRequestCoveragess->Active,
                          'CoveragesName'         => $GetAllRequestCoveragess->CoveragesName,
                          'CoveragesPremium'      => $CoveragesPremium, 
                          'PremiumAmount'         => $GetAllRequestCoveragess->PremiumAmount,
                          'CoveragesAmount'       => $GetAllRequestCoveragess->CoveragesAmount, //$ComputeCoveragesAmount,
                          //'CoverageRates' 		  => $GetAllRequestCoveragess->CoverageRates,
                          'OptionNo'	            => $GetAllRequestCoveragess->OptionNo,
                          'PerilsCode'	          => $GetAllRequestCoveragess->PerilsCode,
                          'PerilsName'	          => $GetAllRequestCoveragess->PerilsName,
                          'CoveragesTotalAmount'  => $CoveragesTotalAmount,
                          'ApproverRemarks'	      => $GetAllRequestCoveragess->ApproverRemarks,
                          'Approver'	            => $GetAllRequestCoveragess->Approver,
                          'ApproverName'	        => $GetAllRequestCoveragess->ApproverName,
                          'CoverageRates'	        => $GetAllRequestCoveragess->CoverageRates,
                          'ApproverRemarksDate'   => $GetAllRequestCoveragess->ApproverRemarksDate,
                          'ClientRemarksDate'     => $GetAllRequestCoveragess->ClientRemarksDate,
                          'ClientReemarks'        => $GetAllRequestCoveragess->ClientRemarks,  
                          'RequestModify'         => $GetAllRequestCoveragess->RequestModify,  
                          'WithAOG'               => $GetAllRequestCoveragess->WithAOG,  
                          
                        ];
                      
            }	
            
            $GetAllRequestCharges = RequestCharges::select('*')
              ->where('Active','1')
              //->whereIn('Status',[3,1,2])
              ->where('RequestNo',trim($id))
              ->where('OptionNo',$RequestCoverages->OptionNo)
              ->orderBy('ChargesNo','ASC')
              ->get();

              $Charges = array();
                  foreach($GetAllRequestCharges as $GetAllRequestChargess){
                      
                        $Charges[] = [
                          '_id'                   => $GetAllRequestChargess->_id,
                          'ChargesName'           => $GetAllRequestChargess->ChargesName,
                          'ChargesAmount'         => $GetAllRequestChargess->ChargesAmount,
                          'ChargesPremium'        => $GetAllRequestChargess->ChargesPremium,
                          'ChargesType'	          => $GetAllRequestChargess->ChargesType,
                          'ChargesNo'	            => $GetAllRequestChargess->ChargesNo,
                          'OptionNo'	            => $GetAllRequestChargess->OptionNo,
                          'ChargesPremiumAOG'	    => $GetAllRequestChargess->ChargesPremiumAOG,
						  
                          
                         
                        ];
            }	

            //$user = Auth::user();
            $Case[] = [
                       '_id'                          	=> $RequestCoverages->_id,
                      'OptionNo'					              => $RequestCoverages->OptionNo,
                      'RequestNo'					              => $GetAllRequestCoveragess->RequestNo,  
                      'CoverageRates'	        		      => $GetAllRequestCoveragess->CoverageRates,
                      'TotalCoverages'	        		    => $GetAllRequestCoveragess->TotalCoverages,
                      'TotalPremium'	        		      => $GetAllRequestCoveragess->TotalPremium,
                      'NoAOGCoveragesTotal'	            => $GetAllRequestCoveragess->NoAOGCoveragesTotal,
                      'NoAOGPremiumTotal'	        		  => $GetAllRequestCoveragess->NoAOGPremiumTotal,
                      'TotalCharges'	                  => $GetAllRequestChargess->TotalCharges,
                      'TotalAmountDue'	                => $GetAllRequestChargess->TotalAmountDue,
                      'TotalChargesAOG'	                => $GetAllRequestChargess->TotalChargesAOG,
                      'StatusCovetages'                => $GetAllRequestCoveragess->Status,
                      'Deductible'                      => $GetAllRequestCoveragess->Deductible,
                      

                      'CoverageRates'	        		      => $GetAllRequestCoveragess->CoverageRates,
                      'ListCoverages' 		              => $Coverages,
                      'ListCharges' 		                => $Charges
              
                    ] ;						
        }
      return response()->json($Case);	
   
  }

  


  public function GetIssuanceForSignaturePaging() 
  {
      //$this->DetectExpirationQuotation(); 
	 // $id="2020-0008";
      return RequestDetails::select('*')->where('Active', '1')->where('ForSignature',1)->paginate(20);
  }
  
  public function GetIssuanceForSignature($id) 
  {
      //$this->DetectExpirationQuotation(); 
	  
      return RequestDetails::select('*')->where('Active', '1')->where('ForSignature',1)->where('ForSignatureAcctNo',trim($id))->paginate(20);
  }


  public function SubmitForSignature($id)
  {
      $PassData = explode(';;',$id);
              //  $RequestCoverages   = RequestCoverages::where('RequestNo',$PassData[0])->get();
              //   foreach($RequestCoverages as $RequestCoveragess){
              //         $RequestCoveragess->RequestModify                  = 1;
              //         $RequestCoveragess->RequestModifyCoverages         = 1 ;
              //         $RequestCoveragess->RequestModifyPassByAcctNo      =trim($PassData[1]); 
              //         $RequestCoveragess->RequestModifyPassByName        =$PassData[2]; 
              //         $RequestCoveragess->RequestModifyRemarks           =$PassData[4];
              //         $RequestCoveragess->save(); 
         
              // }
		
		           $RequestDetails   = RequestDetails::where('RequestNo',$PassData[0])->first();
              $RequestDetails->ForSignature         = 1;
			        $RequestDetails->ForSignatureAcctNo         = $PassData[7];
			        $RequestDetails->ForSignatureName         = $PassData[8];
              $RequestDetails->IssuanceRemarks      = $PassData[5];
              $RequestDetails->PolicyNo      = $PassData[9];
              
              $RequestDetails->save(); 
  }


  public function GetListSignatory()
  {
 
      //return Userrole::select('*')->where('Active','1')->where('RoleAlias','AI')->paginate(2);
                $Userrole = Userrole::select('*') 
                ->where('active',1)
                ->where('RoleAlias','AI')
                ->orderBy('BankName','ASC')
                ->get();
          $ResultUserrole = array();
            foreach($Userrole as $Userroles)
          { 
                $ResultUserrole[] = [
                '_id'	  	  	    => $Userroles->_id,
                'CName'	  	      => $Userroles->CName,
                'AccountNo'	  	  => $Userroles->AccountNo,
                'Limit'	          => $Userroles->Limit,
              ] ;
            
              
          }
          return response()->json($ResultUserrole);	

  }
  public function LogsReport($id)
  {

      //  $id = "2019-0003";
        date_default_timezone_set('Asia/Hong_Kong');
      $CurrentDate              = date('Y-m-d H:i:s');

      $RequestCoveragess    = RequestCoverages::select('*')->where('RequestNo',trim($id))->groupBy('OptionNo')->get();
      foreach($RequestCoveragess as $RequestCoveragesss)
         { 	
          
            $GetAllRequestCoveragess = RequestCoverages::select('*') 
                  ->where('RequestNo',$id)
                  ->where('OptionNo',$RequestCoveragesss->OptionNo)
                  ->where('Active','1')
                  ->orderBy('Sort','ASC')
                  ->get();
                $ListCoverages = array();
                $OldTotalPremium = 0 ;$OldTotalCharges = 0 ; $OldTotalAmount= 0 ;  $OldTotalAmountDue = 0 ; 
                   foreach($GetAllRequestCoveragess as $GetAllRequestCoverages)
                    { 
                         $OldTotalPremium += $GetAllRequestCoverages->CoveragesPremium;
                         $OldTotalAmount  += $GetAllRequestCoverages->CoveragesAmount;
                        $ListCoverages[] = [
                       
                        'CoveragesName'					          => $GetAllRequestCoverages->CoveragesName,
                        'PerilsName'					            => $GetAllRequestCoverages->PerilsName, 
                        'CoveragesAmount'					        => $GetAllRequestCoverages->CoveragesAmount,
                        'CoveragesPremium'					      => $GetAllRequestCoverages->CoveragesPremium, 
                        'RequestNo'					    		      => $GetAllRequestCoverages->RequestNo,   
                        'CoverageRates'					          => $GetAllRequestCoverages->CoverageRates, 
                        'AccountNo'					              => $GetAllRequestCoverages->AccountNo, 
                    
                      ] ;
                    
                   $RequestDetails = RequestDetails::select('*')->where('Active', '1')->where('RequestNo',$id )->first();
                    }

                     
                    $GetAllRequestCharges = RequestCharges::select('*')
                    ->where('Active','1')
                    ->where('RequestNo',trim($id))
                    ->where('OptionNo',$GetAllRequestCoverages->OptionNo)
                    ->orderBy('ChargesNo','ASC')
                    ->get();

                    $Charges = array();
                    
                    foreach($GetAllRequestCharges as $GetAllRequestChargess){
                      $OldTotalCharges += $GetAllRequestChargess->ChargesPremium;
                          $Charges[] = [
                            '_id'                   => $GetAllRequestChargess->_id,
                            'ChargesName'           => $GetAllRequestChargess->ChargesName,
                            'ChargesAmount'         => $GetAllRequestChargess->ChargesAmount,
                            'ChargesPremium'        => $GetAllRequestChargess->ChargesPremium,
                            'ChargesType'	          => $GetAllRequestChargess->ChargesType,
                            'ChargesNo'	            => $GetAllRequestChargess->ChargesNo,
                            'OptionNo'	            => $GetAllRequestChargess->OptionNo,
                            
                           
                          ];
							    }	
         
                       //$OldTotalAmountDue =  
                        $CoveragesCustDetails[] = [
                        
                          'OptionNo'					            => $GetAllRequestCoverages->OptionNo,  
                          'FirstName'					            => $RequestDetails->FirstName,
                          'MiddleName'					          => $RequestDetails->MiddleName, 
                          'LastName'					            => $RequestDetails->LastName,
                          'TINNumber'					            => $RequestDetails->TINNumber,
                          'PlateNumber'					          => $RequestDetails->PlateNumber,
                          'Denomination'					        => $RequestDetails->Denomination,
                          'RequestNo'					            => $RequestDetails->RequestNo,
                          'Status'					              => $RequestDetails->Status,
                          'RequestModify'					        => $RequestDetails->RequestModify,
                          'OldTotalPremium'               => $OldTotalPremium,
                          'OldTotalCharges'               => $OldTotalCharges,
                          'OldTotalAmount'                => $OldTotalAmount,
                          'OldTotalAmountDue'             => $OldTotalPremium +  $OldTotalCharges,
                          'OldCoverages' 		              => $ListCoverages,	
                          'OldChargers'				            => $Charges,
                        
                          
                          
                      ] ;
            }
                return response()->json($CoveragesCustDetails);
}

public function getLogsReport()
{
  return ReportQuotation::latest()->paginate(10);
}

public function getLog($id)
{
  return ReportQuotation::find($id);
}




  public function GetListClauses($id)
  {
    $PassData = explode(';;' ,trim($id));
			$RequestClausess = RequestClauses::select('*')->where('RequestNo',trim($PassData[0]))->where('OptionNo',round($PassData[1]) )->where('Active',1)->pluck('ClausesNo')->all();
                    $ClausesWarrantiesList1 = ClausesWarranties::select('*')->whereNotIn('Number',$RequestClausess)->where('Active',1)->get();
                   // $WarrantiesList1 = array();
                    foreach($ClausesWarrantiesList1 as $ClausesWarrantiesList){

                        $WarrantiesList1[] = [
                          '_id'              => $ClausesWarrantiesList->_id,
                          'Number'           => $ClausesWarrantiesList->Number,
                          'Statement'        => $ClausesWarrantiesList->Statement,
                          'Name'             => $ClausesWarrantiesList->Name,
                        ];
          
                      }
                    
        return response()->json($WarrantiesList1);	
  }

  public function ComputeDaysDiff()
  {
    $CurrentDate   = date('Y-m-d');
    $date1        = strtotime($CurrentDate );    //date('Y-m-d H:i:s');
    $date2        = strtotime("2020-01-21");  
    $CompDaysLate   = ($date2 - $date1)/60/60/24;

   // $diff = abs($date2 - $date1);  
     // $interval = $yearEnd - $yearStart ;
     // echo $datetime2. " :" . $interval / 86400;
     //echo "Difference between two dates: " . $date1 . " :"    . $CompDaysLate ; 


     $RequestDetailss      = RequestDetails::where('RequestNo','2020-0005')->first();
         
    $RequestClausess = RequestClauses::select('*')->where('RequestNo','2020-0005')->where('Belong','Bank')->where('Active',1)->first();
    $MortgageeDetails =   trim($RequestDetailss->MortgageBankName .  " - " . $RequestDetailss->MortgageBankAddress);
    if (strpos($RequestClausess->ClausesStatement,$MortgageeDetails) !== false){
      $BankDetails            ="EastWest22 - ty" ;
      $ClausesStatement       = str_replace($MortgageeDetails,$BankDetails, trim($RequestClausess->ClausesStatement));
    }

    echo $ClausesStatement;
    echo $MortgageeDetails ;
}



public function GetListBanksIssuance($id)
{
 
    $RequestClausess = RequestDetails::select('*')->where('RequestNo',trim($id))->where('Active',"1")->first();
                  $GetBankDetail = BankDetails::select('*')->where('BankName','!=',trim($RequestClausess->MortgageBankName))->orderBy('BankName',"ASC")->get();
                  foreach($GetBankDetail as $GetBankDetails){
                          $BankDetailsList[] = [
                            '_id'              => $GetBankDetails->_id,
                            'BankName'         => $GetBankDetails->BankName,
                            'Remarks'          => $GetBankDetails->Remarks,
                          
                          ];
                    }
                  
      return response()->json($BankDetailsList);	
}


public function  ChangeBankDetails($id){
            $PassData                                     = explode(';;' ,trim($id));
            $RequestDetailss                              = RequestDetails::where('RequestNo',trim($PassData[0]))->first();
            $RequestDetailss->MortgageBankName          	= $PassData[1];
            $RequestDetailss->MortgageBankAddress         = $PassData[2];
            $RequestDetailss->save(); 
           
      
            $RequestDetailss     = RequestDetails::where('RequestNo',trim($PassData[0]))->first();
            $ClausesWarranties     =  ClausesWarranties ::where('Active',1)->where('Belong','Bank')->first(); 
          
            if (strpos($ClausesWarranties->Statement, 'EAST West Bank- Paco Branch') !== false){
             $BankDetails            = $PassData[1] . ' - '. $PassData[2] ;
             $ClausesStatement       = str_replace("EAST West Bank- Paco Branch",$BankDetails, trim($ClausesWarranties->Statement));
            }else{
             $ClausesStatement       = $ClausesWarranties->Statement;
            }

            
            $RequestClausess = RequestClauses::select('*')->where('RequestNo',trim($PassData[0]))->where('Belong','Bank')->where('Active',1)->first();
            $RequestClausess->ClausesStatement         = $ClausesStatement;
            $RequestClausess->save(); 
           // echo $ClausesStatement;


}

public function  URLQueryPerilsCoveragesGroupEdit($id, request $request)
    {
      
      //$id= "2020-0002";  
      $RequestCoverage          = RequestCoverages::select('*')->where('RequestNo',trim($id))->where('CoveragesPremium','!=',0)->groupBy('OptionNo')->orderBy("OptionNo",'ASC')->get();

       foreach($RequestCoverage as $RequestCoverages)
        { 
          //echo $RequestCoverages->RequestNo;      
           $GetAllRequestCoverages = RequestCoverages::select('*') 
                ->where('Active','1')
                ->where('RequestNo',trim($id))
                ->where('CoveragesPremium','!=',0)   
                //->where('PerilsCode','!=','TF')             
                ->where('OptionNo',$RequestCoverages->OptionNo)
                ->orderBy('Sort','ASC')
                ->get();
                $CoveragesTotalAmount = 0 ;  $CoveragesPremium  =0;
                $Coverages = array();
                    foreach($GetAllRequestCoverages as $GetAllRequestCoveragess){


                      if ( $GetAllRequestCoveragess->PerilsCode == 'OD'  ){
                        $ComputeCoveragesAmount = $GetAllRequestCoveragess->CAmountODTF ;
                        $CoveragesPremium       = $GetAllRequestCoveragess->PAmountODTF;
                    }else{
                        $ComputeCoveragesAmount  = $GetAllRequestCoveragess->CoveragesAmount;
                        $CoveragesPremium        = $GetAllRequestCoveragess->CoveragesPremium;
                    } 
                    
                      
                      $CoveragesTotalAmount  += $GetAllRequestCoveragess->TotalPremiumAmount;

                          $Coverages[] = [
                            '_id'                   => $GetAllRequestCoveragess->_id,
                            'Status'                => $GetAllRequestCoveragess->Status,
                            'Active'                => $GetAllRequestCoveragess->Active,
                            'CoveragesName'         => $GetAllRequestCoveragess->CoveragesName,
                            'CoveragesName'         => $GetAllRequestCoveragess->CoveragesName,
                            'PerilsCode'            => $GetAllRequestCoveragess->PerilsCode, 
                            'CoveragesPremium'      => $CoveragesPremium , 
                            'PremiumAmount'         => $GetAllRequestCoveragess->PremiumAmount,
                            'CoveragesAmount'       => $GetAllRequestCoveragess->CoveragesAmount,
                            //'TotalCoveragesPremium' => $GetAllRequestCoveragess->TotalPremiumAmount,
                            'OptionNo'	            => $GetAllRequestCoveragess->OptionNo,
                            'PerilsName'	          => $GetAllRequestCoveragess->PerilsName,
                            'CoveragesTotalAmount'  => $CoveragesTotalAmount,
                            'ApproverRemarks'	      => $GetAllRequestCoveragess->ApproverRemarks,
                            'Approver'	            => $GetAllRequestCoveragess->Approver,
                            'ApproverName'	        => $GetAllRequestCoveragess->ApproverName,
                            'CoverageRates'	        => $GetAllRequestCoveragess->CoverageRates,
                            'ApproverRemarksDate'   => $GetAllRequestCoveragess->ApproverRemarksDate,
                            'ClientRemarksDate'     => $GetAllRequestCoveragess->ClientRemarksDate,
                            'ClientRemarks'         => $GetAllRequestCoveragess->ClientRemarks,  
                            'ApproverNameQuote'     => $GetAllRequestCoveragess->ApproverNameQuote, 
                            'RequestModify'   		  => $GetAllRequestCoveragess->RequestModify,  
                          ];
                       
              }	


              
              $GetAllRequestCharges = RequestCharges::select('*')
                ->where('Active','1')
                ->where('RequestNo',trim($id))
                ->where('OptionNo',$RequestCoverages->OptionNo)
                ->orderBy('ChargesNo','ASC')
                ->get();

                $Charges = array();
                    foreach($GetAllRequestCharges as $GetAllRequestChargess){
                        
                          $Charges[] = [
                            '_id'                   => $GetAllRequestChargess->_id,
                            'ChargesName'           => $GetAllRequestChargess->ChargesName,
                            'ChargesAmount'         => $GetAllRequestChargess->ChargesAmount,
                            'ChargesPremium'        => $GetAllRequestChargess->ChargesPremium,
                            'TotalCharges'	        => $GetAllRequestChargess->TotalCharges,
                            'ChargesType'	          => $GetAllRequestChargess->ChargesType,
                            'ChargesNo'	            => $GetAllRequestChargess->ChargesNo,
                            'OptionNo'	            => $GetAllRequestChargess->OptionNo,
                            
                           
                          ];
							}	

              //$user = Auth::user();
              $Case[] = [
                         '_id'                            => $RequestCoverages->_id,
                        'OptionNo'					              => $RequestCoverages->OptionNo,
                        'RequestNo'					              => $GetAllRequestCoveragess->RequestNo, 
                        'CoverageRates'	        		      => $GetAllRequestCoveragess->CoverageRates,
                        'Deductible'                      => $GetAllRequestCoveragess->Deductible,
                        'ListCoverages' 		              => $Coverages,
                        'ListCharges' 		                => $Charges
                
                      ] ;						
          }
        return response()->json($Case);	
     
    }

    public function Wordings()
    {
      return ClausesWarranties::select('*')->where('Belong', 'Proposal')->first();
    }


   
    



    public function  ProposalFormEdit($id, request $request)
    {
      
      //$id= "2020-0002";  
      $RequestCoverage          = RequestCoverages::select('*')->where('RequestNo',trim($id))->where('CoveragesPremium','!=',0)->groupBy('OptionNo')->orderBy("OptionNo",'ASC')->get();

       foreach($RequestCoverage as $RequestCoverages)
        { 
          //echo $RequestCoverages->RequestNo;      
           $GetAllRequestCoverages = RequestCoverages::select('*') 
                ->where('Active','1')
                ->where('RequestNo',trim($id))
                ->where('CoveragesPremium','!=',0)   
                //->where('PerilsCode','!=','TF')             
                ->where('OptionNo',$RequestCoverages->OptionNo)
                ->orderBy('Sort','ASC')
                ->get();
                $CoveragesTotalAmount = 0 ;  $CoveragesPremium  =0;
                $Coverages = array();
                    foreach($GetAllRequestCoverages as $GetAllRequestCoveragess){


                      if ( $GetAllRequestCoveragess->PerilsCode == 'OD'  ){
                        $ComputeCoveragesAmount = $GetAllRequestCoveragess->CAmountODTF ;
                        $CoveragesPremium       = $GetAllRequestCoveragess->PAmountODTF;
                    }else{
                        $ComputeCoveragesAmount  = $GetAllRequestCoveragess->CoveragesAmount;
                        $CoveragesPremium        = $GetAllRequestCoveragess->CoveragesPremium;
                    } 
                    
                      
                      $CoveragesTotalAmount  += $GetAllRequestCoveragess->TotalPremiumAmount;

                          $Coverages[] = [
                            '_id'                   => $GetAllRequestCoveragess->_id,
							              'CoveragesNo'           => $GetAllRequestCoveragess->CoveragesNo,
                            'Status'                => $GetAllRequestCoveragess->Status,
                            'Active'                => $GetAllRequestCoveragess->Active,
                            'PerilsNo'              => $GetAllRequestCoveragess->CoveragesName,
                            'CoveragesName'         => $GetAllRequestCoveragess->CoveragesName,
                            'CoveragesPremium'      => $GetAllRequestCoveragess->CoveragesPremium, 
                            //'CoveragesPremium'      => $CoveragesPremium , 
                            'PremiumAmount'         => $GetAllRequestCoveragess->PremiumAmount,
                            'CoveragesAmount'       => $GetAllRequestCoveragess->CoveragesAmount,
                            'PerilsCode'            => $GetAllRequestCoveragess->PerilsCode,
                            'OptionNo'	            => $GetAllRequestCoveragess->OptionNo,
                            'PerilsName'	          => $GetAllRequestCoveragess->PerilsName,
                            'CoveragesTotalAmount'  => $CoveragesTotalAmount,
                            'ApproverRemarks'	      => $GetAllRequestCoveragess->ApproverRemarks,
                            'Approver'	            => $GetAllRequestCoveragess->Approver,
                            'ApproverName'	        => $GetAllRequestCoveragess->ApproverName,
                            'CoverageRates'	        => $GetAllRequestCoveragess->CoverageRates,
                            'ApproverRemarksDate'   => $GetAllRequestCoveragess->ApproverRemarksDate,
                            'ClientRemarksDate'     => $GetAllRequestCoveragess->ClientRemarksDate,
                            'ClientRemarks'         => $GetAllRequestCoveragess->ClientRemarks,  
                            'ApproverNameQuote'     => $GetAllRequestCoveragess->ApproverNameQuote, 
                            'RequestModify'   		  => $GetAllRequestCoveragess->RequestModify, 
                            'CoTotalCoverages'   		=> $GetAllRequestCoveragess->TotalCoverages,
                            'CoTotalPremium'   		  => $GetAllRequestCoveragess->TotalPremium,
						
                              
                          ];
                       
              }	


              
              $GetAllRequestCharges = RequestCharges::select('*')
                ->where('Active','1')
                ->where('RequestNo',trim($id))
                ->where('OptionNo',$RequestCoverages->OptionNo)
                ->orderBy('ChargesNo','ASC')
                ->get();

                $Charges = array();
                    foreach($GetAllRequestCharges as $GetAllRequestChargess){
                        
                          $Charges[] = [
                            '_id'                   => $GetAllRequestChargess->_id,
                            'ChargesName'           => $GetAllRequestChargess->ChargesName,
                            'ChargesAmount'         => $GetAllRequestChargess->ChargesAmount,
                            'ChargesPremium'        => $GetAllRequestChargess->ChargesPremium,
                            'TotalCharges'	        => $GetAllRequestChargess->TotalCharges,
							              'TotalAmountDue'	    => $GetAllRequestChargess->TotalAmountDue,
                            'ChargesType'	          => $GetAllRequestChargess->ChargesType,
                            'ChargesNo'	            => $GetAllRequestChargess->ChargesNo,
                            'OptionNo'	            => $GetAllRequestChargess->OptionNo,
                            
                           
                          ];
							}	

              //$user = Auth::user();
              $Case[] = [
                        // '_id'                            => $RequestCoverage->_id,
                        'OptionNo'					              => $RequestCoverages->OptionNo,
                        'RequestNo'					              => $GetAllRequestCoveragess->RequestNo, 
                        'CoverageRates'	        		      => $GetAllRequestCoveragess->CoverageRates,
                        'TotalCharges'	                  => $GetAllRequestChargess->TotalCharges,
                        'TotalCoverages'   		            => $GetAllRequestCoveragess->TotalCoverages,
                        'TotalPremium'   		              => $GetAllRequestCoveragess->TotalPremium,
                        'TotalAmountDue'   		             => $GetAllRequestCoveragess->TotalPremium + $GetAllRequestChargess->TotalCharges,
                        'Deductible'                      => $GetAllRequestCoveragess->Deductible,
					              'PAmountODTF'   		              => $GetAllRequestCoveragess->PAmountODTF,
                        'ListCoverages' 		              => $Coverages,
                        'ListCharges' 		                => $Charges
                
                      ] ;						
          }
        return response()->json($Case);	
     
    }
	
	
	


    public function UploadImage(Request $request)
    {
      if($request->get('image'))
       {
          $image = $request->get('image');
          $name = time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
          \Image::make($request->get('image'))->save(public_path('OR-CR/') . $name);
        }
      $image= new RequestDetails();
      $image->image_name = $name;
     // $image->UploadedORCR       = $request->get('image');
      $image->save();

      return response()->json(['success' => 'You have successfully uploaded an image'], 200);
    }


    public function UploadSignature($id){
              $PassData   = explode(';;' ,$id);
              $RequestDetails                               = RequestDetails::where('RequestNo',$PassData[0])->first();
              $RequestDetails->PolicyApproverSignature      = $PassData[3];
			        $RequestDetails->PolicyApproverCName          = $PassData[2];
			        $RequestDetails->PolicyApproverAcctNo         = $PassData[1];
              $RequestDetails->Status                       = "Approved";
              $RequestDetails->save(); 

    }


    public function ProposalEditCheckBoxAmount($id)
    {
         $PassData   = explode(';;' ,$id);
          // $RequestCoverages   = RequestCoverages::where('RequestNo',$PassData[0])->where('OptionNo',round($PassData[1]))->get();
          // foreach($RequestCoverages as $RequestCoveragess){ 
          //           $RequestCoveragess->CoveragesAmount           = 100000;
          //           $RequestCoveragess->save(); 
          // }
    }

    public function ProposalEditTxtBoxAmount($id)
    {
         $PassData   = explode(';;' ,$id);
          // $RequestCoverages   = RequestCoverages::where('RequestNo',$PassData[0])->where('OptionNo',round($PassData[1]))->get();
          // foreach($RequestCoverages as $RequestCoveragess){ 
          //           $RequestCoveragess->CoveragesAmount           = 100000;
          //           $RequestCoveragess->save(); 
          // }
    }

    public function GetPerilsCoverageUsingTxtBox($id)
    {
    
      $PassData   = explode(';;' ,$id);
       $ResultTaripa =  ProductLinesPerilsTaripa::select('*')
                      ->where('SubLinesNo', trim($PassData[0]))
                      ->where('CoverageAmount', round($PassData[1]))
                      ->where('PerilsNo', trim($PassData[2]))
                      //->groupBy('CoverageAmount')
                      //->orWhere('CoverageAmount',0)
                      ->first();
        $Taripa = array();
              $Taripa[] = [
                 '_id'                      => $ResultTaripa->_id,
                 'TaripaNo'                 => $ResultTaripa->TaripaNo,
                 'SubLinesNo'               => $ResultTaripa->SubLinesNo,
                 'PerilsNo'                 => $ResultTaripa->PerilsNo,
                 'CoverageAmount'           => $ResultTaripa->CoverageAmount,
                 'PremiumAmount'            => $ResultTaripa->PremiumAmount,
                 'PerilsName'               => $ResultTaripa->PerilsName,
              
                  
              ];
              return response()->json($Taripa);	
    }

    public function UpdatePersonalDetails(Request $request)
    {
        
              if ( $request['QuoteExpiryStatus'] === 2  ){
                $QuoteExpiryStatus  = 0 ;
                $QuoteExpiryRemarks = 'Re-quote';
              }else{
                $QuoteExpiryStatus  = $request['QuoteExpiryStatus'] ;
                $QuoteExpiryRemarks = ' ';
              }

              $RequestDetails      = RequestDetails::where('RequestNo',trim($request['RequestNoPass']))->first(); 

              $RequestDetails->FirstName              = $request['FirstName'];
              $RequestDetails->MiddleName             = $request['MiddleName'];
              $RequestDetails->LastName               = $request['LastName'];
              $RequestDetails->Address                = $request['Address'];
              $RequestDetails->CName                  = $request['FirstName'] . " " .  $request['MiddleName'] . " " . $request['LastName'];
              $RequestDetails->Barangay               = $request['Barangay'];
              $RequestDetails->City               	  = $request['City'];
              $RequestDetails->TINNumber              = $request['TINNumber'];
              $RequestDetails->EmailAddress           = $request['EmailAddress'];
              $RequestDetails->ContactNumber          = $request['ContactNumber'];
              $RequestDetails->AmountDue              = 0.00;
              $RequestDetails->PremiumAmount          = 0.00;
              $RequestDetails->TotalCharges           = 0.00;
              $RequestDetails->QuoteExpiryStatus      = $QuoteExpiryStatus;
              $RequestDetails->QuoteExpiryRemarks      = $QuoteExpiryRemarks;
             $RequestDetails->save();
   
	
    }


    public function UpdateMotorDetails(Request $request)
    {
        
            $POAmount                   =   $request['DepreciativeAmountPass'] ;
            $DepreciativeNumberYear     =   $request['DepreciativeNumberYear'] ;
            //$DenominationPass           =   $request['DenominationPass'] ;
            $Denomination               = explode(';;' ,$request['DenominationPass']);

            if(!empty($request['DenominationPass']) ){
                $RequestDetails      = RequestDetails::where('RequestNo',trim($request['RequestNoPass']))->first();
                $RequestDetails->Denomination                 = $Denomination[0];
                $RequestDetails->SubLinesName                 = $Denomination[1];
                $RequestDetails->save();
            }

            if(!empty($request['YearPO']) ){
              $RequestDetails      = RequestDetails::where('RequestNo',trim($request['RequestNoPass']))->first();
              $RequestDetails->MotorPOAmount                = $request['MotorPOAmount'];
              $RequestDetails->CoverageAmount               = round($POAmount, 2) ; ///depreciative amount
              $RequestDetails->DepreciativeAmount           = round($POAmount, 2) ; ///depreciative amount
              $RequestDetails->MotorYear                    = $request['YearPO'];
              $RequestDetails->save();
          }
            
              $RequestDetails                               = RequestDetails::where('RequestNo',trim($request['RequestNoPass']))->first();
              $RequestDetails->MotorPOAmount                = round($request['MotorPOAmount'], 2);
              $RequestDetails->MotorBrand                   = $request['MotorBrand'];
              $RequestDetails->MotorModel                   = $request['MotorModel'];
              $RequestDetails->MotorBodyType                = $request['MotorType'];
              $RequestDetails->MotorUsage                   = $request['OptSurcharge'];
              $RequestDetails->save();
   
	
    }





    public function UpdateQuotationOption(Request $request)
    {
        
			  $ToSavedID     = $request['ToSavedCoverageID']; 	
				  for($k=0 ;$k < count($ToSavedID )  ;$k++)
          {  
				    $IDid   =  trim($request['ToSavedCoverageID'][$k]); 
            $RequestCoveragess   = RequestCoverages::where('_id',$IDid)->first(); 
         
                  $RequestCoveragess->CoveragesAmount    		 = $request['ToSavedCoverageAmount'][$k];
                  $RequestCoveragess->CoveragesPremium   		 = $request['ToSavedCoveragePremium'][$k];
					        $RequestCoveragess->TotalPremium       		 = $request['ToSavedTotalPremium'][$k];
                  $RequestCoveragess->CoverageRates          = $request['ToSavedCoveragesRate'][$k]; 
				        	$RequestCoveragess->TotalCoverages         = $request['ToSavedTotalCoverages'][$k];
				        	$RequestCoveragess->save();


          }
		  //Coveragess AOG-----------------
				$ToSavedIDAOG     = $request['ToSavedWithAOGID']; 
		  	  for($k1=0 ;$k1 < count($ToSavedIDAOG )  ;$k1++)
			{  
				$IDidAOG   =  trim($request['ToSavedWithAOGID'][$k1]); 
         $RequestCoveragess1   = RequestCoverages::where('_id',$IDidAOG)->where('PerilsCode',"AOG")->first();
        
                  $WithAOGPremium     	=  $RequestCoveragess1->CoveragesPremium;
                  $WithAOGCoverages   	=  $RequestCoveragess1->CoveragesAmount;
				          $NoAOGCoveragesTotal  =  $RequestCoveragess1->TotalCoverages  -  $RequestCoveragess1->CoveragesAmount; 
				          $NoAOGPremiumTotal 	  =  $RequestCoveragess1->TotalPremium    -  $RequestCoveragess1->CoveragesPremium;
                 
                 //----update array
                  $RequestCoveragessUpdate    = RequestCoverages::where('RequestNo',$RequestCoveragess1->RequestNo)->where('OptionNo',$RequestCoveragess1->OptionNo)->update([
                    'WithAOGPremium'        => round($WithAOGPremium,2),
                    'WithAOGCoverages'      => round($WithAOGCoverages,2) , 
                    'NoAOGCoveragesTotal'   => round($NoAOGCoveragesTotal,2) , 
                    'NoAOGPremiumTotal'     => round($NoAOGPremiumTotal,2) ,  // Add as many as you need
                ]);
               
                
				  
		  $FindProductLineCharge1  = ProductLinesCharges::select('*')->where('ProductLine','2019-MC-0001')->where('Active','1')->get();
        
              $CompCharges1=0;
              foreach($FindProductLineCharge1 as $FindProductLineChargess)
              { 
			    $RequestCoveragess11   = RequestCoverages::where('_id',$IDidAOG)->where('PerilsCode',"AOG")->first();
                  if ( trim($FindProductLineChargess->ChargesType) === 'Percent'){
                     
                        //-------Doc Stamp Comp-------------------->
                          if ( trim($FindProductLineChargess->ChargesNo) === '2019-DP-0001'){
                            $Newvalue = $FindProductLineChargess->ChargesAmount  * $RequestCoveragess11->NoAOGPremiumTotal ;
                            $value =  round($Newvalue, 2);
                            $numpart = explode(".",$value); 
                                if(is_float($value)){
                                      if ($numpart[1] < 51){
                                      //    it's a decimal that is greater than zero
                                      $CompChargesAmount1   = $numpart[0]. '.'. 50;
                                        // echo "Less 50=== " . $NewValue;
                                      }else{
                                      // its not a decimal, or the decimal is zero
                                      $CompChargesAmount1   = $numpart[0] +  1;
                                      //echo "Greather 50=== " . $NewValue;
                                      }
                                }else{
                                  $CompChargesAmount1   = $value;
                                }
                        }else{
                          $CompChargesAmount1 =  $FindProductLineChargess->ChargesAmount * $RequestCoveragess11->NoAOGPremiumTotal ; 
                        }  
                      
      
                  }else{
                          $CompChargesAmount1 =  $FindProductLineChargess->ChargesAmount ;  
                  }
                
                
                  $UpdateCharges2    = RequestCharges::where('RequestNo',trim($request['RequestNoPass']))->where('OptionNo',$RequestCoveragess1->OptionNo)->where('ChargesNo',$FindProductLineChargess->ChargesNo)->get();
                  foreach($UpdateCharges2 as $UpdateCharges22){ 
                        $UpdateCharges22->ChargesPremiumAOG           = $CompChargesAmount1;
						            //$UpdateCharges22->TotalChargesAOG             = $CompCharges1;
                        $UpdateCharges22->save();
                        $CompCharges1 += $CompChargesAmount1; 
                }


                
                $UpdateCharges21    = RequestCharges::where('RequestNo',trim($request['RequestNoPass']))->where('OptionNo',$RequestCoveragess1->OptionNo)->get();
                foreach($UpdateCharges21 as $UpdateCharges22){ 
                     // $UpdateCharges22->ChargesPremiumAOG           = $CompChargesAmount1;
                      $UpdateCharges22->TotalChargesAOG             = $CompCharges1;
                      $UpdateCharges22->save();
                }
							
               }  
				  
			}


			$ToSavedIDODTF     = $request['ToSavedWithTFID']; 
		  	  for($k2=0 ;$k2 < count($ToSavedIDODTF  )  ;$k2++)
			{  
				$IDidTF  =  trim($request['ToSavedWithTFID'][$k2]); 
				$IDidOD  =  trim($request['ToSavedWithODID'][$k2]); 
              $RequestCoveragesOD    = RequestCoverages::where('_id',$IDidOD)->where('PerilsCode','OD')->first();
              $RequestCoveragesTF    = RequestCoverages::where('_id',$IDidTF)->where('PerilsCode','TF')->first();
              $CAmountODTF   = $RequestCoveragesOD->CoveragesAmount   +  $RequestCoveragesTF->CoveragesAmount;
              $PAmountODTF   = $RequestCoveragesOD->CoveragesPremium  +  $RequestCoveragesTF->CoveragesPremium; 
                
              $RequestCoveragesOD->CAmountODTF            = round($CAmountODTF,2)  ;
              $RequestCoveragesOD->PAmountODTF            = round($PAmountODTF,2)  ;
              $RequestCoveragesOD->save(); 

              $RequestCoveragesTF->CAmountODTF            =  round($CAmountODTF,2)  ;
              $RequestCoveragesTF->PAmountODTF            = round($PAmountODTF,2)  ;
              $RequestCoveragesTF->save(); 	

			 //Deductable
                    //$GetDenomination     = RequestDetails::where('RequestNo',$id)->first();
                   $GetDenominationExplode  =  explode('-' ,$request['Denomination']);

                    if (trim($request['Denomination']) === "2019-PC-0001" ) {
                      $FindDefaultDeductible     = DefaultData::where('DefaultDataNo','2019-DE-0004')->first(); //0.005

                      $PAmountODTF1  = $CAmountODTF;
                      }else if (trim($request['Denomination']) === "2019-PC-0002" ) {
                      $FindDefaultDeductible     = DefaultData::where('DefaultDataNo','2019-DE-0005')->first(); //0.01
                      $PAmountODTF1  = $CAmountODTF;
                      }else if (trim($GetDenominationExplode[1] ) === "CV"   ) {
                      $FindDefaultDeductible     = DefaultData::where('DefaultDataNo','2019-CV-0006')->first(); //0.01
                      $PAmountODTF1  = $CAmountODTF;
                      }else if (trim($GetDenominationExplode[1] ) === "MC"   ) {
                      $FindDefaultDeductible     = DefaultData::where('DefaultDataNo','2019-MC-0007')->first();
                      $PAmountODTF1  = 1;
                    }

                    if (trim($RequestCoveragesOD->PerilsCode) === "OD" || trim($RequestCoveragesTF->PerilsCode) === "TF") {
                   // if (   $GetDenomination->WithAOG !== "YES" ) {
                      $Deductable =  $PAmountODTF1  * $FindDefaultDeductible->Amount; 
                      if ($Deductable < $FindDefaultDeductible->MinAmount){  //less than the declare amount
                          $DeductableNew             =  $FindDefaultDeductible->MinAmount;
                      }else{
                          $DeductableNew =  $Deductable;
                      }
                    }else{
                        $DeductableNew =  $FindDefaultDeductible->MinAmount ;

                    } 
							
                    $CoveragesDeductible   = RequestCoverages::where('RequestNo',trim($request['RequestNoPass']))->where('OptionNo',$RequestCoveragesOD->OptionNo)->get();
                    foreach($CoveragesDeductible as $CoveragesDeductibles){ 
                        $CoveragesDeductibles->Deductible           = round($DeductableNew , 2);
                        $CoveragesDeductibles->save(); 
                    }		
					
			}
		  //Charges-----------------
		  
		    $ToSavedChargesID     = $request['ToSavedChargesID']; 	
				  for($kk=0 ;$kk < count($ToSavedChargesID )  ;$kk++)
          {  
				$IDCharges   =  trim($request['ToSavedChargesID'][$kk]); 
				$RequestCharges   = RequestCharges::where('_id',$IDCharges)->first(); 
         
                      $RequestCharges->TotalAmountDue    		    = $request['ToSavedTotalAmountDue'][$kk];
                      $RequestCharges->TotalCharges   	 	 		  = $request['ToSavedTotalCharge'][$kk];
					            $RequestCharges->ChargesPremium       		= $request['ToSavedChargesPremium'][$kk];
				 	            $RequestCharges->save();
          }
		  
		 
      //return response()->json(['success' => $PassCoverageAmount], 200); 
      

              
            //   if ( $request['QuoteExpiryStatus'] === 2  ){
            //     $QuoteExpiryStatus  = 0 ;
            //     $QuoteExpiryRemarks = 'Re-quote';
            //   }else{
            //     $QuoteExpiryStatus  = $request['QuoteExpiryStatus'] ;
            //     $QuoteExpiryRemarks = ' ';
            //   }

            //   $RequestDetails      = RequestDetails::where('RequestNo',trim($request['RequestNoPass']))->first(); 

            //   $RequestDetails->FirstName              = $request['FirstName'];
            //   $RequestDetails->MiddleName             = $request['MiddleName'];
            //   $RequestDetails->LastName               = $request['LastName'];
            //   $RequestDetails->Address                = $request['Address'];
            //   $RequestDetails->Barangay               = $request['Barangay'];
            //   $RequestDetails->City               	   = $request['City'];
            //   $RequestDetails->TINNumber              = $request['TINNumber'];
            //   $RequestDetails->EmailAddress           = $request['EmailAddress'];
            //   $RequestDetails->ContactNumber          = $request['ContactNumber'];
            //   $RequestDetails->AmountDue              = 0.00;
            //   $RequestDetails->PremiumAmount          = 0.00;
            //   $RequestDetails->TotalCharges           = 0.00;
            //           //$RequestDetails->MotorUsage             = 0.00;
            //   $RequestDetails->QuoteExpiryStatus      = $QuoteExpiryStatus;
            //   $RequestDetails->QuoteExpiryRemarks      = $QuoteExpiryRemarks;
                      
            // $RequestDetails->save();
   
	
    }

    public function SubmitNewCoveragesOption(Request $request)
    {
      date_default_timezone_set('Asia/Hong_Kong');
      $curYear = date('Y'); 
      $CountUser = RequestDetails::count() + 1;
      $NewCountUser = str_pad($CountUser, 4, '0' , STR_PAD_LEFT); 
      $AccountNo =  $curYear. "-".$NewCountUser;
      //-------Depreciative ------------------------------------------
          $POAmount                   =   $request['CoverageAmount'] ;
          $PassData                   =  $request['RequestNoPass']; 
          $FindDefaultDataAmount      =  DefaultData::where('DefaultDataNo','2019-RE-0001')->first();
          $RatePercentage             =  round($FindDefaultDataAmount->Amount,2);
          $TotalComputationPremium    = 0 ; 
          $Option                      =  $request['RequestNoOptionNo'] + 1 ;
          $MaxTaripaAmount            = 1000000;
          $totalPerilsName1           = $request['ToSavedGetPerils']; 
          $Denomination               = explode(';;' ,$request['Denomination']);
          for($P=0 ;$P < count($totalPerilsName1)  ;$P++)   //loop value of perilsname
          {  
             
             ///------------Premium  COmputation Commercial 
             $PerilsNo                = explode('-' ,$request['ToSavedGetPerils'][$P]);
             $PerilsName              = $request['ToSavedGetPerils'][$P];
            
                $FindSurcharge            = DefaultData::where('DefaultDataNo','2019-SE-0012')->first();
             if (trim($PerilsNo[1]) === "XBI" || trim($PerilsNo[1]) === "PD"  ) {
                      $DefaultPremiumAmount            = ProductLinesPerilsTaripa::select('*')->where('CoverageAmount','>=',round($POAmount))->orWhere('CoverageAmount',round($MaxTaripaAmount ))->where('PerilsNo',$PerilsName)->where('SubLinesNo',trim($Denomination[0]))->first();
                      if ( trim($request['OptSurcharge']) === "Commercial Use"){   ///for Commercial
                            $ComputationPremium       =    round($DefaultPremiumAmount->PremiumAmount * $FindSurcharge->Amount, 2) ;
                            $PremiumAmount            =    round($DefaultPremiumAmount->PremiumAmount, 2) ;
                            $Surcharge                =    round($FindSurcharge->Amount, 2) ;
                     
    
                      }else{
                              $ComputationPremium     =    round($DefaultPremiumAmount->PremiumAmount , 2) ;
                              $PremiumAmount          =    round($DefaultPremiumAmount->PremiumAmount, 2) ;
                              $Surcharge              =    0.00;
                              
                      } 
                      $PerilsNameSave                 = $DefaultPremiumAmount->PerilsName ;
                      $Section                        =  "IV" ;
                      $CoverageAmountSave             = $DefaultPremiumAmount->CoverageAmount;
                      $CoveragesName                  = $DefaultPremiumAmount->PerilsNo;
                      $DenominationType               =  $DefaultPremiumAmount->SubLinesNo;
          }else{    ///CTPL ---OD/TF---AOG
                    $DefaultPremiumAmount     = DefaultData::select('*')->where('LinesNo',trim($Denomination[0]))->where('PerilsClass',$PerilsName)->where('Converter',"PremiumComp")->where('Active',"1")->first();
                    
                                
                        if ( trim($request['OptSurcharge']) === "Commercial Use"){   ///for Commercial
                              if (trim($PerilsNo[1]) === "PA" ) {
                                $ComputationPremium      =    ($POAmount *  $DefaultPremiumAmount->Amount )* $FindSurcharge->Amount ;
                            
                              }else{
                                $ComputeFormula             = $POAmount . $DefaultPremiumAmount->Formula ;
                                $ComputationPremium        =  eval('return '.$ComputeFormula.';');
                                $PremiumAmount              = $DefaultPremiumAmount->CompPremium;  // round($DefaultPremiumAmount->Amount , 2) ;
                                $Surcharge                  =  round($DefaultPremiumAmount->Surcharge, 2) ;
                              } 
                        }else{
                         
                                $ComputeFormula             = $POAmount . $DefaultPremiumAmount->Formula ;
                                $ComputationPremium        =  eval('return '.$ComputeFormula.';');
                                $PremiumAmount              = $DefaultPremiumAmount->CompPremium;  // round($DefaultPremiumAmount->Amount , 2) ;
                                $Surcharge                  =  round($DefaultPremiumAmount->Surcharge, 2) ;
                           // return response()->json(['success' =>    $DefaultPremiumAmount->Formula  ], 200); 
                            
                        }
                        if (trim($PerilsNo[1]) === "CT" ) {
                           $CoverageAmountSave          =  100000;
                        }else{
                          $CoverageAmountSave          =  $POAmount;
                        }
                      $PerilsNameSave              =  $DefaultPremiumAmount->PerilsName ;
                      $Section                     =  $DefaultPremiumAmount->Section ;
                      $CoveragesName               =  $DefaultPremiumAmount->PerilsClass; 
                      $DenominationType            =  $DefaultPremiumAmount->LinesNo;
                      $PerilsDescription           = str_replace("4",$request['passengers'], trim($DefaultPremiumAmount->Description));
                  
             }
             //return response()->json(['success' => $FindCoveragess  ], 200); 
             $TotalComputationPremium     += $ComputationPremium;
    
                $RequestCoverages = new RequestCoverages;
                
                  $RequestCoverages->RequestNo               = $PassData ;
                  $RequestCoverages->CoveragesName           =  $CoveragesName ; //$request['PerilsName'][$P];
                  $RequestCoverages->PerilsName              =  $PerilsNameSave ; //$ProductLinesPerils->PerilsName ;
                  $RequestCoverages->PerilsCode              = trim($PerilsNo[1]) ;
                  $RequestCoverages->Description             = $PerilsDescription;
                  $RequestCoverages->CoveragesAmount         = $CoverageAmountSave;
                  $RequestCoverages->DepreciativeAmount      = round( $POAmount , 2) ;
                  $RequestCoverages->Surcharge               = round( $Surcharge , 2) ;
                  $RequestCoverages->CoveragesPremium        = round( $ComputationPremium , 2) ;
                  $RequestCoverages->PremiumAmount           = round($PremiumAmount, 2);
                //  $RequestCoverages->TotalPremiumAmount      = round( $TotalComputationPremium , 2);
                  $RequestCoverages->OptionNo                = $Option ;
                  $RequestCoverages->Active                  = '1' ;
                  $RequestCoverages->Status                  = 1;
                  // $RequestCoverages->Sort                    = $SortPerilsName[2];
                  $RequestCoverages->CoverageRates           = $RatePercentage;
                   $RequestCoverages->DenominationType        = $DenominationType ;
                  $RequestCoverages->Section                 =  $Section;//$ProductLinesPerils->Section ;
                  $RequestCoverages->RequestModifyCoverages  = 0 ;
                  $RequestCoverages->RequestModify           = 0 ;
                  $RequestCoverages->PAmountODTF             = 0;
                  $RequestCoverages->CAmountODTF             = 0 ;
                  $RequestCoverages->UpdateRequest          = 1;   
                  $RequestCoverages->save();
    
          }   ///close for Loop Coverages
          
           $GetRequestDetails   = RequestDetails::where('RequestNo',$PassData)->first();  ///update WithAOG used in the Condition w/ AOG
           $GetRequestDetails->WithAOG     = 'YES' ;   //default YES when ADD new Option because it's include always the AOG
           $GetRequestDetails->save(); 

          $RequestCoverages   = RequestCoverages::where('RequestNo',trim($PassData))->where('OptionNo',$Option)->get();
          $TotalPremium = 0;  $TotalCoverages = 0; 
         foreach($RequestCoverages as $RequestCoveragess){ 
                   $TotalCoverages    += $RequestCoveragess->CoveragesAmount;
                   $TotalPremium      += $RequestCoveragess->CoveragesPremium;
     
          
           if ( $RequestCoveragess->PerilsCode == 'AOG'  ){   
                 $WithAOGPremium     =  $RequestCoveragess->CoveragesPremium;
                 $WithAOGCoverages   =  $RequestCoveragess->CoveragesAmount;
                 $WithAOG = "YES";
           }else{
                 $WithAOGPremium     =  0.00;
                 $WithAOGCoverages   =  0.00;
                 $WithAOG = "NO";
           }      
                   $RequestCoveragess->WithAOGPremium         = $WithAOGPremium ;
                   $RequestCoveragess->WithAOGCoverages       = $WithAOGCoverages ;
                   $RequestCoveragess->WithAOG                = $WithAOG ;
                  // $RequestCoveragess->TotalPremium           = $TotalPremium ;
                  // $RequestCoveragess->TotalCoverages         = $TotalCoverages ;
                   $RequestCoveragess->save(); 
         }

        //  $SaveTotal    = RequestCoverages::where('RequestNo',trim($PassData))->where('OptionNo',$Option)->get();
     
        //  foreach($SaveTotal as $SaveTotals){ 
         
        //    $SaveTotals->TotalPremium           = $TotalPremium ;
        //    $SaveTotals->TotalCoverages         = $TotalCoverages ;
        //    $SaveTotals->save(); 
        // }


         $RequestCoveragesUpdate1    = RequestCoverages::where('RequestNo',trim($PassData))->where('OptionNo',$Option)->get();
         $RequestCoveragesAOG1       = RequestCoverages::where('RequestNo',trim($PassData))->where('OptionNo',$Option)->where('PerilsCode','AOG')->first();
        
         foreach($RequestCoveragesUpdate1 as $RequestCoveragesUpdate){ 
            
              // if ( $RequestCoveragesUpdate->PerilsCode == 'AOG'){
                  $NoAOGPremiumTotal     =     $TotalPremium      -  $RequestCoveragesAOG1->CoveragesPremium;
                  $NoAOGCoveragesTotal   =     $TotalCoverages    -  $RequestCoveragesAOG1->CoveragesAmount;
            
            
               $RequestCoveragesUpdate->NoAOGPremiumTotal      = $NoAOGPremiumTotal  ;
               $RequestCoveragesUpdate->NoAOGCoveragesTotal    = $NoAOGCoveragesTotal ;
              $RequestCoveragesUpdate->TotalPremium           = $TotalPremium ;
             $RequestCoveragesUpdate->TotalCoverages         = $TotalCoverages ;
               $RequestCoveragesUpdate->save(); 
         }
     
         $RequestCoveragesOD    = RequestCoverages::where('RequestNo',trim($PassData))->where('OptionNo',$Option)->where('PerilsCode','OD')->first();
         $RequestCoveragesTF    = RequestCoverages::where('RequestNo',trim($PassData))->where('OptionNo',$Option)->where('PerilsCode','TF')->first();
         $CAmountODTF           = $RequestCoveragesOD->CoveragesAmount +  $RequestCoveragesTF->CoveragesAmount;
         $PAmountODTF           = $RequestCoveragesOD->CoveragesPremium +  $RequestCoveragesTF->CoveragesPremium; 
           
         $RequestCoveragesOD->CAmountODTF            = $CAmountODTF ;
         $RequestCoveragesOD->PAmountODTF            = $PAmountODTF ;
         $RequestCoveragesOD->save(); 
     
         $RequestCoveragesTF->CAmountODTF            = $CAmountODTF ;
         $RequestCoveragesTF->PAmountODTF            = $PAmountODTF ;
         $RequestCoveragesTF->save(); 
     
             //Deductable
             $GetDenomination     = RequestDetails::where('RequestNo',$PassData)->first();
             $GetDenominationExplode  =  explode('-' ,$GetDenomination->Denomination);
     
             if (trim($GetDenomination->Denomination) === "2019-PC-0001" ) {
                   $FindDefaultDeductible     = DefaultData::where('DefaultDataNo','2019-DE-0004')->first();
                   //$MinAmount  = $FindDefaultDeductible->MinAmount;
                   $PAmountODTF1  = $CAmountODTF;
               }else if (trim($GetDenomination->Denomination) === "2019-PC-0002" ) {
                   $FindDefaultDeductible     = DefaultData::where('DefaultDataNo','2019-DE-0005')->first();
                   $PAmountODTF1  = $CAmountODTF;
             }else if (strpos($GetDenomination->Denomination, 'CV') !== false   ) {
                 $FindDefaultDeductible     = DefaultData::where('DefaultDataNo','2019-CV-0006')->first();
                 $PAmountODTF1  = $CAmountODTF;
             }else if (strpos($GetDenomination->Denomination, 'MC') !== false   ) {
               $FindDefaultDeductible     = DefaultData::where('DefaultDataNo','2019-MC-0007')->first();
               $PAmountODTF1  = 1;
           }
     
     
               if (trim($RequestCoveragesOD->PerilsCode) === "OD" || trim($RequestCoveragesTF->PerilsCode) === "TF") {
                       $Deductable =  $PAmountODTF1  * $FindDefaultDeductible->Amount; 
                       if ($Deductable < $FindDefaultDeductible->MinAmount){  //less than the declare amount
                           $DeductableNew             =  $FindDefaultDeductible->MinAmount;
                       }else{
                           $DeductableNew =  $PAmountODTF1  * $FindDefaultDeductible->Amount;
                       }
               }else{
                     $DeductableNew =  $FindDefaultDeductible->MinAmount;
     
             } 
             $TowingLimit   = DefaultData::where('DefaultDataNo','2019-TL-0013')->first();
             $CoveragesDeductible   = RequestCoverages::where('RequestNo',trim($PassData))->where('OptionNo',$Option)->get();
               foreach($CoveragesDeductible as $CoveragesDeductibles){ 
                         $CoveragesDeductibles->Deductible           = round($DeductableNew , 2);
                         $CoveragesDeductibles->TowingLimit          = round($TowingLimit->Amount, 2);
                         $CoveragesDeductibles->save(); 
               }
     



          //-------Charges------Charges-----Charges-----Charges------->
          $FindProductLineCharge  = ProductLinesCharges::select('*')->where('ProductLine','2019-MC-0001')->where('Active','1')->get();
          
          $CompCharges=0;  $CompCharges1=0;
          foreach($FindProductLineCharge as $FindProductLineCharges)
          { 
              //-------Doc Stamp Comp-------------------->
        if ( trim($FindProductLineCharges->ChargesType) === 'Percent'){
                 if ( trim($FindProductLineCharges->ChargesNo) === '2019-DP-0001'){
                
                                  $val 		      = $FindProductLineCharges->ChargesAmount  * $TotalComputationPremium ;
                                  $num 		      = round($val,2);
                                  $StringVal 	  = strval($num );
                                  $int 		      = (int)$num;
                                  $float 		    = (float)$num;
                                  $Value51      = 50; 
    
                                if(is_float($num)){
                                    $numpart    = explode(".",$StringVal);  
                                    if( empty($numpart[1]) ){
                                          $CompChargesAmount   = $num ;
                                    }else{
                                        $Val 		= round($numpart[1],2);
                                        if (  $Val <= $Value51){
                                          $CompChargesAmount   = $int . '.'. 50;
                                        }else{
                                        
                                          $CompChargesAmount   = $int +  1;
                                        }
                                    }
                                }
              }else{
                $CompChargesAmount =  $FindProductLineCharges->ChargesAmount * $TotalComputationPremium  ; 
              }  
    
    
      }else{
    
        $RequestCoveragesPA     = RequestCoverages::where('RequestNo',$PassData)->where('PerilsCode','CT')->first();
                    if ( trim($FindProductLineCharges->ChargesNo) === '2019-CC-0005'){ //DOC.Stamp 2019-CC-0005
                          if ( !empty($RequestCoveragesPA->PerilsCode)){
                                  $CompChargesAmount =  $FindProductLineCharges->ChargesAmount ;  
                            }else{
                                  $CompChargesAmount = 0.00;
                            }
                    }else{
                          $CompChargesAmount =  $FindProductLineCharges->ChargesAmount ;  
                    }
      }
          
              $CompCharges += $CompChargesAmount;
                $CountCharges      = RequestCharges::count() + 1;
                $RequestCharge = new RequestCharges;
                    $RequestCharge->ChargesNo             = $CountCharges;
                    $RequestCharge->RequestNo             = $PassData ;
                    $RequestCharge->ChargesName           = $FindProductLineCharges->ChargesName ;
                    $RequestCharge->ChargesAmount         = $FindProductLineCharges->ChargesAmount ;
                    $RequestCharge->ChargesPremium        =  round($CompChargesAmount , 2);
                    $RequestCharge->ChargesType           = $FindProductLineCharges->ChargesType ;
                    $RequestCharge->ChargesNo             = $FindProductLineCharges->ChargesNo ;
                    $RequestCharge->OptionNo              =  $Option ;
                    $RequestCharge->TotalCharges          =  round($CompCharges , 2);
                    $RequestCharge->Active                ='1';
                    $RequestCharge->Status                = 1 ;
                    $RequestCharge->UpdateRequest          = 1;
                    $RequestCharge->save();
              
      }    //close for Loop CHARGES
      $CompAmount   =   $TotalComputationPremium +  $CompCharges;  

      $UpdateCharges    = RequestCharges::where('RequestNo',$PassData)->where('OptionNo',$Option)->get();
      foreach($UpdateCharges as $UpdateCharges1){ 
              $UpdateCharges1->TotalCharges            =  round($CompCharges , 2);
              $UpdateCharges1->TotalAmountDue          =  round($CompAmount , 2);
              $UpdateCharges1->save();
      }

      
   $RequestCoveragesAOG    = RequestCoverages::where('RequestNo',trim($PassData))->where('OptionNo',$Option)->where('PerilsCode','AOG')->first();
         
	 $FindProductLineCharge1  = ProductLinesCharges::select('*')->where('ProductLine','2019-MC-0001')->where('Active','1')->get();
      
            
              foreach($FindProductLineCharge1 as $FindProductLineChargess)
              { 
                  if ( trim($FindProductLineChargess->ChargesType) === 'Percent'){
                     
                        //-------Doc Stamp Comp-------------------->
                        if ( trim($FindProductLineCharges->ChargesNo) === '2019-DP-0001'){
                
                          $val 		      = $FindProductLineCharges->ChargesAmount  * $RequestCoveragesAOG->NoAOGPremiumTotal ;
                          $num 		      = round($val,2);
                          $StringVal 	  = strval($num );
                          $int 		      = (int)$num;
                          $float 		    = (float)$num;
                          $Value51      = 50; 

                        if(is_float($num)){
                            $numpart    = explode(".",$StringVal);  
                            if( empty($numpart[1]) ){
                                  $CompChargesAmount1   = $num ;
                            }else{
                                $Val 		= round($numpart[1],2);
                                if (  $Val <= $Value51){
                                  $CompChargesAmount1   = $int . '.'. 50;
                                }else{
                                
                                  $CompChargesAmount1   = $int +  1;
                                }
                            }
                        }
                  }else{
                    $CompChargesAmount1 =  $FindProductLineCharges->ChargesAmount * $RequestCoveragesAOG->NoAOGPremiumTotal  ; 
                  }  
                      
      
                  }else{
                          $CompChargesAmount1 =  $FindProductLineChargess->ChargesAmount ;  
                  }
                
                  $CompCharges1 += $CompChargesAmount1;  
                  $UpdateCharges2    = RequestCharges::where('RequestNo',trim($PassData))->where('OptionNo',$Option)->where('ChargesNo',$FindProductLineChargess->ChargesNo)->get();
                  foreach($UpdateCharges2 as $UpdateCharges22){ 
                        $UpdateCharges22->ChargesPremiumAOG             = $CompChargesAmount1;
                        $UpdateCharges22->TotalChargesAOG               = $CompCharges1;
                        $UpdateCharges22->save();
                  
                } 
             
          }  

         // $CompCharges1 += $CompChargesAmount1; 
          
          $UpdateCharges2    = RequestCharges::where('RequestNo',trim($PassData))->where('OptionNo',$Option)->get();
          foreach($UpdateCharges2 as $UpdateCharges22){ 
                //$UpdateCharges22->ChargesPremiumAOG             = $CompChargesAmount;
                $UpdateCharges22->TotalChargesAOG               = $CompCharges1;
                $UpdateCharges22->save();
          
        }  


    
    //-------RequestDetails------RequestDetails-----RequestDetails-----RequestDetails------->
     
            
    }

    public function SubmitNewCoveragesOption1(Request $request)
    {
      
      $FindDefaultDataAmount     =  DefaultData::where('DefaultDataNo','2019-CT-0003')->first();
      $FindDefaultRate           =  DefaultData::where('DefaultDataNo','2019-RE-0001')->first();

      $PassData       =  $request['RequestNoPass']; //explode(';;' ,$id);
      $Denomination   =  $request['Denomination'];  //$PassData[1];   
      $Option         =  $request['RequestNoOptionNo'] + 1 ;
      $POAmount       =  $FindDefaultDataAmount->Amount; 
      $AOGFormula     = 0.005;   
      
      $RatePercentage = $FindDefaultRate->Amount;

     $ArrayPerilsName =   $request['ToSavedGetPerils'] ;
      //-------Request Coverages------Request Coverages-----Request Coverages-----Request Coverages--- LinesNo---->
      $ComputationPremium = 0 ; 
      for($k=0 ;$k < count($ArrayPerilsName)  ;$k++)
        { 
     
      
   
        $CountCoverages = RequestCoverages::count() + 1;
        $PerilsNo       = $ArrayPerilsName[$k]; //trim($request['PerilsName'][$k]);
      
        $ExplodePerilsNo = explode('-' ,$PerilsNo);
        
       
                         
        $PerilsTaripa             = ProductLinesPerilsTaripa::select('*')->where('CoverageAmount','>=',round($POAmount))->where('PerilsNo',trim($PerilsNo))->where('SubLinesNo',trim($Denomination))->first();
        $DefaultPremiumAmount     = DefaultData::select('*')->where('LinesNo',trim($Denomination))->where('PerilsClass',trim($PerilsNo))->where('Converter',"PremiumComp")->where('Active',"1")->first();
        $RequestDetails = RequestDetails::select('*')->where('Active', '1')->where('RequestNo',$PassData )->first();
         
        $FindSurcharge  = DefaultData::where('DefaultDataNo','2019-SE-0012')->first();
                  if ( trim( $RequestDetails->MotorUsage) === "Commercial Use"){
                       if (trim($ExplodePerilsNo[1]) === "PA" ) {
                            $CompPremium      =   ($POAmount *  $DefaultPremiumAmount->Amount ) * $FindSurcharge->Amount ;
                            $PremiumAmount    =   $DefaultPremiumAmount->Amount ;
                            $Surcharge        =   $FindSurcharge->Amount;
                      }if (trim($ExplodePerilsNo[1]) === "XBI"  || trim($ExplodePerilsNo[1]) === "PD"  ) {
                            $CompPremium    =    $PerilsTaripa->PremiumAmount * $FindSurcharge->Amount;
                            $Surcharge      =    $FindSurcharge->Amount;
                            $PremiumAmount  =   $PerilsTaripa->PremiumAmount ;
                           
                        }

                  }else{
                          if (trim($ExplodePerilsNo[1]) === "PA" ) {
                            $CompPremium      =   $POAmount *  $DefaultPremiumAmount->Amount ;
                            $PremiumAmount    =   $DefaultPremiumAmount->Amount ;
                            $Surcharge        =   0.00;
                          }
                          if (trim($ExplodePerilsNo[1]) === "XBI"  || trim($ExplodePerilsNo[1]) === "PD"  ) {
                         
                            $CompPremium    =    $PerilsTaripa->PremiumAmount;
                            $Surcharge      =    0.00;
                            $PremiumAmount  =   $PerilsTaripa->PremiumAmount ;
                          
                        }
                  }

                //NO Surcharge  / not included in Computation in the 
                if (trim($ExplodePerilsNo[1]) === "OD" || trim($ExplodePerilsNo[1]) === "TF") {
                     $CompPremium      =  ( ( $RatePercentage * $RequestDetails->DepreciativeAmount) * $DefaultPremiumAmount->Amount );
                     $PremiumAmount    = $DefaultPremiumAmount->Amount ;
                     $Surcharge        = 0.00;
                    
                 }else if (trim($ExplodePerilsNo[1]) === "AOG" ) {
                     $CompPremium      =   $RequestDetails->DepreciativeAmount *  $DefaultPremiumAmount->Amount ;
                     $PremiumAmount    =   $DefaultPremiumAmount->Amount ;
                     $Surcharge        = 0.00;
                 }else if ( trim($ExplodePerilsNo[1]) === "CT") {
                     $CompPremium      = $DefaultPremiumAmount->Amount  ;
                     $PremiumAmount    = $DefaultPremiumAmount->Amount ;
                     $Surcharge        = 0.00;     
                 
                 }
             
                  $ProductLinesPerilss    = ProductLinesPerils::select('*')->where('Active',"1")->where('LinesNo',"2019-MC-0001")->where('PerilsNo',trim($ArrayPerilsName[$k]))->first();
      
                    if ( trim($ExplodePerilsNo[1]) == "CT"){
                        $CTPLDefaultAmount      = DefaultData::where('DefaultDataNo','2019-CT-0003')->first();
                        $CoverageAmountSave 	  =  $CTPLDefaultAmount->Amount;
                        $NumberPassenger        = $RequestDetails->Passengers;
                  }else if  (trim($ExplodePerilsNo[1]) === "OD" || trim($ExplodePerilsNo[1]) === "TF" || trim($ExplodePerilsNo[1]) === "AOG") {
                          $CoverageAmountSave     =  $RequestDetails->DepreciativeAmount;
                 }else if  (trim($ExplodePerilsNo[1]) === "PA"  || trim($ExplodePerilsNo[1]) === "XBI"  || trim($ExplodePerilsNo[1]) === "PD") {
                       $CoverageAmountSave     =  $POAmount ;
                 }
              
              $NumberPassenger        = 4 ;
                  
                    $PerilsDescription    = str_replace("4",$NumberPassenger , trim($ProductLinesPerilss->Description));
                   
                    $ComputationPremium += $CompPremium;
                  $RequestCoverages = new RequestCoverages;
                  $RequestCoverages->CoveragesNo             = $CountCoverages;
                  $RequestCoverages->RequestNo               = $PassData;
                  $RequestCoverages->CoveragesName           = $ProductLinesPerilss->PerilsNo;
                  $RequestCoverages->PerilsName              = $ProductLinesPerilss->PerilsName ;
                  $RequestCoverages->PerilsCode              = trim($ExplodePerilsNo[1]) ;
                  $RequestCoverages->Section                 = $ProductLinesPerilss->Section ;
				          $RequestCoverages->Description             = $PerilsDescription;
                  $RequestCoverages->CoveragesAmount         = $CoverageAmountSave;
                  $RequestCoverages->CoveragesPremium        = round( $CompPremium , 2) ;
                  $RequestCoverages->PremiumAmount           = round($PremiumAmount,2);
                  //$RequestCoverages->TotalPremiumAmount      = round( $ComputationPremium , 2);
                  $RequestCoverages->OptionNo                = $Option;
                  $RequestCoverages->Active                  = '1' ;
                  $RequestCoverages->Status                  = 1;
                 // $RequestCoverages->Sort                    = $SortPerilsName[2];
                  $RequestCoverages->CoverageRates           = $RatePercentage;
                  $RequestCoverages->DenominationType        = $RequestDetails->Denomination;
                  $RequestCoverages->RequestModifyCoverages  = $RequestDetails->RequestModify;
                  $RequestCoverages->RequestModify           = $RequestDetails->RequestModify;
                  $RequestCoverages->PAmountODTF             = 0;
                  $RequestCoverages->CAmountODTF             = 0 ;
                  $RequestCoverages->Deductible             = 0 ;
                  $RequestCoverages->save();
       
      }   


      $RequestCoverages   = RequestCoverages::where('RequestNo',trim($PassData))->where('OptionNo',$Option)->get();
      $TotalPremium = 0;  $TotalCoverages = 0; 
     foreach($RequestCoverages as $RequestCoveragess){ 
               $TotalCoverages    += $RequestCoveragess->CoveragesAmount;
               $TotalPremium      += $RequestCoveragess->CoveragesPremium;
 
      
       if ( $RequestCoveragess->PerilsCode == 'AOG'  ){   
             $WithAOGPremium     =  $RequestCoveragess->CoveragesPremium;
             $WithAOGCoverages   =  $RequestCoveragess->CoveragesAmount;
             $WithAOG = "YES";
       }else{
             $WithAOGPremium     =  0.00;
             $WithAOGCoverages   =  0.00;
             $WithAOG = "NO";
       }      
               $RequestCoveragess->WithAOGPremium         = $WithAOGPremium ;
               $RequestCoveragess->WithAOGCoverages       = $WithAOGCoverages ;
               $RequestCoveragess->WithAOG                = $WithAOG ;
               $RequestCoveragess->save(); 
 
              
     }
     $RequestCoveragesUpdate1    = RequestCoverages::where('RequestNo',trim($PassData))->where('OptionNo',$Option)->get();
     $RequestCoveragesAOG1       = RequestCoverages::where('RequestNo',trim($PassData))->where('OptionNo',$Option)->where('PerilsCode','AOG')->first();
 
     foreach($RequestCoveragesUpdate1 as $RequestCoveragesUpdate){ 
        
          // if ( $RequestCoveragesUpdate->PerilsCode == 'AOG'){
              $NoAOGPremiumTotal     =      $TotalPremium       -  $RequestCoveragesAOG1->CoveragesPremium;
              $NoAOGCoveragesTotal   =      $TotalCoverages     -  $RequestCoveragesAOG1->CoveragesAmount;
        
        
           $RequestCoveragesUpdate->NoAOGPremiumTotal      = $NoAOGPremiumTotal  ;
           $RequestCoveragesUpdate->NoAOGCoveragesTotal    = $NoAOGCoveragesTotal ;
           $RequestCoveragesUpdate->TotalPremium           = $TotalPremium ;
           $RequestCoveragesUpdate->TotalCoverages         = $TotalCoverages ;
           $RequestCoveragesUpdate->save(); 
     }
 
     $RequestCoveragesOD    = RequestCoverages::where('RequestNo',trim($PassData))->where('OptionNo',$Option)->where('PerilsCode','OD')->first();
     $RequestCoveragesTF    = RequestCoverages::where('RequestNo',trim($PassData))->where('OptionNo',$Option)->where('PerilsCode','TF')->first();
     $CAmountODTF           = $RequestCoveragesOD->CoveragesAmount +  $RequestCoveragesTF->CoveragesAmount;
     $PAmountODTF           = $RequestCoveragesOD->CoveragesPremium +  $RequestCoveragesTF->CoveragesPremium; 
       
     $RequestCoveragesOD->CAmountODTF            = $CAmountODTF ;
     $RequestCoveragesOD->PAmountODTF            = $PAmountODTF ;
     $RequestCoveragesOD->save(); 
 
     $RequestCoveragesTF->CAmountODTF            = $CAmountODTF ;
     $RequestCoveragesTF->PAmountODTF            = $PAmountODTF ;
     $RequestCoveragesTF->save(); 
 
         //Deductable
         $GetDenomination     = RequestDetails::where('RequestNo',$PassData)->first();
         $GetDenominationExplode  =  explode('-' ,$GetDenomination->Denomination);
 
         if (trim($GetDenomination->Denomination) === "2019-PC-0001" ) {
               $FindDefaultDeductible     = DefaultData::where('DefaultDataNo','2019-DE-0004')->first();
               //$MinAmount  = $FindDefaultDeductible->MinAmount;
               $PAmountODTF1  = $CAmountODTF;
           }else if (trim($GetDenomination->Denomination) === "2019-PC-0002" ) {
               $FindDefaultDeductible     = DefaultData::where('DefaultDataNo','2019-DE-0005')->first();
               $PAmountODTF1  = $CAmountODTF;
         }else if (trim($GetDenominationExplode[1] ) === "CV"   ) {
             $FindDefaultDeductible     = DefaultData::where('DefaultDataNo','2019-CV-0006')->first();
             $PAmountODTF1  = $CAmountODTF;
         }else if (trim($GetDenominationExplode[1] ) === "MC"   ) {
           $FindDefaultDeductible     = DefaultData::where('DefaultDataNo','2019-MC-0007')->first();
           $PAmountODTF1  = 1;
       }
 
 
           if (trim($RequestCoveragesOD->PerilsCode) === "OD" || trim($RequestCoveragesTF->PerilsCode) === "TF") {
                   $Deductable =  $PAmountODTF1  * $FindDefaultDeductible->Amount; 
                   if ($Deductable < $FindDefaultDeductible->MinAmount){  //less than the declare amount
                       $DeductableNew             =  $FindDefaultDeductible->MinAmount;
                   }else{
                       $DeductableNew =  $PAmountODTF1  * $FindDefaultDeductible->Amount;
                   }
           }else{
                 $DeductableNew =  $FindDefaultDeductible->MinAmount;
 
         } 
         $TowingLimit   = DefaultData::where('DefaultDataNo','2019-TL-0013')->first();
         $CoveragesDeductible   = RequestCoverages::where('RequestNo',trim($PassData))->where('OptionNo',$Option)->get();
           foreach($CoveragesDeductible as $CoveragesDeductibles){ 
                     $CoveragesDeductibles->Deductible           = round($DeductableNew , 2);
                     $CoveragesDeductibles->TowingLimit          = round($TowingLimit->Amount, 2);
                     $CoveragesDeductibles->save(); 
           }

           
      $RequestCoverages   = RequestCoverages::where('RequestNo',trim($PassData))->where('OptionNo',$Option)->get();
      $TotalPremium = 0;  $TotalCoverages = 0; 
     foreach($RequestCoverages as $RequestCoveragess){ 
               $TotalCoverages    += $RequestCoveragess->CoveragesAmount;
               $TotalPremium      += $RequestCoveragess->CoveragesPremium;
 
      
       if ( $RequestCoveragess->PerilsCode == 'AOG'  ){   
             $WithAOGPremium     =  $RequestCoveragess->CoveragesPremium;
             $WithAOGCoverages   =  $RequestCoveragess->CoveragesAmount;
             $WithAOG = "YES";
       }else{
             $WithAOGPremium     =  0.00;
             $WithAOGCoverages   =  0.00;
             $WithAOG = "NO";
       }      
               $RequestCoveragess->WithAOGPremium         = $WithAOGPremium ;
               $RequestCoveragess->WithAOGCoverages       = $WithAOGCoverages ;
               $RequestCoveragess->WithAOG                = $WithAOG ;
               $RequestCoveragess->save(); 
     }


      $RequestCoveragesUpdate1    = RequestCoverages::where('RequestNo',trim($PassData))->where('OptionNo',$Option)->get();
     $RequestCoveragesAOG1       = RequestCoverages::where('RequestNo',trim($PassData))->where('OptionNo',$Option)->where('PerilsCode','AOG')->first();
 
     foreach($RequestCoveragesUpdate1 as $RequestCoveragesUpdate){ 
        
          // if ( $RequestCoveragesUpdate->PerilsCode == 'AOG'){
              $NoAOGPremiumTotal     =      $TotalPremium       -  $RequestCoveragesAOG1->CoveragesPremium;
              $NoAOGCoveragesTotal   =      $TotalCoverages     -  $RequestCoveragesAOG1->CoveragesAmount;
        
        
           $RequestCoveragesUpdate->NoAOGPremiumTotal      = $NoAOGPremiumTotal  ;
           $RequestCoveragesUpdate->NoAOGCoveragesTotal    = $NoAOGCoveragesTotal ;
           $RequestCoveragesUpdate->TotalPremium           = $TotalPremium ;
           $RequestCoveragesUpdate->TotalCoverages         = $TotalCoverages ;
           $RequestCoveragesUpdate->save(); 
     }
 
     $RequestCoveragesOD    = RequestCoverages::where('RequestNo',trim($PassData))->where('OptionNo',$Option)->where('PerilsCode','OD')->first();
     $RequestCoveragesTF    = RequestCoverages::where('RequestNo',trim($PassData))->where('OptionNo',$Option)->where('PerilsCode','TF')->first();
     $CAmountODTF           = $RequestCoveragesOD->CoveragesAmount +  $RequestCoveragesTF->CoveragesAmount;
     $PAmountODTF           = $RequestCoveragesOD->CoveragesPremium +  $RequestCoveragesTF->CoveragesPremium; 
       
     $RequestCoveragesOD->CAmountODTF            = $CAmountODTF ;
     $RequestCoveragesOD->PAmountODTF            = $PAmountODTF ;
     $RequestCoveragesOD->save(); 
 
     $RequestCoveragesTF->CAmountODTF            = $CAmountODTF ;
     $RequestCoveragesTF->PAmountODTF            = $PAmountODTF ;
     $RequestCoveragesTF->save(); 
 
         //Deductable
         $GetDenomination     = RequestDetails::where('RequestNo',$PassData)->first();
         $GetDenominationExplode  =  explode('-' ,$GetDenomination->Denomination);
 
         if (trim($GetDenomination->Denomination) === "2019-PC-0001" ) {
               $FindDefaultDeductible     = DefaultData::where('DefaultDataNo','2019-DE-0004')->first();
               //$MinAmount  = $FindDefaultDeductible->MinAmount;
               $PAmountODTF1  = $CAmountODTF;
           }else if (trim($GetDenomination->Denomination) === "2019-PC-0002" ) {
               $FindDefaultDeductible     = DefaultData::where('DefaultDataNo','2019-DE-0005')->first();
               $PAmountODTF1  = $CAmountODTF;
         }else if (trim($GetDenominationExplode[1] ) === "CV"   ) {
             $FindDefaultDeductible     = DefaultData::where('DefaultDataNo','2019-CV-0006')->first();
             $PAmountODTF1  = $CAmountODTF;
         }else if (trim($GetDenominationExplode[1] ) === "MC"   ) {
           $FindDefaultDeductible     = DefaultData::where('DefaultDataNo','2019-MC-0007')->first();
           $PAmountODTF1  = 1;
       }
 
 
           if (trim($RequestCoveragesOD->PerilsCode) === "OD" || trim($RequestCoveragesTF->PerilsCode) === "TF") {
                   $Deductable =  $PAmountODTF1  * $FindDefaultDeductible->Amount; 
                   if ($Deductable < $FindDefaultDeductible->MinAmount){  //less than the declare amount
                       $DeductableNew             =  $FindDefaultDeductible->MinAmount;
                   }else{
                       $DeductableNew =  $PAmountODTF1  * $FindDefaultDeductible->Amount;
                   }
           }else{
                 $DeductableNew =  $FindDefaultDeductible->MinAmount;
 
         } 
         $TowingLimit   = DefaultData::where('DefaultDataNo','2019-TL-0013')->first();
         $CoveragesDeductible   = RequestCoverages::where('RequestNo',trim($PassData))->where('OptionNo',$Option)->get();
           foreach($CoveragesDeductible as $CoveragesDeductibles){ 
                     $CoveragesDeductibles->Deductible           = round($DeductableNew , 2);
                     $CoveragesDeductibles->TowingLimit          = round($TowingLimit->Amount, 2);
                     $CoveragesDeductibles->save(); 
           }
 



 
   ///-------------------------End Coverages----------------------


    //-------Charges------Charges-----Charges-----Charges------->
    $FindProductLineCharge  = ProductLinesCharges::select('*')->where('ProductLine','2019-MC-0001')->where('Active','1')->get();
    
    $CompCharges=0;  $CompCharges1=0;
    foreach($FindProductLineCharge as $FindProductLineCharges)
    { 
        if ( trim($FindProductLineCharges->ChargesType) === 'Percent'){
           
              //-------Doc Stamp Comp-------------------->
                if ( trim($FindProductLineCharges->ChargesNo) === '2019-DP-0001'){
                  $Newvalue = $FindProductLineCharges->ChargesAmount  * $ComputationPremium ;
                  $value =  round($Newvalue, 2);
                  $numpart = explode(".",$value); 
                      if(is_float($value)){
                            if ($numpart[1] < 51){
                            //    it's a decimal that is greater than zero
                            $CompChargesAmount   = $numpart[0]. '.'. 50;
                              // echo "Less 50=== " . $NewValue;
                            }else{
                            // its not a decimal, or the decimal is zero
                            $CompChargesAmount   = $numpart[0] +  1;
                            //echo "Greather 50=== " . $NewValue;
                            }
                      }else{
                        $CompChargesAmount   = $value;
                      }
              }else{
                $CompChargesAmount =  $FindProductLineCharges->ChargesAmount * $ComputationPremium  ; 
              }  
            

        }else{
                $CompChargesAmount =  $FindProductLineCharges->ChargesAmount ;  
        }
      


        $Option         =  $request['RequestNoOptionNo'] + 1 ;
        $CompCharges += $CompChargesAmount;
          $CountCharges      = RequestCharges::count() + 1;
          $RequestCharge = new RequestCharges;
              $RequestCharge->ChargesNo             = $CountCharges;
              $RequestCharge->RequestNo             = $PassData;
              $RequestCharge->ChargesName           = $FindProductLineCharges->ChargesName ;
              $RequestCharge->ChargesAmount         = $FindProductLineCharges->ChargesAmount ;
              $RequestCharge->ChargesPremium        =  round($CompChargesAmount , 2);
              $RequestCharge->ChargesType           = $FindProductLineCharges->ChargesType ;
              $RequestCharge->ChargesNo             = $FindProductLineCharges->ChargesNo ;
              $RequestCharge->OptionNo              = $Option;
              //$RequestCharge->TotalCharges          =  round($CompCharges , 2);
              $RequestCharge->Active                ='1';
              $RequestCharge->Status                = 1 ;
              $RequestCharge->save();
        
      }  
      $CompAmount   =   $ComputationPremium +  $CompCharges;  

      $UpdateCharges    = RequestCharges::where('RequestNo',$PassData)->where('OptionNo',$Option)->get();
      foreach($UpdateCharges as $UpdateCharges1){ 
              $UpdateCharges1->TotalCharges            =  round($CompCharges , 2);
              $UpdateCharges1->TotalAmountDue          =  round($CompAmount , 2);
              $UpdateCharges1->save();
      }





   $RequestCoveragesAOG    = RequestCoverages::where('RequestNo',trim($PassData))->where('OptionNo',$Option)->where('PerilsCode','AOG')->first();
         
	 $FindProductLineCharge1  = ProductLinesCharges::select('*')->where('ProductLine','2019-MC-0001')->where('Active','1')->get();
      
            
              foreach($FindProductLineCharge1 as $FindProductLineChargess)
              { 
                  if ( trim($FindProductLineChargess->ChargesType) === 'Percent'){
                     
                        //-------Doc Stamp Comp-------------------->
                          if ( trim($FindProductLineChargess->ChargesNo) === '2019-DP-0001'){
                            $Newvalue = $FindProductLineChargess->ChargesAmount  * $RequestCoveragesAOG->NoAOGPremiumTotal;
                            $value =  round($Newvalue, 2);
                            $numpart = explode(".",$value); 
                                if(is_float($value)){
                                      if ($numpart[1] < 51){
                                      //    it's a decimal that is greater than zero
                                      $CompChargesAmount1   = $numpart[0]. '.'. 50;
                                        // echo "Less 50=== " . $NewValue;
                                      }else{
                                      // its not a decimal, or the decimal is zero
                                      $CompChargesAmount1   = $numpart[0] +  1;
                                      //echo "Greather 50=== " . $NewValue;
                                      }
                                }else{
                                  $CompChargesAmount1   = $value;
                                }
                        }else{
                                  $CompChargesAmount1 =  $FindProductLineChargess->ChargesAmount * $RequestCoveragesAOG->NoAOGPremiumTotal ; 
                        }  
                      
      
                  }else{
                          $CompChargesAmount1 =  $FindProductLineChargess->ChargesAmount ;  
                  }
                
                  $CompCharges1 += $CompChargesAmount1;  
                  $UpdateCharges2    = RequestCharges::where('RequestNo',trim($PassData))->where('OptionNo',$Option)->where('ChargesNo',$FindProductLineChargess->ChargesNo)->get();
                  foreach($UpdateCharges2 as $UpdateCharges22){ 
                        $UpdateCharges22->ChargesPremiumAOG             = $CompChargesAmount1;
                        $UpdateCharges22->TotalChargesAOG               = $CompCharges1;
                        $UpdateCharges22->save();
                  
                } 
             
          }  

         // $CompCharges1 += $CompChargesAmount1; 
          
          $UpdateCharges2    = RequestCharges::where('RequestNo',trim($PassData))->where('OptionNo',$Option)->get();
          foreach($UpdateCharges2 as $UpdateCharges22){ 
                //$UpdateCharges22->ChargesPremiumAOG             = $CompChargesAmount;
                $UpdateCharges22->TotalChargesAOG               = $CompCharges1;
                $UpdateCharges22->save();
          
        }  



    }  
    
    
    public function GetPerilsOption()
    {
      return ProductLinesPerils::select('*')->where('Active',"1")->where('LinesNo',"2019-MC-0001")->paginate(100);
    }
          

    public function TestData()
    {
      return  DefaultData::select('*')->where('LinesNo','2019-MC-0008')->where('Converter',"PremiumComp")->where('Active',"1")->paginate(1);
  

    }
       
    public function GetPerilsDefaultData($id) 
    {
      
      $PassData   = explode(';;' ,$id);
       $ResultDefaultData =  DefaultData::select('*')
                      ->where('LinesNo',$PassData[0])
                      ->where('PerilsClass',$PassData[1])
                      ->where('Converter',"PremiumComp")
                      ->where('Active',"1")
                      ->first();
        $Taripa = array();
              $Taripa[] = [
                 '_id'                      => $ResultDefaultData->_id,
                 'LinesNo'                 => $ResultDefaultData->LinesNo,
                 'PerilsClass'                 => $ResultDefaultData->PerilsClass,
                 'Amount'                 => $ResultDefaultData->Amount,

                
              
                  
              ];
              return response()->json($Taripa);	
    }

    public function SaveAuthentication($id)
    {
    
      $PassData   = explode(';;' ,$id);
      $CountAuth  = Authentication::count() + 1;
      $NewCountAuth = str_pad($CountAuth, 6, '0' , STR_PAD_LEFT); 
      $CocNo      = "086" .$NewCountAuth;

      $Authentication                               = new Authentication;
      $Authentication->CocNoSeqNo                   = $CountAuth;
      $Authentication->RequestNo                    = $PassData[0];
      $Authentication->CocNo                        = $PassData[2];
      $Authentication->AuthCode                     = '';
      $Authentication->AuthRemarks                  = "";
      $Authentication->Active                       = "1";
      $Authentication->PlateNumber                  = $PassData[1];
      $Authentication->DateAuth                     = "";
      $Authentication->Code                         = '0';
      $Authentication->AssuredName                 = $PassData[3];
      //$Authentication->Denomination                = $PassData[3];
      $Authentication->save(); 

      $RequestDetails                              = RequestDetails::where('RequestNo',$PassData[0])->first();
      $RequestDetails->CocNoRequest                = $PassData[2];
      $RequestDetails->save(); 

    }

    public function UpdateAuthentication($id)  
    {
      $PassData   = explode(';;' ,$id);
      $Authentication                              = Authentication::where('RequestNo',$PassData[0])->first();
      $Authentication->AuthCode                    = $PassData[1];
      $Authentication->Code                        = '1';
      $Authentication->save(); 

      $RequestDetails                              = RequestDetails::where('RequestNo',$PassData[0])->first();
      $RequestDetails->AuthCodeRequest             = $PassData[1];
      $RequestDetails->save(); 


    
    }


    public function ISAPInternalAuth()  
    {
      return view('InternalAuthentication') ;
    
    }

    public function GetCOCNo()
    {
      $Authentication =  Authentication::select('*')
                      ->where('Active',"1")
                      ->orderBy('CocNoSeqNo',"DESC")
                      ->first();
        $AuthArray = array();
              $AuthArray[] = [
                 '_id'             => $Authentication->_id,
                 'CocNoSeqNo'      => $Authentication->CocNoSeqNo,
                 'CocNo'           => $Authentication->CocNo,
                
               
                  
              ];
              return response()->json($AuthArray);	
  

    }
    public function GetListNeedAuth() 
    {
    
        return RequestDetails::select('*')->where('Active', '1')->where('HasCTPL',1)->paginate(20);
    }

    public function ListPolicy() 
    {
    
        return RequestDetails::select('*')->where('Active', '1')->where('AcceptedOption','>=',1)->paginate(20);
    }


    public function PaymentMode($id)
    {

      $PaymentDetails  =  explode(';;',$id);
      $RequestDetails    = RequestDetails::select('*')->where('RequestNo',$PaymentDetails[4])->first();
          $RequestDetails->PaymentMode               =  'Paid';
          $RequestDetails->save();
     
     
      $PaymentDetails  =  explode(';;',$id);
        $parameters = array(
          'merchantid'  => 'RELIANCE',   
          'txnid'       => $PaymentDetails[0],
          'amount'      => $PaymentDetails[1],
          'ccy'         => 'PHP',
          'description' => $PaymentDetails[2],
          'email'       => $PaymentDetails[3],

          //  'txnid'       => 202000002,
          // 'amount'      => 500,
          // 'ccy'         => 'PHP',
          // 'description' => "TEsting",
          // 'email'       => "jsegun@iristech.ph",
          'key'         => '7533VoeuLY5SHuz',  
      );

      $this->dragonpay->setRequestParameters($parameters)->away();

      

         
  
    }
    public function GetDefaultSurcharge()
    {
       
       //return DefaultData::select('*')->where('Active', '1')->where('DefaultDataNo', '2019-SE-0012')->paginate(10);
       $ResultDefaultData =  DefaultData::select('*')
       ->where('DefaultDataNo',"2019-SE-0012")
       ->where('Active',"1")
       ->first();
            $Surcharge = array();
            $Surcharge[] = [
              '_id'                      => $ResultDefaultData->_id,
              'LinesNo'                  => $ResultDefaultData->LinesNo,
              'PerilsClass'              => $ResultDefaultData->PerilsClass,
              'Amount'                   => $ResultDefaultData->Amount,
            ];
            return response()->json($Surcharge);	

    }



    public function GetPerilsComm()
    {
       
      // return ProductLinesPerils::select('*')->where('LinesNo', trim($id))->paginate(10);
       $ProductLinesPeril =  ProductLinesPerils::select('*')
       ->where('Active',"1")
       ->where('Checkbox',"true")
       ->get();
              $GetPerilsComm = array();
              foreach($ProductLinesPeril as $ProductLinesPerils)
            { 
                  $GetPerilsComm[] = [
                  '_id'	  	  	        => $ProductLinesPerils->_id,
                  'PerilsNo'	  	      => $ProductLinesPerils->PerilsNo,
                  'PerilsCode'	  	    => $ProductLinesPerils->PerilsCode,
                  'PerilsName'	        => $ProductLinesPerils->PerilsName,
                ] ;
              
                
            }
            return response()->json($GetPerilsComm);	

    }


    public function GetLinesComm()
    {
       
      // return ProductLinesPerils::select('*')->where('LinesNo', trim($id))->paginate(10);
       $ProductLinesSub =  ProductLinesSub::select('*')
       ->where('Active',"1")
       ->orderBy('ClassName')
       ->groupBy('Class')
       ->groupBy('ClassName')
       ->get();
              //$ProductLinesSubArry = array();
              foreach($ProductLinesSub as $ProductLinesSubs)
            { 
                  $ProductLinesSubArry[] = [
                  '_id'	  	  	        => $ProductLinesSubs->_id,
                  'Class'	  	          => $ProductLinesSubs->Class,
                  'ClassName'	  	      => $ProductLinesSubs->ClassName,
                
                ] ;
              
                
            }
            return response()->json($ProductLinesSubArry);	

    }
    public function AgentCommissionReport($id)
    {

           // $id = "2020-0008";
            $DataPass  =  explode(';;',$id);
           date_default_timezone_set('Asia/Hong_Kong');
           $CurrentDate    = date('Y-m-d H:i:s');
         
           $DateStart1    = trim($DataPass[1]) ; //"2020-03-07";
           $DateEnd1      = trim($DataPass[2]) ;// "2020-03-09";

           $DateStart    =  date('Y-m-d H:i:s', strtotime($DateStart1  ));
           $DateEnd      = date('Y-m-d 23:59:59', strtotime($DateEnd1  ));
           $CompTotalCommission = 0;  $CompTotalCashOut = 0; $CompTotalCommissionAmount= 0; 
        
           $RequestDetails    = RequestDetails::select('*')
           ->where('CustAcctNO',trim($DataPass[0]))
          // ->where('TotalCommission', "!=" ,0) 
          ->whereBetween('AcceptanceDate',array($DateStart, $DateEnd) )  //array($from, $to)
           ->get();
           //dd( $RequestDetails);
           
           foreach($RequestDetails as $RequestDetailss)
              { 	
                $CompTotalCommission          += $RequestDetailss->TotalCommission;
                $CompTotalCashOut             += $RequestDetailss->CashOutAmount;
                $CompTotalCommissionAmount    += $RequestDetailss->CommissionAmount;
                 $AgentComReport = AgentComReport::select('*') 
                       ->where('AccountNo',trim($DataPass[0]))
                       ->where('RequestNo',$RequestDetailss->RequestNo)
                       ->where('active',1)
                      // ->orderBy('Sort','ASC')
                       ->get();
                     $CommBreakdown = array();
                   
                        foreach($AgentComReport as $AgentComReports)
                         { 
                       
                             $CommBreakdown[] = [
                            
                             'AccountNo'					          => $AgentComReports->AccountNo,
                             'ClassName'					          => $AgentComReports->ClassName,
                             'PerilsName'					          => $AgentComReports->PerilsName,
                             'PerilsNo'					            => $AgentComReports->PerilsNo,
                             'PerilsCode'					          => $AgentComReports->PerilsCode,
                             'RequestNo'					          => $AgentComReports->RequestNo,
                         
                         
                         
                           ] ;
                         
                    }


                    $AgentCommCashOut = AgentCommCashOut::select('*') 
                    ->where('AccountNo',trim($DataPass[0]))
                    ->where('RequestNo',$RequestDetailss->RequestNo)
                    //->where('CashOutMode','Cash')
                    ->where('active',1)
                  // ->orderBy('Sort','ASC')
                    ->get();

                    $CashOutBreakdown = array();
               
                    foreach($AgentCommCashOut as $AgentCommCashOuts)
                     { 
                      //$CompTotalCommission          += $AgentCommCashOuts->RemainingAmount;
                         $CashOutBreakdown[] = [
                        
                         'AccountNo'					          => $AgentCommCashOuts->AccountNo,
                         'CashOutMode'					        => $AgentCommCashOuts->CashOutMode,  
                         'RequestAmount'					      => $AgentCommCashOuts->RequestAmount,  ///totalRequest
                         'CashOutAmount'					      => $AgentCommCashOuts->CashOutAmount,  //remaining
                         'AmountCom'					          => $AgentCommCashOuts->AmountCom,  //Commission Amount
                         'RemainingAmount'					    => $AgentCommCashOuts->RemainingAmount,  //Commission Amount
                        // 'CompTotalCommission'				  => $CompTotalCommission,
                       
                       ] ;
                     
                    }

              
                            //$OldTotalAmountDue =  
                             $CoveragesCustDetails[] = [
                             
                               '_id'					                => $RequestDetailss->_id,  
                               'FirstName'					          => $RequestDetailss->FirstName,
                               'MiddleName'					          => $RequestDetailss->MiddleName, 
                               'LastName'					            => $RequestDetailss->LastName,
                               'TINNumber'					          => $RequestDetailss->TINNumber,
                               'PlateNumber'					        => $RequestDetailss->PlateNumber,
                               'Denomination'					        => $RequestDetailss->Denomination,
                               'RequestNo'					          => $RequestDetailss->RequestNo,
                               'Status'					              => $RequestDetailss->Status,
                               'COCNo'					              => $RequestDetailss->CocNoRequest,
                               'TotalCommission'					    => $RequestDetailss->TotalCommission,
                               'CashOutAmount'					      => $RequestDetailss->CashOutAmount,
                               'StatusCashOut'					      => $RequestDetailss->StatusCashOut,
                               'CashOutMode'                  => $RequestDetailss->CashOutMode,
                               'CommissionAmount'            => $RequestDetailss->CommissionAmount,
                               'CompTotalCommission'					=> $CompTotalCommission,
                               'CompTotalCashOut'				      	=> $CompTotalCashOut,
                               'CompTotalCommissionAmount'					=> $CompTotalCommissionAmount,
                               'CommBreakdown' 		            => $CommBreakdown,	
                              'CashOutBreakdown'				            => $CashOutBreakdown ,
                             
                               
                               
                           ] ;
                 }
               
                     return response()->json($CoveragesCustDetails);

    }


    public function AgentCommissionReportGet( $id)
    {

        
           $RequestDetails    = RequestDetails::select('*')
                    //->where('CustAcctNO',trim($id))
                    ->where('RequestNo',trim($id))
                   // ->where('TotalCommission', "!=" ,0)
                    ->get();
           foreach($RequestDetails as $RequestDetailss)
              { 	
               
                 $AgentComReport = AgentComReport::select('*') 
                       ->where('AccountNo',$RequestDetailss->CustAcctNO)
                       ->where('RequestNo',$RequestDetailss->RequestNo)
                       ->where('active',1)
                      // ->orderBy('Sort','ASC')
                       ->get();
                     $CommBreakdown = array();
                   
                        foreach($AgentComReport as $AgentComReports)
                         { 
                             
                             $CommBreakdown[] = [
                            
                             'AccountNo'					          => $AgentComReports->AccountNo,
                             'ClassName'					          => $AgentComReports->ClassName,
                             'PerilsName'					          => $AgentComReports->PerilsName,
                             'PerilsNo'					            => $AgentComReports->PerilsNo,
                             'PerilsCode'					          => $AgentComReports->PerilsCode,
                             'RequestNo'					          => $AgentComReports->RequestNo,
                             'AmountCom'					          => $AgentComReports->AmountCom,
                           
                             
                         
                         
                           ] ;
                         
                        }
              
                            //$OldTotalAmountDue =  
                             $CoveragesCustDetails[] = [
                             
                               '_id'					                  => $RequestDetailss->_id,  
                               'CustAcctNO'					                  => $RequestDetailss->CustAcctNO,  
                               'FirstName'					            => $RequestDetailss->FirstName,
                               'MiddleName'					          => $RequestDetailss->MiddleName, 
                               'LastName'					            => $RequestDetailss->LastName,
                               'TINNumber'					            => $RequestDetailss->TINNumber,
                               'PlateNumber'					          => $RequestDetailss->PlateNumber,
                               'Denomination'					        => $RequestDetailss->Denomination,
                               'RequestNo'					            => $RequestDetailss->RequestNo,
                               'AssuredAddress'					       => $RequestDetailss->Address . " " . $RequestDetailss->Barangay ." " . $RequestDetailss->City,
                               'CarDescription'					      => $RequestDetailss->MotorYear  . " " . $RequestDetailss->MotorBrand  . " " . $RequestDetailss->MotorModel . " " . $RequestDetailss->MotorBodyType ,
                               'MortgageBankName'					     => $RequestDetailss->MortgageBankName . " - " . $RequestDetailss->MortgageBankAddress,
                               'Status'					              => $RequestDetailss->Status,
                               'AmountDue'					              => $RequestDetailss->AmountDue,
                               'COCNo'					              => $RequestDetailss->CocNoRequest,
                               'TotalCommission'					    => $RequestDetailss->TotalCommission,
                               'AcceptanceDate'             => $RequestDetailss->AcceptanceDate,
                               'PaymentMode'             => $RequestDetailss->PaymentMode,
                               'DiscountAmount'             => $RequestDetailss->DiscountAmount,
                               'DiscountedAmountDue'             => $RequestDetailss->DiscountedAmountDue,
                              // 'PaymentMode'             => $RequestDetailss->PaymentMode,
                               'CashOutMode'                  => $RequestDetailss->CashOutMode,
                               'TotalAmountMaxCom'					   => $AgentComReports->TotalAmountMaxCom,
                               'CommissionAmount'					      => $RequestDetailss->CommissionAmount,  
                               'CashOutPaidAmount'					      => $RequestDetailss->CashOutPaidAmount,  
                               'StatusCashOut'					      => $RequestDetailss->StatusCashOut,  
                               
                               'CommBreakdown' 		              => $CommBreakdown,	
                             //  'OldChargers'				            => $Charges,
                             
                               
                               
                           ] ;
                 }
                     return response()->json($CoveragesCustDetails);

    }

    public function GetAgentComReport($id)
    {
       $DataPass  =  explode(';;',$id);  $AmountCom = 0; 
      //  $RequestCoverage   = RequestCoverages::where('RequestNo','2020-0001')->where('OptionNo',1)->get();
       $RequestCoverage   = RequestCoverages::where('RequestNo',$DataPass[1])->where('OptionNo',round($DataPass[2]))->get();
      // return response()->json(['success' => $RequestCoverage  ], 200); 
      $CoveragesCustDetails = array();    
      foreach($RequestCoverage as $RequestCoverages) {
                  $AgentComReport = AgentCom::select('*') 
                        ->where('AccountNo',$DataPass[0])
                        ->where('Class',$RequestCoverages->DenominationType)
                        ->where('PerilsCode',$RequestCoverages->PerilsCode)
                        ->where('active',"1")                      
                        ->get();
             
            foreach($AgentComReport as $AgentComReports)
              { 
                $AmountCom += $AgentComReports->AmountCom;
             
              }
            }
              $CoveragesCustDetails[] = [
                 'TotalAmountComm' => $AmountCom,
              ];
             
            
              return response()->json($CoveragesCustDetails);
              // return response()->json(['success' => $AmountCom  ], 200); 
             

 
    }



    public function AgentCommissionForCashOut($id)
    {

          
      $DataPass  =  explode(';;',$id);
      date_default_timezone_set('Asia/Hong_Kong');
      $CurrentDate    = date('Y-m-d H:i:s');
    
      $DateStart1    = trim($DataPass[1]) ; //"2020-03-07";
      $DateEnd1      = trim($DataPass[2]) ;// "2020-03-09";

      $DateStart     =  date('Y-m-d H:i:s', strtotime($DateStart1  ));
      $DateEnd       = date('Y-m-d 23:59:59', strtotime($DateEnd1  )); 
      $CompTotalCommission = 0; $CompTotalCashOut = 0; $CompTotalCommissionAmount= 0;  $TotalCashOutPaid= 0; $TotalCashOut= 0;  $TotalRequestAmount=0;
   
      $RequestDetails    = RequestDetails::select('*')
      //->where('CustAcctNO',trim($DataPass[0]))
      //->where('TotalCommission', "!=" ,0) 
      //->where('StatusCashOut',"Processing")  
      ->whereBetween('AcceptanceDate',array($DateStart, $DateEnd) )  //array($from, $to)
      ->get();
      //dd( $RequestDetails);
      
      foreach($RequestDetails as $RequestDetailss)
         { 	
           $CompTotalCommission          += $RequestDetailss->TotalCommission;
           $CompTotalCashOut             += $RequestDetailss->CashOutAmount;
           $CompTotalCommissionAmount    += $RequestDetailss->CommissionAmount;
        
           

               $AgentCommCashOut = AgentCommCashOut::select('*') 
                   ->where('AccountNo',trim($DataPass[0]))
                   ->where('RequestNo',$RequestDetailss->RequestNo)
                   ->where('CashOutMode','Cash')
                   ->where('active',1)
                   ->get();

                   $CashOutBreakdown = array();
                   $CashOut = 0 ; $PaidAmount = 0 ;  $RequstAmount=0;
                   if (!empty($AgentCommCashOut) ){
                   foreach($AgentCommCashOut as $AgentCommCashOuts)
                    { 
                     $CashOut          = $AgentCommCashOuts->CashOutAmount; 
                     $PaidAmount       += $AgentCommCashOuts->CashOutPaidAmount; 
                     $RequstAmount     += $AgentCommCashOuts->RequestAmount;
                        $CashOutBreakdown[] = [
                       
                         'AccountNo'					          => $AgentCommCashOuts->AccountNo,
                         'CashOutMode'					        => $AgentCommCashOuts->CashOutMode,  
                         'RequestAmount'					      => $AgentCommCashOuts->RequestAmount,  ///totalRequest
                         'CashOutAmount'					      => $AgentCommCashOuts->CashOutAmount,  //remaining
                         'AmountCom'					          => $AgentCommCashOuts->AmountCom,  //Commission Amount
                         'RemainingAmount'					    => $AgentCommCashOuts->RemainingAmount,  //Commission Amount
                      
                      ] ;
                     
                    
                   }
                   if ( !empty($AgentCommCashOut)){
                           $TotalCashOut       += $CashOut;
                           $TotalCashOutPaid   += $PaidAmount;
                           $TotalRequestAmount +=$RequstAmount;
                   }else{
                     $TotalCashOut       =0;
                     $TotalCashOutPaid   =0;
                     $TotalRequestAmount =0;
                   }

                  }

                       //$OldTotalAmountDue =  
                        $CoveragesCustDetails[] = [
                        
                          '_id'					                => $RequestDetailss->_id,  
                          'FirstName'					          => $RequestDetailss->FirstName,
                          'MiddleName'					          => $RequestDetailss->MiddleName, 
                          'LastName'					            => $RequestDetailss->LastName,
                          'TINNumber'					          => $RequestDetailss->TINNumber,
                          'PlateNumber'					        => $RequestDetailss->PlateNumber,
                          'Denomination'					        => $RequestDetailss->Denomination,
                          'RequestNo'					          => $RequestDetailss->RequestNo,
                          'Status'					              => $RequestDetailss->Status,
                          'COCNo'					              => $RequestDetailss->CocNoRequest,
                          'TotalCommission'					    => $RequestDetailss->TotalCommission,
                          'CashOutAmount'					      => $CashOut,  
                           'PaidAmount'					        => $PaidAmount,  
                           'TotalCashOutPaid'					     => $TotalCashOutPaid,  
                        //  'TotalCashOutAmount'					  => $TotalCashOut,  
                          'StatusCashOut'					      => $RequestDetailss->StatusCashOut,
                           'TotalRequestAmount'           => $TotalRequestAmount, 
                          'CommissionAmount'             => $RequestDetailss->CommissionAmount,
                          'CompTotalCommission'					=> $CompTotalCommission,
                          'CompTotalCommissionAmount'		=> $CompTotalCommissionAmount,
                          'CompTotalCashOut'					    => $CompTotalCashOut,
                         // 'CashOutBreakdown' 		            => $CashOutBreakdown,
                        
                          
                          
                      ] ;
            }
           
           // $CoveragesCustDetails = "NO Record";
           return response()->json($CoveragesCustDetails);

    }


    public function DragonPayPostBack()
    {

      // $dragonpay = new Dragonpay();
      // $dragonpay->handlePostback(function($data){
        
      //      $Authentication                              = Authentication::where('RequestNo','2020-0001')->first();
      //      $Authentication->AuthCode                    = $data['txnid'];
      //      $Authentication->Code                        = $data['refno'];
      //      $Authentication->save(); 
      //     });

    //   $merchant_account = [
    //     'merchantid' => 'RELIANCE',
    //     'key'   => '7533VoeuLY5SHuz'
    // ];
    // $txnid = '2020-0002';
    // $testing = false;
    // $dragonpay = new Dragonpay($merchant_account,$testing);
    // $status = $dragonpay->action(new \Crazymeeks\Foundation\PaymentGateway\Dragonpay\Action\CheckTransactionStatus($txnid));
    //return response()->json(['success' => $status ], 200); 
    

    }

      public function PayPalMode()
      {
  
        // $PaymentDetails  =  explode(';;',$id);
        //   $parameters = array(
        //     'merchantid'  => 'RELIANCE',   
        //     'txnid'       => $PaymentDetails[0],
        //     'amount'      => $PaymentDetails[1],
        //     'ccy'         => 'PHP',
        //     'description' => $PaymentDetails[2],
        //     'email'       => $PaymentDetails[3],
        //     'key'         => '7533VoeuLY5SHuz',  
        // );
  
        return redirect()->away('https://www.sandbox.paypal.com/cgi-bin/webscr');
  


      // $amount=  "2020";   //$_POST['totalamount'];
      // $ccy='PHP';
      // $description=   "Testing Payment" ;//$_POST['description'];
      // $email="jsegun@iristech.ph";
      // $mode='1';
      // $id=  "2020-0001"; //$_POST['id'];
       
      //  // if ($error == '') {
      //     $txnid = $id;
      //     $merchant = 'RELIANCEINSURANCE';
      //     $passwd = 'CwGmYHMuAVLeV2Z';  
      //     $digest_str = "$merchant:$txnid:$amount:$ccy:$description:$email:$passwd";
      //     $digest = sha1($digest_str);
      //     $params = "merchantid=" . urlencode($merchant) .
      //       "&txnid=" .  urlencode($txnid) . 
      //       "&amount=" . urlencode($amount) .
      //       "&ccy=" . urlencode($ccy) .
      //       "&description=" . urlencode($description) .
      //       "&email=" . urlencode($email) .
      //       "&digest=" . urlencode($digest).
      //       "&mode=" . urlencode($mode);
      //     //}
      //     $url = 'https://test.dragonpay.ph/Pay.aspx';
      
      //     header("Location: $url?$params");
      //     return response()->json(['success' => $params ], 200); 

      
      //   $parameters = array(
      //     'merchantid'  => 'RELIANCE',   'merchantid'  => 'RELIANCEINSURANCE',
      //     'txnid'       => '2020-0001',
      //     'amount'      => 10,
      //     'ccy'         => 'PHP',
      //     'description' => 'Test',
      //     'email'       => 'testemail@example.com',
      //     'key'         => '7533VoeuLY5SHuz',    key'         => 'CwGmYHMuAVLeV2Z',
      // );

      // $this->dragonpay->setRequestParameters($parameters)->away();
      //$PaymentDetails  =  explode(';;',$id);

      //    $parameters = array(
      //       //  'merchantid'  => 'RELIANCE',
      //         'txnid'       => $PaymentDetails[0],
      //         'amount'      => $PaymentDetails[1],
      //         'ccy'         => 'PHP',
      //         'description' => $PaymentDetails[2],
      //         'email'       => $PaymentDetails[3],
      //        // 'key'         => '7533VoeuLY5SHuz',
      //         'mode'        => '1',
      // );

      // $parameters = array(
      //   'merchantid' => 'RELIANCE',
       
      //   'txnid' => '2020', # Varchar(40) A unique id identifying this specific transaction from the merchant site
      //   'amount' => 1, # Numeric(12,2) The amount to get from the end-user (XXXX.XX)
      //   'ccy' => 'PHP', # Char(3) The currency of the amount
      //   'description' => 'Test', # Varchar(128) A brief description of what the payment is for
      //   'email' => 'some@merchant.ph', # Varchar(40) email address of customer
      //   'param1' => 'param1', # Varchar(80) [OPTIONAL] value that will be posted back to the merchant url when completed
      //   'param2' => 'param2', # Varchar(80) [OPTIONAL] value that will be posted back to the merchant url when completed
      //   'key'   => '7533VoeuLY5SHuz',
      // );

  

    //$this->dragonpay->setRequestParameters($parameters)->away();

     // $url = 'https://test.dragonpay.ph/Pay.aspx?';
      //return redirect()->away($url.$parameters);
     // return Redirect::away($url.$parameters);
     // $this->dragonpay->setRequestParameters($url.$parameters)->away();
     // return  new RedirectResponse($url.$parameters); 
     // return redirect($url.$parameters);
      // call the setRequestParameters() to set the Request parameters required by dragonpay
     


    }


    public function CashOutCommission(Request $request)
    {
      
      date_default_timezone_set('Asia/Hong_Kong');
      $CurrentDate              = date('Y-m-d H:i:s');

      $DateStart1    = trim($request['StartDate']) ; //"2020-03-07";
      $DateEnd1      = trim($request['EndDate']) ;// "2020-03-09";

      $DateStart    =  date('Y-m-d H:i:s', strtotime($DateStart1  ));
      $DateEnd      = date('Y-m-d 23:59:59', strtotime($DateEnd1  ));
  
      $RequestDetails    = RequestDetails::select('*')
                      ->where('CustAcctNO',trim($request['AccountNo']))
                      ->whereBetween('AcceptanceDate',array($DateStart, $DateEnd) )
                      ->where('TotalCommission', "!=" ,0)
                      ->orderBy('RequestNo', "ASC")
                      ->get();
      
        $CountRecord      = count($RequestDetails)  ;        
      foreach($RequestDetails as $RequestDetailss)
         { 	
         
              $AmountCashOut  = $request['CashOutAmount']  / $CountRecord;
            
                $AgentCommCashOut = new AgentCommCashOut;
                $AgentCommCashOut->AccountNo          = $request['AccountNo'];
                $AgentCommCashOut->CashOutMode        = $request['CashOutMode'];
                $AgentCommCashOut->RequestAmount      = round($AmountCashOut,2);   //input amount
                $AgentCommCashOut->active             = 1;
                $AgentCommCashOut->status             = 1;
                $AgentCommCashOut->RequestNo          = $RequestDetailss->RequestNo;
                $AgentCommCashOut->PlateNo            = $RequestDetailss->PlateNumber;
                $AgentCommCashOut->COCNo              = $RequestDetailss->COCNo;
                $AgentCommCashOut->AmountCom          = $RequestDetailss->CommissionAmount;
                $AgentCommCashOut->CashOutAmount      = round($RequestDetailss->CashOutAmount + $AmountCashOut,2);   ///total request
                $AgentCommCashOut->RemainingAmount    = round($RequestDetailss->TotalCommission - $AmountCashOut,2);
                $AgentCommCashOut->DateRequested      = $CurrentDate;
                $AgentCommCashOut->save();

                $RequestDetailss->TotalCommission             = round($RequestDetailss->TotalCommission - $AmountCashOut,2);
                $RequestDetailss->CashOutAmount               = round($RequestDetailss->CashOutAmount + $AmountCashOut,2);
                $RequestDetailss->StatusCashOut               = "Requesting";
                $RequestDetailss->CashOutMode                 = $request['CashOutMode'];
                $RequestDetailss->save(); 
        }
        if (trim($request['CashOutMode']) == 'Discount'){
            $UsersDiscount   = User::where('AccountNo',trim($request['AccountNo']))->first();
            $UsersDiscount->CashOutDiscount   = round( $UsersDiscount->CashOutDiscount  + $request['CashOutAmount'] ,2);
            $UsersDiscount->save(); 

        }
    
    }



    public function AgentCommReportCashOut( $id)
    {

        
           $RequestDetails    = RequestDetails::select('*')->where('CustAcctNO',trim($id))
                    //->where('RequestNo',$id)
                    //->where('TotalCommission', "!=" ,0)
                    ->get();
           foreach($RequestDetails as $RequestDetailss)
              { 	
               
                 $AgentComReport = AgentComReport::select('*') 
                       ->where('AccountNo',$RequestDetailss->CustAcctNO)
                       ->where('RequestNo',$RequestDetailss->RequestNo)
                       ->where('active',1)
                      // ->orderBy('Sort','ASC')
                       ->get();
                     $CommBreakdown = array();
                   
                        foreach($AgentComReport as $AgentComReports)
                         { 
                             
                             $CommBreakdown[] = [
                            
                             'AccountNo'					          => $AgentComReports->AccountNo,
                             'ClassName'					          => $AgentComReports->ClassName,
                             'PerilsName'					          => $AgentComReports->PerilsName,
                             'PerilsNo'					            => $AgentComReports->PerilsNo,
                             'PerilsCode'					          => $AgentComReports->PerilsCode,
                             'RequestNo'					          => $AgentComReports->RequestNo,
                             'AmountCom'					          => $AgentComReports->AmountCom,
                           
                             
                         
                         
                           ] ;
                         
                        }
              
                            //$OldTotalAmountDue =  
                             $CoveragesCustDetails[] = [
                             
                               '_id'					                  => $RequestDetailss->_id,  
                               'CustAcctNO'					                  => $RequestDetailss->CustAcctNO,  
                               'FirstName'					            => $RequestDetailss->FirstName,
                               'MiddleName'					          => $RequestDetailss->MiddleName, 
                               'LastName'					            => $RequestDetailss->LastName,
                               'TINNumber'					            => $RequestDetailss->TINNumber,
                               'PlateNumber'					          => $RequestDetailss->PlateNumber,
                               'Denomination'					        => $RequestDetailss->Denomination,
                               'RequestNo'					            => $RequestDetailss->RequestNo,
                               'AssuredAddress'					       => $RequestDetailss->Address . " " . $RequestDetailss->Barangay ." " . $RequestDetailss->City,
                               'CarDescription'					      => $RequestDetailss->MotorYear  . " " . $RequestDetailss->MotorBrand  . " " . $RequestDetailss->MotorModel . " " . $RequestDetailss->MotorBodyType ,
                               'MortgageBankName'					     => $RequestDetailss->MortgageBankName . " - " . $RequestDetailss->MortgageBankAddress,
                               'Status'					              => $RequestDetailss->Status,
                               'AmountDue'					              => $RequestDetailss->AmountDue,
                               'COCNo'					              => $RequestDetailss->CocNoRequest,
                               'TotalCommission'					    => $RequestDetailss->TotalCommission,
                               'AcceptanceDate'             => $RequestDetailss->AcceptanceDate,
                               'PaymentMode'             => $RequestDetailss->PaymentMode,
                               'DiscountAmount'             => $RequestDetailss->DiscountAmount,
                               'DiscountedAmountDue'             => $RequestDetailss->DiscountedAmountDue,
                              // 'PaymentMode'             => $RequestDetailss->PaymentMode,
                               'CashOutAmount'					      => $RequestDetailss->CashOutAmount,  
                               'CommissionAmount'					      => $RequestDetailss->CommissionAmount,  
                               
                               'TotalAmountMaxCom'					   => $AgentComReports->TotalAmountMaxCom,
                               
                               'CommBreakdown' 		              => $CommBreakdown,	
                             //  'OldChargers'				            => $Charges,
                             
                               
                               
                           ] ;
                 }
                     return response()->json($CoveragesCustDetails);

    }


    public function ListCashOutAgent($id)
    {

            // $id = "2020-0008";
            $DataPass  =  explode(';;',$id);
           date_default_timezone_set('Asia/Hong_Kong');
           $CurrentDate    = date('Y-m-d H:i:s');
         
           $DateStart1    = trim($DataPass[1]) ; //"2020-03-07";
           $DateEnd1      = trim($DataPass[2]) ;// "2020-03-09";

           $DateStart    =  date('Y-m-d H:i:s', strtotime($DateStart1  ));
           $DateEnd      = date('Y-m-d 23:59:59', strtotime($DateEnd1  )); 
           $CompTotalCommission = 0; $CompTotalCashOut = 0; $CompTotalCommissionAmount= 0;  $TotalCashOut= 0; 
        
           $RequestDetails    = RequestDetails::select('*')
              //->where('TotalCommission', "!=" ,0) 
              ->whereBetween('AcceptanceDate',array($DateStart, $DateEnd) )  //array($from, $to)
              ->orderBy('CustAcctNO',"ASC")  
              ->get();
           //dd( $RequestDetails);
           
           foreach($RequestDetails as $RequestDetailss)
              { 	
                $CompTotalCommission          += $RequestDetailss->TotalCommission;
                $CompTotalCashOut             += $RequestDetailss->CashOutAmount;
                $CompTotalCommissionAmount    += $RequestDetailss->CommissionAmount;
                
                

                    $AgentCommCashOut = AgentCommCashOut::select('*') 
                       // ->where('AccountNo',trim($DataPass[0]))
                        ->where('RequestNo',$RequestDetailss->RequestNo)
                        ->where('CashOutMode','Cash')
                        ->where('active',1)
                        // ->where('status','!=','PAID')
                      // ->orderBy('Sort','ASC')
                        ->get();

                        $CashOutBreakdown = array();
                        $CashOut = 0 ;
                        foreach($AgentCommCashOut as $AgentCommCashOuts)
                         { 
                          $CashOut  += $AgentCommCashOuts->RequestAmount; 
                             $CashOutBreakdown[] = [
                            
                              'AccountNo'					          => $AgentCommCashOuts->AccountNo,
                              'CashOutMode'					        => $AgentCommCashOuts->CashOutMode,  
                              'RequestAmount'					      => $AgentCommCashOuts->RequestAmount,  ///totalRequest
                              'CashOutAmount'					      => $AgentCommCashOuts->CashOutAmount,  //remaining
                              'AmountCom'					          => $AgentCommCashOuts->AmountCom,  //Commission Amount
                              'RemainingAmount'					    => $AgentCommCashOuts->RemainingAmount,  //Commission Amount
                           
                           ] ;
                          
                         
                        }

                      $TotalCashOut += $CashOut;

              
                            //$OldTotalAmountDue =  
                             $CoveragesCustDetails[] = [
                             
                               '_id'					                => $RequestDetailss->_id,  
                               'FirstName'					          => $RequestDetailss->FirstName,
                               'MiddleName'					          => $RequestDetailss->MiddleName, 
                               'LastName'					            => $RequestDetailss->LastName,
                               'TINNumber'					          => $RequestDetailss->TINNumber,
                               'PlateNumber'					        => $RequestDetailss->PlateNumber,
                               'Denomination'					        => $RequestDetailss->Denomination,
                               'RequestNo'					          => $RequestDetailss->RequestNo,
                               'Status'					              => $RequestDetailss->Status,
                               'COCNo'					              => $RequestDetailss->CocNoRequest,
                               'CustAcctNO'					          => $RequestDetailss->CustAcctNO,
                               'TotalCommission'					    => $RequestDetailss->TotalCommission,
                               'CashOutAmount'					      => $CashOut,  
                               'TotalCashOutAmount'					  => $TotalCashOut,  
                               'StatusCashOut'					      => $RequestDetailss->StatusCashOut,
                               'CashOutMode'                  => $AgentCommCashOuts->CashOutMode, 
                               'CommissionAmount'             => $RequestDetailss->CommissionAmount,
                               'CompTotalCommission'					=> $CompTotalCommission,
                               'CompTotalCommissionAmount'		=> $CompTotalCommissionAmount,
                               'CompTotalCashOut'					    => $CompTotalCashOut,
                              // 'CashOutBreakdown' 		            => $CashOutBreakdown,
                             
                               
                               
                           ] ;
                 }
               
                     return response()->json($CoveragesCustDetails);

    }

    public function ListCashOutAgentPaid($id)
    {

            // $id = "2020-0008";
            $DataPass  =  explode(';;',$id);
           date_default_timezone_set('Asia/Hong_Kong');
           $CurrentDate    = date('Y-m-d H:i:s');
         
           $DateStart1    = trim($DataPass[1]) ; //"2020-03-07";
           $DateEnd1      = trim($DataPass[2]) ;// "2020-03-09";

           $DateStart    =  date('Y-m-d H:i:s', strtotime($DateStart1  ));
           $DateEnd      = date('Y-m-d 23:59:59', strtotime($DateEnd1  )); 
           $CompTotalCommission = 0; $CompTotalCashOut = 0; $CompTotalCommissionAmount= 0;  $TotalCashOut= 0; 
        
           $RequestDetails    = RequestDetails::select('*')
               //->where('TotalCommission', "!=" ,0) 
               ->where('StatusCashOut','Requesting') 
              ->whereBetween('AcceptanceDate',array($DateStart, $DateEnd) )  //array($from, $to)
              ->orderBy('CustAcctNO',"ASC")  
              ->get();
           //dd( $RequestDetails);
           
           foreach($RequestDetails as $RequestDetailss)
              { 	
                $CompTotalCommission          += $RequestDetailss->TotalCommission;
                $CompTotalCashOut             += $RequestDetailss->CashOutAmount;
                $CompTotalCommissionAmount    += $RequestDetailss->CommissionAmount;
                
                

                    $AgentCommCashOut = AgentCommCashOut::select('*') 
                       // ->where('AccountNo',trim($DataPass[0]))
                        ->where('RequestNo',$RequestDetailss->RequestNo)
                        ->where('CashOutMode','Cash')
                        ->where('active',1)
                        // ->where('status','!=','PAID')
                      // ->orderBy('Sort','ASC')
                        ->get();

                        $CashOutBreakdown = array();
                        $CashOut = 0 ;
                        foreach($AgentCommCashOut as $AgentCommCashOuts)
                         { 
                          $CashOut  += $AgentCommCashOuts->RequestAmount; 
                             $CashOutBreakdown[] = [
                            
                              'AccountNo'					          => $AgentCommCashOuts->AccountNo,
                              'CashOutMode'					        => $AgentCommCashOuts->CashOutMode,  
                              'RequestAmount'					      => $AgentCommCashOuts->RequestAmount,  ///totalRequest
                              'CashOutAmount'					      => $AgentCommCashOuts->CashOutAmount,  //remaining
                              'AmountCom'					          => $AgentCommCashOuts->AmountCom,  //Commission Amount
                              'RemainingAmount'					    => $AgentCommCashOuts->RemainingAmount,  //Commission Amount
                           
                           ] ;
                          
                         
                        }

                      $TotalCashOut += $CashOut;

              
                            //$OldTotalAmountDue =  
                             $CoveragesCustDetails[] = [
                             
                               '_id'					                => $RequestDetailss->_id,  
                               'FirstName'					          => $RequestDetailss->FirstName,
                               'MiddleName'					          => $RequestDetailss->MiddleName, 
                               'LastName'					            => $RequestDetailss->LastName,
                               'TINNumber'					          => $RequestDetailss->TINNumber,
                               'PlateNumber'					        => $RequestDetailss->PlateNumber,
                               'Denomination'					        => $RequestDetailss->Denomination,
                               'RequestNo'					          => $RequestDetailss->RequestNo,
                               'Status'					              => $RequestDetailss->Status,
                               'COCNo'					              => $RequestDetailss->CocNoRequest,
                               'CustAcctNO'					          => $RequestDetailss->CustAcctNO,
                               'TotalCommission'					    => $RequestDetailss->TotalCommission,
                               'CashOutAmount'					      => $CashOut,  
                               'TotalCashOutAmount'					  => $TotalCashOut,  
                               'StatusCashOut'					      => $RequestDetailss->StatusCashOut,
                               'CashOutMode'                  => $AgentCommCashOuts->CashOutMode, 
                               'CommissionAmount'             => $RequestDetailss->CommissionAmount,
                               'CompTotalCommission'					=> $CompTotalCommission,
                               'CompTotalCommissionAmount'		=> $CompTotalCommissionAmount,
                               'CompTotalCashOut'					    => $CompTotalCashOut,
                              // 'CashOutBreakdown' 		            => $CashOutBreakdown,
                             
                               
                               
                           ] ;
                 }
               
                     return response()->json($CoveragesCustDetails);

    }



    public function CashOutPayOut(Request $request)
      {
      
      date_default_timezone_set('Asia/Hong_Kong');
      $CurrentDate              = date('Y-m-d H:i:s');

      $DateStart1    = trim($request['StartDate']) ; //"2020-03-07";
      $DateEnd1      = trim($request['EndDate']) ;// "2020-03-09";

      $DateStart    =  date('Y-m-d H:i:s', strtotime($DateStart1  ));
      $DateEnd      = date('Y-m-d 23:59:59', strtotime($DateEnd1  ));
  
     
      $totalRequestNo  = $request['PassRequestNo'];
         
          for($P=0 ;$P < count($totalRequestNo)  ;$P++)
          { 
                  $RequestNo                =  trim($request['PassRequestNo'][$P]);
                  $CashOutPaidAmount        =  trim($request['PassRequestNoCashOut'][$P]);
                  $AgentCommCashOut   = AgentCommCashOut::where('RequestNo',$RequestNo )
                        ->where('status','!=','PAID')
                        ->where('CashOutMode','Cash')
                        ->get();
                  foreach($AgentCommCashOut as $AgentCommCashOuts)
                  { 
                      $AgentCommCashOuts->RequestAmount       = 0;
                      $AgentCommCashOuts->CashOutPaidAmount   = round($CashOutPaidAmount,2);
                      $AgentCommCashOuts->status              = 'PAID'; ///PAID
                      $AgentCommCashOuts->save(); 

                  }

                  $RequestDetailss   = RequestDetails::where('RequestNo',$RequestNo )
                          //->where('StatusCashOut','!=','PAID')
                           ->first();
                 
                      $RequestDetailss->CashOutPaidAmount   = round($CashOutPaidAmount,2);
                      $RequestDetailss->StatusCashOut    = 'PAID'; ///PAID
                      $RequestDetailss->save(); 

                 

          }	
    } 


    public function Get_Request_Quotation()
    {
  
           $RequestDetails    = RequestDetails::select('*')
                    ->where('Active','1')
                    //->where('Status', "Processing")
                    ->get();
                         $DetailsRequest = array();
                    foreach($RequestDetails as $RequestDetailss)
                        { 	
  
                          $DetailsRequest[] = [
                              
                            '_id'					                  => $RequestDetailss->_id,  
                            'CustAcctNO'					                  => $RequestDetailss->CustAcctNO,  
                            'FirstName'					            => $RequestDetailss->FirstName,
                            'MiddleName'					          => $RequestDetailss->MiddleName, 
                            'LastName'					            => $RequestDetailss->LastName,
                            'TINNumber'					            => $RequestDetailss->TINNumber,
                            'PlateNumber'					          => $RequestDetailss->PlateNumber,
                            'Denomination'					        => $RequestDetailss->Denomination,
                            'RequestNo'					            => $RequestDetailss->RequestNo,
                            'AssuredAddress'					       => $RequestDetailss->Address . " " . $RequestDetailss->Barangay ." " . $RequestDetailss->City,
                            'CarDescription'					      => $RequestDetailss->MotorYear  . " " . $RequestDetailss->MotorBrand  . " " . $RequestDetailss->MotorModel . " " . $RequestDetailss->MotorBodyType ,
                            'MortgageBankName'					     => $RequestDetailss->MortgageBankName . " - " . $RequestDetailss->MortgageBankAddress,
                            'Status'					              => $RequestDetailss->Status,
                            'AmountDue'					              => $RequestDetailss->AmountDue,
                            'COCNo'					              => $RequestDetailss->CocNoRequest,
                            'TotalCommission'					    => $RequestDetailss->TotalCommission,
                            'AcceptanceDate'             => $RequestDetailss->AcceptanceDate,
                           // 'PaymentMode'             => $RequestDetailss->PaymentMode,
                            'DiscountAmount'             => $RequestDetailss->DiscountAmount,
                            'DiscountedAmountDue'             => $RequestDetailss->DiscountedAmountDue,
                            'PaymentMode'             => $RequestDetailss->PaymentMode,
                            'CashOutAmount'					      => $RequestDetailss->CashOutAmount,  
                            'CommissionAmount'					      => $RequestDetailss->CommissionAmount,  
                        
                          ] ;
                   
                          $CoveragesCustDetails[] = [
                            'DetailsRequest'   => $DetailsRequest,  
                            
                           ] ;
                 }
                     return response()->json($CoveragesCustDetails);
  
    }



    public function API_Get_Request_Quotation()
    { 
           
//      $Client  =  $this->soapWrapper->add('Get_Request_Quotation', function ($service) {
//         $service
//             ->wsdl('http://127.0.0.1:8001/api/Get_Request_Quotation.wsdl')
//             ->trace(true);
//     });
//     $data = [
//       'Region_ID'=> 92,
//       'Match_ID' => 0,
//       'Department_IDs' => '',
//       'RegionCoefficient_X' => 1,
//       'RegionCoefficient_Y' => 1,
//   ];

// //$response = $this->soapWrapper->call('Get_Request_Quotation.CoveragesCustDetails', $data);
//         dd($Client);



    //dd($Client); 
    // $response =$this->soapWrapper->call('checkVatService.checkVat', [
    //     'body' => [
    //         'countryCode'          => 'EE',
    //         'vatNumber'            => '123123123'
    //     ]
    // ]);

    // $this->soapWrapper::add(function ($service) {
    //   $service
    //   ->name('Testing')
    //   ->wsdl('http://example.asmx?WSDL')
    //   ->customHeader($customHeader)
    //   ->trace(true);
    // });
               
            $Token = "12345678999";
               // $response = Curl::to('http://127.0.0.1:8001/api/Get_Request_Quotation')->get();
                $response = Curl::to('http://127.0.0.1:8001/api/Get_Request_Quotation?YOURTOKEN='.$Token)->post(); 
                          
                        echo $response;
                          // return response()->json($response);

                          

    }

    public function dragonpay_return()
    {
        return view('ReturnBackURL');
       
    }
	
   

	
}
