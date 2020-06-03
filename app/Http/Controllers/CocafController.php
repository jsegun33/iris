<?php

namespace App\Http\Controllers;
use Artisaninweb\SoapWrapper\SoapWrapper;
use SoapClient;
use App\RequestDetails;
use App\Authentication;

use App\Soap\Request\GetConversionAmount;
use App\Soap\Response\GetConversionAmountResponse;



class CocafController
{
   
    protected $soapWrapper;

    /**
     * SoapController constructor.
     *
     * @param SoapWrapper $soapWrapper
     */
    public function __construct(SoapWrapper $soapWrapper)
    {
      $this->soapWrapper = $soapWrapper;
    }
  
    /**
     * Use the SoapWrapper
     */

    public function TestCocafVerify($id) 
    {
      $PassData   = explode(';;' ,$id);
     
      $service_param = array (
            'cocNo'         => $PassData[1],   //Live username
            'username'    => 'hperalta',
            'password'    => 'psalms',
           
            );
            
            // $request_param = array (
            // 'Request' => $service_param
            // );
        
       // $url    = 'https://www.isapcocas.ph/isapdev2_api/services/cocVerification?wsdl';   //working if live  cocVerification
         $url    = 'https://cocaftest1.cloudapp.net/isapdev2_api/services/cocVerification?WSDL';  ///error test api   http://127.0.0.1:8001/
         //   $url = "https://cocaftest1.cloudapp.net/isapdev2_api/services/cocRegistration?wsdl";
          $options = [
            'cache_wsdl'     => WSDL_CACHE_NONE,
            'trace'          => 1,
            'stream_context' => stream_context_create(
                [
                    'ssl' => [
                        'verify_peer'       => false,
                        'verify_peer_name'  => false,
                        'allow_self_signed' => true
                    ]
                ]
            )
        ];
        
        $client = new SoapClient($url, $options);
          $response = $client->verify(array('arg0' => $service_param));
      //  var_dump($response );
    //  $result = json_decode($response, true);
      $result = json_decode(json_encode($response), true);
      foreach($result as $row => $value)  
      { 
         $authNo =  $value['authNo'] ;

         $Authentication                              = Authentication::where('RequestNo',$PassData[0])->first();
         $Authentication->AuthCode                    = $authNo;
         $Authentication->Code                        = '1';
         $Authentication->save(); 
   
         $RequestDetails                              = RequestDetails::where('RequestNo',$PassData[0])->first();
         $RequestDetails->AuthCodeRequest             = $authNo;
         $RequestDetails->save(); 
   

        // echo $authNo ;
      }
       // dd($result);
        
           
}
   
public function TestCocafRegistration() 
    {   // <regType>R</regType> 10

$service_param = array(
            'cocNo'         => '086AA001118A',   //12 char
            'plateNo'       => 'LC82309',
            'mvFileNo'      => '110100000143648',
            'engineNo'      => '2MC012624',
            'chassisNo'     => 'PA02MC000E0005919',
            'inceptionDate' => '06/01/2020',
            'expiryDate'    => '06/01/2021',
            'regType'       => 'R',
            'mvType'        => 'M',
            'mvPremType'    => '7',   //AMount 
            'taxType'       => '1',
            'assuredName'   => 'Iris Jane',
            'assuredTin'    => '123-456-789-000',

            'username'    => 'hperalta',
            'password'    => 'psalms',
          );
          //$this->set_tags($tags);  086AA001117A
          
     $url = "https://cocaftest1.cloudapp.net/isapdev2_api/services/cocRegistration?wsdl";
            $options = [
              'cache_wsdl'     => WSDL_CACHE_NONE,
              'trace'          => 1,
              'stream_context' => stream_context_create(
                  [
                      'ssl' => [
                          'verify_peer'       => false,
                          'verify_peer_name'  => false,
                          'allow_self_signed' => true
                      ]
                  ]
              )
          ];

          $client = new SoapClient($url, $options);
            $response = $client->register(array('arg0' => $service_param));

         // $authNo  =  $response->authNo;
          
      

  }



    public function TestKLVerify() 
    {

      $clientOptions = array(
        'exceptions' => true,
    );


//try {
$url    = 'https://api.hotellinksolutions.com/services/booking/soap?wsdl';
$client = new SoapClient($url, $clientOptions);


          $CurrentDate = date("Y-m-d");
          $CurrentDateHrs = date("Y-m-d H:i:s");
          $AddCurrentDate = strtotime(date("Y-m-d", strtotime($CurrentDate)) . "+12 months");
          $MinusCurrentDate = date("Y-m-d", strtotime('-31 days') );  
          
          $user_param = array (
          'ChannelManagerUsername'        => "iristech",
          'ChannelManagerPassword'        => "7DrAVFaBZx%Yt",
          'HotelId'                       => "eb8b7b09-87fd-1543977724-4b85-97b5-764ccd97b70d",
          'HotelAuthenticationChannelKey' => "f2f76545ab1553d6dde9a7ad3065692c"
          );



        $service_param = array (
          'StartDate' => $MinusCurrentDate,
          'EndDate' => $AddCurrentDate,
          'DateFilter' => 'BookingDate',
          'BookingStatus' => '', 
          'BookingId' => '',
          'ExtBookingRef' => '',
          'NumberBookings' => '',
          'Credential' => $user_param,
          'Language' => 'en',
          "ErrorMsg" => NULL,
         // 'exceptions' => true,
        );
        
        $request_param = array (
          'Request' => $service_param
        );

        $array          = $client->__soapCall("GetBookings",array($request_param));
        $valueResponse  =   $client->__getLastRequest();

        $arrays 			= json_decode(json_encode($array->GetBookingsResult->Bookings), true);

   
        dd($arrays);


    }
    public function TestCocafRegistration1() 
    {   // <regType>R</regType>

$service_param = array(
            'cocNo'         => '086AA001117A',
            'plateNo'       => 'LC82309',
            'mvFileNo'      => '110100000143648',
            'engineNo'      => '2MC012624',
            'chassisNo'     => 'PA02MC000E0005919',
            'inceptionDate' => '06/01/2020',
            'expiryDate'    => '06/01/2021',
            'regType'       => 'R',
            'mvType'        => 'M',
            'mvPremType'    => '7',   //AMount 
            'taxType'       => '1',  
            'assuredName'   => 'Iris Jane',
            'assuredTin'    => '123-456-789-000',

            'username'    => 'hperalta',
            'password'    => 'psalms',
          );
          //$this->set_tags($tags);  086AA001117A
          
     $url = "https://cocaftest1.cloudapp.net/isapdev2_api/services/cocRegistration?wsdl";
            $options = [
              'cache_wsdl'     => WSDL_CACHE_NONE,
              'trace'          => 1,
              'stream_context' => stream_context_create(
                  [
                      'ssl' => [
                          'verify_peer'       => false,
                          'verify_peer_name'  => false,
                          'allow_self_signed' => true
                      ]
                  ]
              )
          ];

          $client = new SoapClient($url, $options);
            $response = $client->register(array('arg0' => $service_param));
          var_dump($response );

  }


    public function testcocaf_api() 
    {
      $this->soapWrapper->add('Currency', function ($service) {
            $service
              ->wsdl('http://currencyconverter.kowabunga.net/converter.asmx?WSDL')
              ->trace(true)
              ->options([
                'user_agent' => 'PHPSoapClient',      // Add this as options
                ])  
              ->classmap([
                GetConversionAmount::class,
                GetConversionAmountResponse::class,
              ]);
          });
  
          // Without classmap
          $response = $this->soapWrapper->call('Currency.GetConversionAmount', [
            'CurrencyFrom' => 'USD', 
            'CurrencyTo'   => 'EUR', 
            'RateDate'     => '2014-06-05', 
            'Amount'       => '1000',
          ]);
         // dd($response);
          var_dump($response);
      
          // With classmap
          $response = $this->soapWrapper->call('Currency.GetConversionAmount', [
            new GetConversionAmount('USD', 'EUR', '2014-06-05', '1000')
          ]);
      
          var_dump($response);
          exit;
        }

        public function testAgainApi() 
        {
            $clientOptions = array(
                'exceptions' => true,
                'user_agent' => 'PHPSoapClient',  
            );
     
       
            //$client = new SoapClient($url, $clientOptions);

            $tags = array(
                'username'   => 'hperalta',
                'password'=> 'psalms',
                'cocNo'         => '086000112B',
                'plateNo'       => 'GFasdf',
                'mvFileNo'      => '12341234',
                'engineNo'      => 'X',
                'chassisNo'     => 'X',
                'inceptionDate' => '09/07/2015',
                'expiryDate'    => '09/07/2016',
                'mvType'        => 'C',
                'mvPremType'    => '1',
                'taxType'       => '1',
                'assuredName'   => 'MARIACLARA',
                'assuredTin'    => '123-456-789-000',
              );
                
              $url    = 'https://cocaftest1.cloudapp.net/isapdev2_api/services/cocVerification?wsdl';
              $client =  new SoapClient($url, $clientOptions);

              $response = $this->_execute($client,$tags);

            dd($client);
        
        }

        public function testAgainCURL() 
        {

        // $curl = curl_init('https://cocaftest1.cloudapp.net/isapdev2_api/services/cocVerification?wsdl');
        //     curl_setopt($curl, CURLOPT_HEADER, 1);
        //     curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        //     curl_setopt($curl, CURLOPT_TIMEOUT, 30);
        //     curl_setopt($curl, CURLOPT_PROXY, 'myproxy');	
        //     $R = curl_exec($curl);
        //     dd($R);

        // $options = array(
        //     'cache_wsdl' => 0,
        //     'trace' => 1,
        //     'stream_context' => stream_context_create(array(
        //           'ssl' => array(
        //                'verify_peer' => false,
        //                 'verify_peer_name' => false,
        //                 'allow_self_signed' => true
        //           )
        //           ));


        //$url = ("https://cocaftest1.cloudapp.net/isapdev2_api/services/cocVerification?wsdl", array('username'=> "hperalta",'password'       => "psalms"));
        //$client->__soapCall("getStudentList", array("std_id1"));

        $url = 'https://cocaftest1.cloudapp.net/isapdev2_api/services/cocVerification?wsdl';    

    //  $options = array(
    //     'cache_wsdl' => 0,
    //     'trace' => 1,
    //     'stream_context' => stream_context_create(array(
    //           'ssl' => array(
    //                'verify_peer' => false,
    //                 'verify_peer_name' => false,
    //                 'allow_self_signed' => true
    //           )
    //           ));

     $options = array(
                'exceptions' => true,
                'cache_wsdl' => 0,
                'trace' => 1,
                'user_agent' => 'PHPSoapClient', 
                // 'ssl' => array(
                //     'verify_peer' => false,
                //      'verify_peer_name' => false,
                //      'allow_self_signed' => true,
               // ),
                // 'stream_context' => 
                //         stream_context_create(array(
                //               'ssl' => array(
                //                    'verify_peer' => false,
                //                     'verify_peer_name' => false,
                //                     'allow_self_signed' => true,
                //               );
                //             );,

            );

    
    $client = new SoapClient($url, $options);


    $param1 = "hperalta";
    $param2 = "psalms";

    $response = $client->loginVerify($param1, $param2);    

    //var_dump($response);
        dd($response);
          
        }
}
