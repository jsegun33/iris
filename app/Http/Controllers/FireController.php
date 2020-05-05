<?php

namespace App\Http\Controllers;
//namespace App\FireModel;

use App\FireModel;

use App\FireModel\FirePerils;
use App\FireModel\FirePerilsSub;
use App\FireModel\FireRequestCoverages;
use App\FireModel\FireRequestDetails;
use App\FireModel\FireCharges;
use App\FireModel\FireRequestCharges;

use File; 

use Illuminate\Http\Request;

class FireController extends Controller
{
    public function GetFirePerils()
    {
                    $FirePerils =  FirePerils::select('*')
                            ->where('active',1)
                            ->orderBy('PerilsDecription')
                            ->get();
                        $FirePerilsArray = array();
                        foreach($FirePerils as $FirePerilss)
                        { 
                            $FirePerilsArray[] = [
                                '_id'	  	  	                => $FirePerilss->_id,
                                'status'	  	  	            => $FirePerilss->status,
                                'PerilsCode'	  	            => $FirePerilss->PerilsCode,
                                'PerilsAcct'	  	            => $FirePerilss->PerilsAcct,
                                'PerilsDecription'	  	        => $FirePerilss->PerilsDecription,
                            
                            ] ;
                        
                            
                        }
                        return response()->json($FirePerilsArray);	
    }


    public function LoadPerilsSub()
    {
                    $FirePerilsSub =  FirePerilsSub::select('*')
                            ->where('active',1)
                            ->where('active',1)
                            ->orderBy('SubName')
                            ->get();
                        $FirePerilsSubArray = array();
                        foreach($FirePerilsSub as $FirePerilsSubs)
                        { 
                            $FirePerilsSubArray[] = [
                                '_id'	  	  	                => $FirePerilsSubs->_id,
                                'status'	  	  	            => $FirePerilsSubs->status,
                                'SubName'	  	                => $FirePerilsSubs->SubName,
                                'SubAcct'	  	                => $FirePerilsSubs->SubAcct,
                                'RateSub'	  	                => $FirePerilsSubs->RateSub,
                            
                            ] ;
                        
                            
                        }
                        return response()->json($FirePerilsSubArray);	
    }

    public function  FireRequestQuotation(Request $request)
    
    {
        date_default_timezone_set('Asia/Hong_Kong');

        $curYear = date('Y'); 
        $CountUser = FireRequestDetails::count() + 1;
     
        $NewCountUser = str_pad($CountUser, 4, '0' , STR_PAD_LEFT); 
       
        $AccountNo =  $curYear. "-FIRE-".$NewCountUser;    


        // $this->validate($request['ImgBounderyLeft'] ,[

        //     'photo' => 'required|mimes:jpg,jpeg,png,bmp,tif'

        //     ]);
        
        $path = public_path('Fire/'.$AccountNo);
   
        if(!File::isDirectory($path)){
            File::makeDirectory($path, 493, true, true);
        }
           

        if($request['ImgBounderyLeft'])
        {
          // $image = $request->get('image');
           $image =  $request['ImgBounderyLeft'];
           $ImgBounderyLeft = "BounderyLeft" .'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1]; //time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
           
             \Image::make($request['ImgBounderyLeft'])->fit(400,400)->save( $path .'/'. $ImgBounderyLeft);
         
         }


         if($request['ImgBounderyRight'])
         {
           // $image = $request->get('image');
            $image              =  $request['ImgBounderyRight'];
            $ImgBounderyRight   = "BounderyRight" .'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1]; //time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
           
              \Image::make($request['ImgBounderyRight'])->fit(400,400)->save( $path .'/'. $ImgBounderyRight);
          
          }


          if($request['ImgBounderyFront'])
          {
            // $image = $request->get('image');
             $image              =  $request['ImgBounderyFront'];
             $ImgBounderyFront   = "BounderyFront" .'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1]; //time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
            
               \Image::make($request['ImgBounderyFront'])->fit(400,400)->save( $path .'/'. $ImgBounderyFront);
           
           }


           if($request['ImgBounderyRear'])
          {
            // $image = $request->get('image');
             $image              =  $request['ImgBounderyRear'];
             $ImgBounderyRear   = "BounderyRear" .'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1]; //time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
            
               \Image::make($request['ImgBounderyRear'])->fit(400,400)->save( $path .'/'. $ImgBounderyRear);
           
           }

           $PerilsNameSub    = explode(";;",$request['PerilsNameSub']);   
            $FireRequestDetails   = new FireRequestDetails;
           
            $FireRequestDetails->UserAcctNo             = $request['UserAcctNo'];
            $FireRequestDetails->UserAcctName           = $request['UserAcctName'];
            $FireRequestDetails->AssuredName            = $request['PropertyAssuredName'];
            $FireRequestDetails->RequestNo              = $AccountNo;
            $FireRequestDetails->active                 = 1;
            $FireRequestDetails->status                 = 1; 
            $FireRequestDetails->MarketValue            = round($request['MarketValue']);
            $FireRequestDetails->EffectiveDate          = $request['EffectiveDate'];
            $FireRequestDetails->ExpiryeDate            = $request['ExpiryeDate'];
            $FireRequestDetails->PropertyAddress        = $request['PropertyAddress'];
            $FireRequestDetails->PropertyAddressCity    = $request['PropertyAddressCity'];
            $FireRequestDetails->PropertyAddressBarangay= $request['PropertyAddressBarangay'];
            $FireRequestDetails->TINNumber              = $request['TINNumber'];
            $FireRequestDetails->EmailAddress           = $request['EmailAddress'];
            $FireRequestDetails->ContactNumber          = $request['ContactNumber'];
            $FireRequestDetails->FirstName              = $request['FirstName'];
            $FireRequestDetails->MiddleName             = $request['MiddleName'];
            $FireRequestDetails->LastName               = $request['LastName'];
            $FireRequestDetails->CName                  = $request['FirstName'] . " " . $request['MiddleName'] . $request['LastName'];
            $FireRequestDetails->PersonalAddress        = $request['PersonalAddress'];
            $FireRequestDetails->PersonalAddressCity    = $request['PersonalAddressCity'];
            $FireRequestDetails->PersonalAddressBarangay= $request['PersonalAddressBarangay'];
            $FireRequestDetails->ImgBounderyLeft        = $ImgBounderyLeft;
            $FireRequestDetails->ImgBounderyRight       = $ImgBounderyRight;
            $FireRequestDetails->ImgBounderyFront       = $ImgBounderyFront;
            $FireRequestDetails->ImgBounderyRear        = $ImgBounderyRear;
            $FireRequestDetails->BusinessType           = $PerilsNameSub[1] ;
           $FireRequestDetails->save(); 

           $TotalPremium = 0 ;  $TotalPremiumCharges= 0 ;  
            
           //-------Coverages
           
            $TotalFireCoverages        = $request['FireCoverages'];
            for($i=0;$i <  count($TotalFireCoverages) ;$i++)
            {
              
                  $PerilsNameSub    = explode(";;",$request['PerilsNameSub']);   
                   $FirePerils = FirePerils::where('_id',$request['FireCoverages'][$i])->first();
                  
                   $CompPremium             =    $request['MarketValue']  . $FirePerils->Formula ;
                   $CoveragesPremium        =     eval('return '.$CompPremium.';'); //computation

                   
                    $FireRequestCoverages   = new FireRequestCoverages;

                    $FireRequestCoverages->RequestNo               = $AccountNo;
                    $FireRequestCoverages->CName                     = $request['FirstName'] . " " . $request['MiddleName'] . $request['LastName'];
                    $FireRequestCoverages->AssuredName               = $request['PropertyAssuredName'];
                    $FireRequestCoverages->PropertyAddress          = $request['PropertyAddress'];
                    $FireRequestCoverages->PerilsCode              =  $FirePerils->PerilsCode ;
                    $FireRequestCoverages->PerilsAcct              = $FirePerils->PerilsAcct ;
                 
                    $FireRequestCoverages->PerilsDecription        = $FirePerils->PerilsDecription ;
                    $FireRequestCoverages->Rate                    = $FirePerils->Rate ;
                    $FireRequestCoverages->Formula                 = $FirePerils->Formula ;

                    $FireRequestCoverages->MarketValue             = round($request['MarketValue'],2);
                    $FireRequestCoverages->CoveragesPremium        = round($CoveragesPremium,2);
                    
                    $FireRequestCoverages->OptionNo                =  1;
                    $FireRequestCoverages->active                    = 1;
                    $FireRequestCoverages->status                    = 1; 
                    

                    $FireRequestCoverages->SubAcct                  = $PerilsNameSub[0];
                    $FireRequestCoverages->SubName                  = $PerilsNameSub[1] ;
                    $FireRequestCoverages->RateSub                  = round($PerilsNameSub[2],2); 
                    $FireRequestCoverages->save(); 
                
                    $TotalPremium += $CoveragesPremium;
            }
            
            //-----Charges

           // FireRequestCharges

            $FireCharges = FireCharges::where('status',1)->get();
            foreach($FireCharges as $FireChargess){
                  
                    $CompPremiumCharges             =    $TotalPremium . $FireChargess->Formula ;
                    $ChargesPremium                 =     eval('return '.$CompPremiumCharges.';'); //computation
                   
                    $FireRequestCharges   = new FireRequestCharges;
                    $FireRequestCharges->RequestNo              = $AccountNo; 
                    $FireRequestCharges->Formula                = $FireChargess->Formula ;
                    $FireRequestCharges->Description            = $FireChargess->Description ;
                    $FireRequestCharges->PolicyDisplay          = $FireChargess->PolicyDisplay ;
                    $FireRequestCharges->PremiumCharges         = round($ChargesPremium,2); 
                    $FireRequestCharges->TotalPremiumCoverages   = round($TotalPremium,2); 
                    $FireRequestCharges->save(); 
                    $TotalPremiumCharges += $ChargesPremium;
            }   
            ///---update charges

            
            $FireChargesUpdate = FireRequestCharges::where('RequestNo',$AccountNo)->get();
            foreach($FireChargesUpdate as $FireChargesUpdates){
                        $FireChargesUpdates->TotalPremium      = round($TotalPremiumCharges,2); 
                        $FireChargesUpdates->save(); 
            }

            //--Update Coverages
           
            $FireRequestCoveragesUpdate = FireRequestCoverages::where('RequestNo',$AccountNo)->get();
            foreach($FireRequestCoveragesUpdate as $FireRequestCoveragesUpdates){
                        $FireRequestCoveragesUpdates->TotalPremium           = round($TotalPremium,2); 
                        $FireRequestCoveragesUpdates->TotalAmountDue         = round($TotalPremium + $TotalPremiumCharges,2); 
                        $FireRequestCoveragesUpdates->save(); 
            }

   

    }
    public function FireGetUserRequest($id)
    {
            return FireRequestDetails::select('*')->where('status',1)->paginate(10);
    }

    public function FireGetUserRequestPaging()
    {
            return FireRequestDetails::select('*')->where('status',1)->paginate(10);
    }


    public function  ProposalViewFire($id, request $request)
    {
      
      $PassData = explode(';;' ,trim($id));
          $RequestCoverage         = FireRequestCoverages::select('*')->where('RequestNo',trim($PassData[0]))->groupBy('OptionNo')->get();
       $Case = array();
       foreach($RequestCoverage as $RequestCoverages)
        { 
            
           $GetAllRequestCoverages = FireRequestCoverages::select('*') 
                 ->where('RequestNo',$PassData[0])
                // ->whereIn('Status',[4,3])
                ->get();
               
                $Coverages = array();
                    foreach($GetAllRequestCoverages as $GetAllRequestCoveragess){
                        $Coverages[] = [
                          '_id'                         => $GetAllRequestCoveragess->_id,
                          'PerilsCode'                  => $GetAllRequestCoveragess->PerilsCode,  
                          'PerilsAcct'                  => $GetAllRequestCoveragess->PerilsAcct,
                          'PerilsDecription'            => $GetAllRequestCoveragess->PerilsDecription,
                          'MarketValue'                 => $GetAllRequestCoveragess->MarketValue,
                          'CoveragesPremium'            => $GetAllRequestCoveragess->CoveragesPremium,
                          'SubAcct'                     => $GetAllRequestCoveragess->SubAcct,
                          'SubName'                     => $GetAllRequestCoveragess->SubName,
                          'RateSub'                     => $GetAllRequestCoveragess->RateSub,
                          'active'                      => $GetAllRequestCoveragess->active,
                          'status'                      => $GetAllRequestCoveragess->status,
                          'Rate'	        		    => $GetAllRequestCoveragess->Rate,
                          'TotalPremium'	        	=> $GetAllRequestCoveragess->TotalPremium,
                        
                          
                        ];
              }	

              $FireRequestCharges = FireRequestCharges::select('*') 
                 ->where('RequestNo',$PassData[0])
                // ->whereIn('Status',[4,3])
                ->get();
               
                $Charges = array();
                    foreach($FireRequestCharges as $FireRequestChargess){
                        $Charges[] = [
                          '_id'                         => $FireRequestChargess->_id,
                          'PremiumCharges'              => $FireRequestChargess->PremiumCharges,
                          'Description'                 => $FireRequestChargess->Description,
                          'PolicyDisplay'               => $FireRequestChargess->PolicyDisplay,
                       
                          
                        ];
              }	
  
            
          
              //$user = Auth::user();
              $Case[] = [
                         '_id'                                      => $RequestCoverages->_id,
                         'CName'                                    => $GetAllRequestCoveragess->CName,
                         'AssuredName'                              => $GetAllRequestCoveragess->AssuredName,
                         'AssignCRD'                                => $GetAllRequestCoveragess->AssignCRD,
                         'SubName'                                  => $GetAllRequestCoveragess->SubName,
                        'OptionNo'					                => $GetAllRequestCoveragess->OptionNo,
                        'RequestNo'					                => $GetAllRequestCoveragess->RequestNo,  
                        'Rate'	        		                    => $GetAllRequestCoveragess->Rate,
                        'TotalPremium'	        		            => $GetAllRequestCoveragess->TotalPremium,
                        'MarketValue'                               => $GetAllRequestCoveragess->MarketValue,
                        'TotalAmountDue'                            => $GetAllRequestCoveragess->TotalAmountDue,
                        'PropertyAddress'                           => $GetAllRequestCoveragess->PropertyAddress,
                        'ListCoverages' 		                    => $Coverages,
                        'ListCharges' 		                        => $Charges,
                      
                
                      ] ;						
          
        }
        return response()->json($Case);	
     
    }

    

    public function CreateDirectoryPic()
{
    $path = public_path('OR-CR/2020-0001');
   
   if(!File::isDirectory($path)){
        File::makeDirectory($path, 0777, true, true);
   }
   
    dd('done');
}



}
