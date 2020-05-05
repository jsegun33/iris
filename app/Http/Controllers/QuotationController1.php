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
use App\ReportQuotation;
use Jenssegers\Mongodb\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use MongoDB\BSON\Decimal128;

class QuotationController extends Controller
{

 // private $UserDataAccountNo = "2019-0003" ;

  public function __construct()
    {
        //$this->middleware('auth');
        // $this->user =  \Auth::user();
    }


  


    public function permissions()
  {
    return $this->belongsToMany('App\Quotation');
    return $this->belongsToMany('App\MotorCarDetails');
    return $this->belongsToMany('App\QuotationList');
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


           $DepreciativeEveryYearPrcnt      =  $NoYrsDepreciative  * 0.10;
           $DepreciativeEveryYear           = $request['POAMount'] * $DepreciativeEveryYearPrcnt;
           $DepreciativeAmount              = $request['POAMount'] - $DepreciativeEveryYear  ;

      // $RequestSurcharge->save();


        $FindDefaultDataRate       =  DefaultData::where('DefaultDataNo','2019-RE-0001')->first();
        $FindDefaultDataAmount     =  DefaultData::where('DefaultDataNo','2019-CT-0003')->first();

        if ( trim($request['POAMount']) == ' ' || trim($request['POAMount']) == 0 ){

              $POAmount     = $FindDefaultDataAmount->Amount;
              
        }else{
           
             if ( $request['POAMount']  <= $FindDefaultDataAmount->Amount  ){
                  $POAmount              = $FindDefaultDataAmount->Amount;
             }else{
                   $FindCoveragesss = ProductLinesPerilsTaripa::select('*')->where('CoverageAmount', '>=',round($DepreciativeAmount ))->first();
          
                    $POAmount     =  $FindCoveragesss->CoverageAmount; // $request['POAMount'];
             }
        }

       // $POAmount = 150000;
          $RatePercentage  =  $FindDefaultDataRate->Amount;


          $ComputationPremium = 0 ; 
          $totalPerilsName1         = $request['PerilsName'];
        for($P=0 ;$P < count($totalPerilsName1)  ;$P++)
        { 
         
           $PerilsNo       =  trim($request['PerilsName'][$P]);
           $ExplodePerilsNo1 = explode('-' ,$PerilsNo);
           if (trim($ExplodePerilsNo1[1]) === "OD" || trim($ExplodePerilsNo1[1]) === "TF") {
               if ( trim($request['PerilsName'][$P])  === "2019-TF-0002"){
                 $ArrayPerilsName = array('2019-OD-0003',$request['PerilsName'][$P]);
               } else{
                  $ArrayPerilsName = array('2019-TF-0002',$request['PerilsName'][$P]);
                }
                 
              
            } else{
                $ArrayPerilsName = array($request['PerilsName'][$P]);
                 
            }

            
              

       //}
   
       $Denomination   = explode(';;' ,$request['Denomination']);
     //-------Request Coverages------Request Coverages-----Request Coverages-----Request Coverages------->
     
        for($k=0 ;$k < count($ArrayPerilsName)  ;$k++)
        { 
          $CountCoverages = RequestCoverages::count() + 1;
          $PerilsNo       = $ArrayPerilsName[$k]; //trim($request['PerilsName'][$k]);
        
          $ExplodePerilsNo = explode('-' ,$PerilsNo);
          
         
                           
                $FindCoveragess = ProductLinesPerilsTaripa::select('*')->where('CoverageAmount','>=',round($POAmount))->where('PerilsNo',trim($PerilsNo))->where('SubLinesNo',trim($Denomination[0]))->first();
                    
                  if ( trim($request['usage']) === "Commercial Use"){
                        if (trim($ExplodePerilsNo[1]) === "OD" || trim($ExplodePerilsNo[1]) === "TF") {
                            $CompPremium  =  ( (( $RatePercentage / 100) * $POAmount) * $FindCoveragess->PremiumAmount );
                            $Surcharge = 0;
                           
                        }else if (trim($ExplodePerilsNo[1]) == "AOG" || trim($ExplodePerilsNo[1]) == "CT") {
                            $CompPremium  =   $FindCoveragess->PremiumAmount  ;
                            $Surcharge = 0;
                             
                        }else{
                            $FindSurcharge  = DefaultData::where('DefaultDataNo','2019-SE-0012')->first();
                            $CompPremium    =    $FindCoveragess->PremiumAmount * $FindSurcharge->Amount;
                            $Surcharge      =    $FindSurcharge->Amount;
                           
                          }

                  }else{
                      if (trim($ExplodePerilsNo[1]) === "OD" || trim($ExplodePerilsNo[1]) === "TF") {
                           $CompPremium  =  ( (( $RatePercentage / 100) * $POAmount) * $FindCoveragess->PremiumAmount );
                        
                      }else{
                           $CompPremium  =  (  $CompPremium  =   $FindCoveragess->PremiumAmount  ) ;
                          
                      }
                        $Surcharge = 0;

                  }
               // }
             
                  //Deductable
                  if (trim($ExplodePerilsNo[1]) === "OD" || trim($ExplodePerilsNo[1]) === "TF") {
                         if (trim($Denomination[0]) === "2019-PC-0001" ) {
                             $FindDefaultDeductible     = DefaultData::where('DefaultDataNo','2019-DE-0004')->first();
                         }
                       
                          if (trim($Denomination[0]) === "2019-PC-0002" ) {
                              $FindDefaultDeductible     = DefaultData::where('DefaultDataNo','2019-DE-0005')->first();
                          }
                       
                          $Deductable =  $POAmount  * $FindDefaultDeductible->Amount;
                          //echo $Deductable;
                          $CondDefaultDeductible          = DefaultData::where('DefaultDataNo','2019-DE-0013')->first();
                          if ($Deductable < $CondDefaultDeductible->Amount){  //less than the declare amount
                              $FindDefaultDeductible     = DefaultData::where('DefaultDataNo','2019-DE-0013')->first();
                              $DeductableNew             =  $FindDefaultDeductible->Amount;

                          }else{
                             $DeductableNew =  $POAmount  * $FindDefaultDeductible->Amount;
                          }
                  }else{
                        $FindDefaultDeductible     = DefaultData::where('DefaultDataNo','2019-DE-0013')->first();
                            $DeductableNew =  $FindDefaultDeductible->Amount;

                  } 
                  
                  $ComputationPremium += $CompPremium;
                  $ProductLinesPerils     = ProductLinesPerils::where('PerilsNo',trim($ArrayPerilsName[$k]))->first();
                  $SortPerilsName   = explode('-' ,$ArrayPerilsName[$k]);
				  
				  if ( $ProductLinesPerils->PerilsCode == "CT"){
					    $CTPLDefaultAmount      = DefaultData::where('DefaultDataNo','2019-CT-0003')->first();
              $CoverageAmountSave 	  =  $CTPLDefaultAmount->Amount;
              $NumberPassenger        = $request['passengers'];
				  }else{
              $CoverageAmountSave     = $FindCoveragess->CoverageAmount;
              $NumberPassenger        = 4 ;
				  }
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
                  $RequestCoverages->PremiumAmount           = round($FindCoveragess->PremiumAmount, 2);
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
                  
                  
             $RequestCoverages->save();

            
      }
          
    }
      //-------Charges------Charges-----Charges-----Charges------->
        $FindProductLineCharge  = ProductLinesCharges::select('*')->where('ProductLine','2019-MC-0001')->where('Active','1')->get();
      
        $CompCharges=0;
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


          if ($request['EffectiveDate'] != ''){
            $date1          = strtotime($CurrentDate1 );    //date('Y-m-d H:i:s');
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
        $RequestDetails->Deductable                   = round($DeductableNew , 2);
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
        $RequestDetails->City                         = $request['city'];
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
        $RequestDetails->AssignCRD                    = $DefaultCRD->Name ;
       // $RequestDetails->WithAOG                      = $WithAOG ;
        
        $RequestDetails->save();



    $RequestCoverages                = RequestCoverages::where('RequestNo',$AccountNo)->get();
   
   
     $TotalPremium = 0;  $TotalCoverages = 0; 
    foreach($RequestCoverages as $RequestCoveragess){ 
              $TotalCoverages    += $RequestCoveragess->CoveragesAmount;
              $TotalPremium      += $RequestCoveragess->CoveragesPremium;

      // if ( $RequestCoveragess->PerilsCode == 'OD' || $RequestCoveragess->PerilsCode == 'TF'  ){
      //       $CAmountODTF    += $RequestCoveragess->CoveragesAmount;
      //       $PAmountODTF    += $RequestCoveragess->CoveragesPremium;
      // }else{
      //   $CAmountODTF  =  0 ; $PAmountODTF =0;
      // }  
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
              // $RequestCoveragess->NoAOGPremiumTotal      = $TotalPremium -  $WithAOGPremium  ;
              // $RequestCoveragess->NoAOGCoveragesTotal    = $TotalCoverages -  $WithAOGCoverages;
              // $RequestCoveragess->TotalPremium           = $TotalPremium ;
              // $RequestCoveragess->TotalCoverages         = $TotalCoverages ;
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
          //$RequestCoveragesUpdate->WithAOGPremium         = $WithAOGPremium ;
         // $RequestCoveragesUpdate->WithAOGCoverages       = $WithAOGCoverages ;
          //$RequestCoveragesUpdate->WithAOG                = $WithAOG ;
          $RequestCoveragesUpdate->NoAOGPremiumTotal      = $NoAOGPremiumTotal  ;
          $RequestCoveragesUpdate->NoAOGCoveragesTotal    = $NoAOGCoveragesTotal ;
          $RequestCoveragesUpdate->TotalPremium           = $TotalPremium ;
          $RequestCoveragesUpdate->TotalCoverages         = $TotalCoverages ;
          
          $RequestCoveragesUpdate->save(); 
    }

              $RequestCoveragesAOG    = RequestCoverages::where('RequestNo',$AccountNo)->where('PerilsCode','AOG')->first();
              if ( !empty($RequestCoveragesAOG->PerilsCode)){
                  $WithAOGUpdate  ="YES";
              }else{
                  $WithAOGUpdate  ="NO";
              }
              
              $RequestDetailsUpdate            = RequestDetails::where('RequestNo',$AccountNo)->first();
              $RequestDetailsUpdate->WithAOG                = $WithAOGUpdate ;
              $RequestDetailsUpdate->save(); 

              
              $RequestCoveragesOD    = RequestCoverages::where('RequestNo',$AccountNo)->where('PerilsCode','OD')->first();
              $RequestCoveragesTF    = RequestCoverages::where('RequestNo',$AccountNo)->where('PerilsCode','TF')->first();
              $CAmountODTF   = $RequestCoveragesOD->CoveragesAmount +  $RequestCoveragesTF->CoveragesAmount;
              $PAmountODTF   = $RequestCoveragesOD->CoveragesPremium +  $RequestCoveragesTF->CoveragesPremium; 
                
              $RequestCoveragesOD->CAmountODTF            = $CAmountODTF ;
              $RequestCoveragesOD->PAmountODTF            = $PAmountODTF ;
              $RequestCoveragesOD->save(); 

              $RequestCoveragesTF->CAmountODTF            = $CAmountODTF ;
              $RequestCoveragesTF->PAmountODTF            = $PAmountODTF ;
              $RequestCoveragesTF->save(); 


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
                  $UpdateCharges2    = RequestCharges::where('RequestNo',$AccountNo)->where('ChargesNo',$FindProductLineChargess->ChargesNo)->get();
                  foreach($UpdateCharges2 as $UpdateCharges22){ 
                        $UpdateCharges22->ChargesPremiumAOG             = $CompChargesAmount1;
                        //$UpdateCharges22->TotalChargesAOG               = $CountCharges;
                        $UpdateCharges22->save();
                  
                }  
          }  
          
          $UpdateCharges2    = RequestCharges::where('RequestNo',$AccountNo)->get();
          foreach($UpdateCharges2 as $UpdateCharges22){ 
                //$UpdateCharges22->ChargesPremiumAOG             = $CompChargesAmount;
                $UpdateCharges22->TotalChargesAOG               = $CompCharges1;
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

    public function GetPerilsCoverageAmountByDefault()
    {
    
       return ProductLinesPerilsTaripa::select('*')
              ->where('SubLinesNo', '2019-PC-0001')
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

  
    public function URLQueryRequestModify($id)
    {
      //$id = "2020-0002" ;
      return RequestDetails::select('*')
                ->where('Active','1')
                ->where('RequestNo',trim($id))
                ->paginate(10);
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
                      $ChargesQueryID                       =  trim($request['TxtChargesNameID'][$P]);
                      $RequestCharges                       = RequestCharges::where('_id',$ChargesQueryID)->first(); 
                      $RequestCharges->ChargesPremium       = $request['TxtChargesPremiumForDisplay'][$P];
                      $RequestCharges->save();
           
               } 

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
                            //'CoveragesPremium'      => $GetAllRequestCoveragess->CoveragesPremium, 
                            'CoveragesPremium'      => $CoveragesPremium , 
                            'PremiumAmount'         => $GetAllRequestCoveragess->PremiumAmount,
                            'CoveragesAmount'       => $ComputeCoveragesAmount,
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
            
            $RequestCoverageGetPremiumAmount      = RequestCoverages::select('*')->where('RequestNo',trim($id))->where('CoveragesName',$request['ToSAvedAmountRequestADD'][$k])->where('OptionNo',$RequestCoverageORDER->OptionNo)->first();  
            $ProductLinesPerils                   = ProductLinesPerils::where('PerilsNo',trim($request['ToSAvedAmountRequestADD'][$k]))->first();
			      $PerilsDescription                    = str_replace("4",$request['passengers'], trim($ProductLinesPerils->Description));
            $RequestCoverages = new RequestCoverages;
                   // $RequestCoverages->CoveragesNo             = $CountCoverages;
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
                          $RequestCharges->Active                      = '1' ;
                          $RequestCharges->save(); 
                  }
          
              
                  $OptionNumber = $RequestCoverageORDER->OptionNo + 1;
                  $RequestCoverages                = RequestCoverages::where('RequestNo',trim($id))->where('OptionNo',$OptionNumber)->get();
                  $CAmountODTF = 0 ;  $PAmountODTF = 0;
                  foreach($RequestCoverages as $RequestCoveragess){ 
                          if ( $RequestCoveragess->PerilsCode == 'OD' || $RequestCoveragess->PerilsCode == 'TF'  ){
                                $CAmountODTF    += $RequestCoveragess->CoveragesAmount;
                                $PAmountODTF    += $RequestCoveragess->CoveragesPremium;
                          }else{
                            $CAmountODTF  =  0 ; $PAmountODTF =0;
                          }              
                                
                                
                                  $RequestCoveragess->CAmountODTF            = $CAmountODTF ;
                                  $RequestCoveragess->PAmountODTF            = $PAmountODTF ;
                                  $RequestCoveragess->save();
                     
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
              $SubLinesNo           = '2019-PC-0001';
             
           
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
               
                  $ProductLinesPerilsTaripas = ProductLinesPerilsTaripa::select('TaripaNo','SubLinesNo','PerilsNo','CoverageAmount','PremiumAmount','Active')
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
    
         //return view('upload.upload-taripa');
         //$user_id = Auth::user()->user_fname;

         $user = Auth::user();
         dd(Auth::user());

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
              $RequestRequestDetails->QuoteExpiryRemarks   = ' ';
              $RequestRequestDetails->save(); 
           
    //}





  }


  public function  CustomerAcceptedCoverage($id, request $request)
  {
    
    $PassData = explode(';;' ,trim($id));
   // $ProductLinesPerils      = ProductLinesPerils::select('*')->where('Active','1')->orderBy('Section','ASC')->groupBy('Section')->get();
    $ProductLinesPerils      = RequestCoverages::select('*')->where('RequestNo', $PassData[0])->where('Active','1')->orderBy('Section','ASC')->groupBy('Section')->get();
  
    $RequestCoverage         = RequestCoverages::select('*')->where('RequestNo',trim($PassData[0]))->where('Status',4)->where('CoveragesPremium','!=',0)->groupBy('OptionNo')->get();
     
    foreach($ProductLinesPerils as $ProductLinesPerilss)
    { 
     
     foreach($RequestCoverage as $RequestCoverages)
      { 
        //echo $RequestCoverages->RequestNo;  
         
         $GetAllRequestCoverages = RequestCoverages::select('*') 
              ->where('Active','1')
              ->where('Status',4)
              //->where('RequestModifyCoverages',0)
              //->where('RequestModify',0)
              ->where('RequestNo',trim($PassData[0]))
              ->where('PerilsCode','!=','TF')
              ->where('CoveragesPremium','!=',0)  
              ->where('Section',$ProductLinesPerilss->Section)              
              ->where('OptionNo',$RequestCoverages->OptionNo)
              ->orderBy('Section','ASC')
              ->orderBy('Sort','ASC')
              ->get();
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
                        'ComputeCoveagesAmount' => $ComputeCoveragesAmount,
                        'Description'           => $GetAllRequestCoveragess->Description,
                        'CoverageSection'       => $GetAllRequestCoveragess->Section,
						
                        
                        
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
                        'Belong'                => $GetClauses->Belong,
                        'ClausesRequired'       => $GetClauses->ClausesRequired,
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


        }
        
   

            //$user = Auth::user();
            $Case[] = [
                       '_id'                          => $RequestCoverages->_id,
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
                            'CoveragesPremium'      => $CoveragesPremium, 
                            'PremiumAmount'         => $GetAllRequestCoveragess->PremiumAmount,
                            'CoveragesAmount'       => $ComputeCoveragesAmount,
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
                        'CoverageRates'	        		    => $GetAllRequestCoveragess->CoverageRates,
                        'ListCoverages' 		            => $Coverages,
                        'ListCharges' 		              => $Charges
                
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


    
  


  public function ListApproverQuotation($id)
    {
		 //return Userrole::select('*')->where('RoleAlias', 'AQ')->where('Limit', '>=',round($id))->where('active', '1')->paginate(15);
     //$Userrole = Userrole::select('*')->where('RoleAlias', 'AQ')->where('Limit', '>=',round($id))->where('active', '1')->get();
       
     
     $Userrole = Userrole::select('*')->where('RoleAlias', 'AQ')->where('active', '1')->get();
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
      $this->DetectExpirationQuotation();
          $QueryData        = explode(';;' ,$id);
          //$QueryData        = 'test1@gmail.com';
          $RequestDetails   = RequestDetails::select('*')->where('Active', '1')->where('CustAcctNO',$QueryData[1])->get();  
          foreach($RequestDetails as $RequestDetailss)
            { 
              $GetAllRequestCoverages = RequestCoverages::select('*') 
              ->where('Active','1')
             //->where('RequestNo',$RequestDetailss->RequestNo)
              ->where('CoveragesPremium','!=',0) 
              //->where('AccountNo',trim($QueryData[0]))
              //->where('Approver','!=',null)
              //->where('Status',3)
              //->orderBy('Sort','ASC')
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
                          'AmountDue'					            => $RequestDetailss->AmountDue,
                          'QuoteExpiry'					          => $RequestDetailss->QuoteExpiry,
                          'QuoteExpiryRemarks'					  => $RequestDetailss->QuoteExpiryRemarks,
                          'CustMessage'					          => $RequestDetailss->CustMessage,
                          'RequestModify'					        => $RequestDetailss->RequestModify,
                          'AcceptedOption'					      => $RequestDetailss->AcceptedOption,
    
    
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
     $CompCoveragesPremium  = 0; $CompChargesPremium   = 0; $TotalCoverages = 0; 
    $RequestCoverages                = RequestCoverages::where('OptionNo',round($AcceptData[0]))->where('RequestNo',$AcceptData[1])->get();
    $CAmountODTF = 0 ;  $PAmountODTF = 0;
    foreach($RequestCoverages as $RequestCoveragess){ 
      if ( $RequestCoveragess->PerilsCode == 'OD' || $RequestCoveragess->PerilsCode == 'TF'  ){
            $CAmountODTF    += $RequestCoveragess->CoveragesAmount;
            $PAmountODTF    += $RequestCoveragess->CoveragesPremium;
      }else{
        $CAmountODTF  =  0 ; $PAmountODTF =0;
      }              
              $RequestCoveragess->Status                 = 4 ; //user accepted
              $RequestCoveragess->ClientRemarks          = $AcceptData[2];
              $RequestCoveragess->ClientRemarksDate      = $CurrentDate ;
              //$RequestCoveragess->CAmountODTF            = $CAmountODTF ;
              //$RequestCoveragess->PAmountODTF            = $PAmountODTF ;
              $RequestCoveragess->save(); 
              $CompCoveragesPremium += $RequestCoveragess->CoveragesPremium  ;
              $TotalCoverages += $RequestCoveragess->CoveragesAmount  ;
    }


    $RequestCharges                = RequestCharges::where('OptionNo',round($AcceptData[0]))->where('RequestNo',$AcceptData[1])->get();
    foreach($RequestCharges as $RequestChargess){ 
              $RequestChargess->Status        = 4 ; //accepted by the customer
              $RequestChargess->save(); 
              $CompChargesPremium += $RequestChargess->ChargesPremium  ;
    }

              $RequestDetails                      = RequestDetails::where('RequestNo',$AcceptData[1])->first();
              $RequestDetails->Status              = "Accepted";
              $RequestDetails->PremiumAmount       = $CompCoveragesPremium;
              $RequestDetails->TotalCoverages      = $TotalCoverages ;
              $RequestDetails->TotalCharges        = $CompChargesPremium;
              $RequestDetails->AmountDue           = $CompChargesPremium  + $CompCoveragesPremium;
              $RequestDetails->AcceptedOption     = round($AcceptData[0]);
              $RequestDetails->MvFileNo           = $request['mvFileNo'];
              $RequestDetails->EngineNo           = $request['engineNo'];
              $RequestDetails->ChassisNo          = $request['chassisNo'];
              $RequestDetails->Mortgage           = $request['mortgage'];
              $RequestDetails->MortgageBankName   = $request['bankName'];
			        $RequestDetails->BodyColor          = $request['color'];
              $RequestDetails->MortgageBankAddress  = $request['bankNameAddress'];
              $RequestDetails->HardCopy           = $request['hardCopy'];
              $RequestDetails->NormalDelivery     = $request['delivery'];
              $RequestDetails->PaymentGateway     = $request['PaymentGateway'];
              $RequestDetails->DeliveryAddress    = $request['deliveryAddress'];
              $RequestDetails->Address            = $request['address'];
              $RequestDetails->Barangay           = $request['barangay'];
              $RequestDetails->City               = $request['city'];
              $RequestDetails->AutoRenew          = $request['AutoRenew'];
              $RequestDetails->ForSignature       = 0;
              $RequestDetails->AcceptanceDate     = $CurrentDate ;
              
             
              $RequestDetails->save(); 
            
             
              
              if ($RequestDetails->LateDaysNo != 0 ){ 
                    $ClausesWarranties         =  ClausesWarranties ::where('Active',1)->where('Belong','No Known')->get(); 
                    $GetRequestDetails         = RequestDetails::where('RequestNo',$AcceptData[1])->first();
                    //$DateSave                  = $GetRequestDetails->MotorEffectiveDate;
                    $date= date_create($GetRequestDetails->MotorEffectiveDate);
                    $date1= date_create($CurrentDate);
                    //echo date_format($date,"F d, Y");
                    $DateSave                     = date_format($date,"F d, Y");
                    $DateSave1                    = date_format($date1,"F d, Y");
                    foreach($ClausesWarranties as $ClausesWarrantiess){ 
                      $ClausesStatementNoKNow    = str_replace("July 1, 2019",$DateSave, trim($ClausesWarrantiess->Statement));
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
                  
                  $ComputeAmount  = ($RequestCoverages->CoveragesAmount *  ($Accessoriess->Formula1 / $Accessoriess->ForType  )) * ($Accessoriess->Formula2 / $Accessoriess->ForType);
                  
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
                         $RequestAccessories->CoverageAmount          = $RequestCoverages->CoveragesAmount;
                         
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
          //$RequestCoverages   = RequestCoverages::where('RequestNo',$PassData[0])->where('OptionNo',round($PassData[3]))->get();
          $RequestCoverages   = RequestCoverages::where('RequestNo',$PassData[0])->get();
          foreach($RequestCoverages as $RequestCoveragess){
              $RequestCoveragess->RequestModify                  = 1;
              $RequestCoveragess->RequestModifyCoverages          = 1 ;
              $RequestCoveragess->RequestModifyPassByAcctNo      =trim($PassData[1]); 
              $RequestCoveragess->RequestModifyPassByName        =$PassData[2]; 
              $RequestCoveragess->RequestModifyRemarks           =$PassData[4];
             
              //$RequestCoverages->RequestModify                   = 1 ;
             
              $RequestCoveragess->save(); 
            //  return  $RequestCoveragess->Active    ; 
        }
		
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
                      
                      $CoveragesTotalAmount  += $GetAllRequestCoveragess->TotalPremiumAmount;
                          $Coverages[] = [
                            '_id'                   => $GetAllRequestCoveragess->_id,
                            'Status'                => $GetAllRequestCoveragess->Status,
                            'Active'                => $GetAllRequestCoveragess->Active,
                            'CoveragesName'         => $GetAllRequestCoveragess->CoveragesName,
                            'CoveragesPremium'      => $CoveragesPremium, 
                            'PremiumAmount'         => $GetAllRequestCoveragess->PremiumAmount,
                            'CoveragesAmount'       => $ComputeCoveragesAmount, //$GetAllRequestCoveragess->CoveragesAmount,
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
                            //'RequestModify'   		=> $GetAllRequestCoveragess->CoverageRates,   
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
                        'OptionNo'					      => $RequestCoverages->OptionNo,
                        'RequestNo'					      => $GetAllRequestCoveragess->RequestNo, 
						'CoverageRates'	        		  => $GetAllRequestCoveragess->CoverageRates,
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
     // $CountCoverages = RequestCoverages::count() + 1;
          for($k=0 ;$k < count($PerilsNameForDisplay)  ;$k++)
          {    
            $RequestCoverageGetPremiumAmount      = RequestCoverages::select('*')->where('RequestNo',trim($id))->where('CoveragesName',$request['ToSAvedAmountRequestADD'][$k])->where('OptionNo',$RequestCoverageORDER->OptionNo)->first();  
            $ProductLinesPerils                   = ProductLinesPerils::where('PerilsNo',trim($request['ToSAvedAmountRequestADD'][$k]))->first();
			      $PerilsDescription    = str_replace("4",$request['passengers'], trim($ProductLinesPerils->Description));
            $RequestCoverages = new RequestCoverages;
                   // $RequestCoverages->CoveragesNo             = $CountCoverages;
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
                          $RequestCharges->Active                      = '1' ;
                          $RequestCharges->save(); 
                  }
                  $OptionNumber = $RequestCoverageORDER->OptionNo + 1;
                  $RequestCoverages                = RequestCoverages::where('RequestNo',trim($id))->where('OptionNo',$OptionNumber)->get();
                  $CAmountODTF = 0 ;  $PAmountODTF = 0;
                  foreach($RequestCoverages as $RequestCoveragess){ 
                          if ( $RequestCoveragess->PerilsCode == 'OD' || $RequestCoveragess->PerilsCode == 'TF'  ){
                                $CAmountODTF    += $RequestCoveragess->CoveragesAmount;
                                $PAmountODTF    += $RequestCoveragess->CoveragesPremium;
                          }else{
                            $CAmountODTF  =  0 ; $PAmountODTF =0;
                          }              
                                
                                
                                  $RequestCoveragess->CAmountODTF            = $CAmountODTF ;
                                  $RequestCoveragess->PAmountODTF            = $PAmountODTF ;
                                  $RequestCoveragess->save();
                     
                  }
                  
                  
                  $OptionNumber = $RequestCoverageORDER->OptionNo + 1;
                  $RequestCoverages                = RequestCoverages::where('RequestNo',trim($id))->where('OptionNo',$OptionNumber)->get();
                  $CAmountODTF = 0 ;  $PAmountODTF = 0;
                  foreach($RequestCoverages as $RequestCoveragess){ 
                          if ( $RequestCoveragess->PerilsCode == 'OD' || $RequestCoveragess->PerilsCode == 'TF'  ){
                                $CAmountODTF    += $RequestCoveragess->CoveragesAmount;
                                $PAmountODTF    += $RequestCoveragess->CoveragesPremium;
                          }else{
                            $CAmountODTF  =  0 ; $PAmountODTF =0;
                          }              
                                
                                
                                  $RequestCoveragess->CAmountODTF            = $CAmountODTF ;
                                  $RequestCoveragess->PAmountODTF            = $PAmountODTF ;
                                  $RequestCoveragess->save();
                     
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
     $RequestCoverage         = RequestCoverages::select('*')->where('RequestNo',trim($PassData[0]))->whereIn('Status',[4,3])->where('CoveragesPremium','!=',0)->groupBy('OptionNo')->get();
     $Case = array();
     foreach($RequestCoverage as $RequestCoverages)
      { 
        //echo $RequestCoverages->RequestNo;      
         $GetAllRequestCoverages = RequestCoverages::select('*') 
               ->where('Active','1')
               ->whereIn('Status',[4,3])
               //->where('Status',4)
               //->where('RequestModify',1)
               ->where('RequestNo',trim($PassData[0]))
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
                      if ( $GetAllRequestCoveragess->PerilsCode == 'OD'  ){
                          $ComputeCoveragesAmount = $GetAllRequestCoveragess->CAmountODTF ;
                          $CoveragesPremium       = $GetAllRequestCoveragess->PAmountODTF;
                      }else{
                          $ComputeCoveragesAmount  = $GetAllRequestCoveragess->CoveragesAmount;
                          $CoveragesPremium        = $GetAllRequestCoveragess->CoveragesPremium;
                      } 


                      if ( $GetAllRequestCoveragess->PerilsCode == 'AOG'  ){
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
                      'OptionNo'					   => $RequestCoverages->OptionNo,
                      'RequestNo'					   => $GetAllRequestCoveragess->RequestNo,  
                      'CoverageRates'	        		      => $GetAllRequestCoveragess->CoverageRates,
                    
                      'ListCoverages' 		           => $Coverages,
                      'ListCharges' 		           => $Charges,
                      'ClausesWarranties' 		       => $ClausesWarranties,
                      'Accessories' 		           => $Accessories,
              
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
                          'CoveragesAmount'       => $ComputeCoveragesAmount,
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

                      'CoverageRates'	        		      => $GetAllRequestCoveragess->CoverageRates,
                      'ListCoverages' 		              => $Coverages,
                      'ListCharges' 		                => $Charges
              
                    ] ;						
        }
      return response()->json($Case);	
   
  }

  


  public function GetIssuanceForSignature()
  {
      //$this->DetectExpirationQuotation();
      return RequestDetails::select('*')->where('Active', '1')->where('ForSignature',1)->paginate(15);
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
              $RequestDetails->IssuanceRemarks      = $PassData[5];
              
              $RequestDetails->save(); 
  }


  public function GetListSignatory()
  {
 
      //return Userrole::select('*')->where('Active','1')->where('RoleAlias','AI')->paginate(2);
                $Userrole = Userrole::select('*') 
                ->where('active',"1")
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
  public function LogsReport()
  {

        $id = "2019-0003";
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
                            'CoveragesPremium'      => $GetAllRequestCoveragess->CoveragesPremium, 
                            //'CoveragesPremium'      => $CoveragesPremium , 
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
                        'ListCharges' 		                => $Charges
                
                      ] ;						
          }
        return response()->json($Case);	
     
    }

    public function Wordings()
    {
      return ClausesWarranties::select('*')->where('Belong', 'Proposal')->first();
    }


    public function ISAPInternalAuth()
    {
        return view('InternalAuthentication');
    }



  
	
}
