<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Registration;
use App\Authority;
use App\Userrole;
use App\UserRoleAccess;
use App\AgentCom;
use App\User;
use Hash;

class RegistrationController extends Controller
{
    public function index()
    {
        /*$Registration   = new Registration;
        $authority      = $Registration
        ->where('active', 1)
        ->get();

        return  $authority;*/
        // return Authority::latest()->paginate(10);
        //return Registration::select('*')->where('active', '1')->get();
       // return Registration::with('users')->get();
       $Registration  =  Registration::select('*')->where('active', '1')->get();
       foreach($Registration as $Registrations)
       { 
                    $GetUserrole = Userrole::select('*') 
                    ->where('active',1)
                    ->where('status',1)
                    ->where('AccountNo',$Registrations->AccountNo)
                    ->orderBy('role_name','ASC')
                    ->get();
                    $UserRoles = array();
                foreach($GetUserrole as $GetUserroles){
                                $UserRoles[] = [
                                    'CName'		            => $GetUserroles->CName,
                                    'role_name'		        => $GetUserroles->role_name,
                                    'acctTypeName'		    => $GetUserroles->acctTypeName,
                                ] ;
                    }


                    $GetDataUserroleAccess = UserRoleAccess::select('*') 
                    ->where('active',1)
                    ->where('status',1)
                    ->where('AccountNo',$Registrations->AccountNo)
                    ->orderBy('role_name_access','ASC')
                    ->get();
                    $UserRolesAccess = array();
                foreach($GetDataUserroleAccess as $GetDataUserroleAccesss){
                                $UserRolesAccess[] = [
                                    'role_name_access'		=> $GetDataUserroleAccesss->role_name_access,
                                    'role_number_url'		=> $GetDataUserroleAccesss->role_number_url,
                                    'acctTypeSubName'		=> $GetDataUserroleAccesss->acctTypeSubName,
                                ] ;
                    }    

                      $GetUserDatas[] = [
                        '_id'                          => $Registrations->_id,
                       'user_fname'					   => $Registrations->user_fname,
                       'user_mname'					   => $Registrations->user_mname,  
                       'user_lname'					   => $Registrations->user_lname,  
                       'email'					       => $Registrations->email,  
                       'username'					   => $Registrations->username,  
                       'department'					   => $Registrations->department,  
                       'ApprovedLimit'			       => $Registrations->ApprovedLimit,  
                       'AccountNo'					   => $Registrations->AccountNo,  
                       'UserRoles' 		               => $UserRoles,
                       'UserRolesAccess' 		       => $UserRolesAccess,
                       
                    
               
                     ] ;				

        }	
        return response()->json($GetUserDatas);	



    }


    public function store(Request $request)
    {
      $curYear = date('Y'); 
      $CountUser = Registration::count() + 1;
      $NewCountUser = str_pad($CountUser, 4, '0' , STR_PAD_LEFT); 
      
      $AccountNo =  $curYear. "-".$NewCountUser;

      $request->validate([
        'username' => 'required',
        'password' => 'required'
    ]);

        $totalType        = $request['select_type'];

      for($i=0;$i <  count($totalType) ;$i++)
       {
           
           $totalAuthority         = $request['select_authority'][$i];
		   $totalSubTypes          = $request['select_SubTypes'][$i];
           $ExplodeType            = explode(";;",$request['select_type'][$i]);

           for($k=0 ;$k < count($totalAuthority)  ;$k++)
          { 
            
				$Newselect_authority    = explode(";;",$request['select_authority'][$i][$k]);
                $AType 	= substr($ExplodeType[0],0,1 );
				$Approver = substr($Newselect_authority[0],0,1);
				
				Userrole::create([
                        'AccountNo'        => $AccountNo,
                        'role_name'        =>  $Newselect_authority[0], //$request['select_authority'][$i][$k],
                        'role_number'      =>  $Newselect_authority[1], //$request['select_authority'][$i][$k], 
                        'active'           => 1,
                        'status'           => 1,
                        'acctTypeName'     =>   $ExplodeType[0], 
                        'acctType'         =>   $ExplodeType[1],
                        'icon_display'     =>   $ExplodeType[2],
                        'UnderSubMenu'     =>   $ExplodeType[3],
                        'UnderSubMenuName' =>   $ExplodeType[4],
						'RoleAlias'		   =>  strtoupper($Approver . $AType ) ,
                        'CName'		       =>  $request['firstname'] . ' ' . $request['lastname']  , 
                        'Limit'            =>  round($request['LimitAmount'])					
                        
                    ]);
          }
		   for($p=0 ;$p < count($totalSubTypes)  ;$p++)
          { 
            
				$Newselect_SubTypes    = explode(";;",$request['select_SubTypes'][$i][$p]);
				
                UserRoleAccess::create([
                        'AccountNo'        			=> 	$AccountNo,
                        'role_name_access'        	=>  $Newselect_SubTypes[0], //$request['select_authority'][$i][$k],
                        'role_number_access'      	=>  $Newselect_SubTypes[1], //$request['select_authority'][$i][$k], 
                        'role_number_url'           =>  $Newselect_SubTypes[2],
                        'icon_display'              =>  $Newselect_SubTypes[3],
                        'active'           			=> 1,
                        'status'           			=> 1,
                        'acctTypeSubName'     		=>  $ExplodeType[0], 
                        'acctTypeSub'         		=>  $ExplodeType[1],
                      
                        
                        
                        
                    ]);
          }
		  
      }
if ( !empty($request['AgentType'] ) ){


      ///-------Commission----------------------
      $TotalLines        = $request['ClassName'];
      //for($iL=0;$iL <  count($TotalLines) ;$iL++)
      //{

             $totalAmountComm        = $request['PassDataClassName'];
             for($kL=0 ;$kL < count($totalAmountComm)  ;$kL++)
            { 

                     $ClassName                  = explode(";;",$request['PassDataClassName'][$kL]);
                  //  $AmountComm                 = explode(";;",$request['PassDataAmountPerils'][$iL]);
                   // $AmountCommInput
                        AgentCom::create([
                        'AccountNo'        =>  $AccountNo,
                        'ClassName'        =>  $ClassName[0], //$request['select_authority'][$i][$k],
                        'Class'            =>  $ClassName[1], //$request['select_authority'][$i][$k], 
                        'active'           => '1',
                        'status'           => '1',
                        'PerilsName'       =>  $request['PassDataPerilsName'][$kL], 
                        'PerilsNo'         =>  $request['PassDataPerilsNo'][$kL], 
						'PerilsCode'	   =>  $request['PassDataPerilsCode'][$kL],  
                        'AmountCom'		   =>  round($request['PassDataAmountPerils'][$kL]),  
                       				
                        
                    ]);

           //  }

      }


    } //condition close if AGENT    
   $NewDepartment    = explode(";;",$request['select_department']);
        return Registration::create([
            'user_fname'          => $request['firstname'],
            'user_mname'          => $request['middlename'],
            'user_lname'          => $request['lastname'],
            'email'               => $request['email'],
            'username'            => $request['username'],
            'password'            =>  bcrypt($request['password']),
            'department'          => $NewDepartment[0], 
            'departmentID'        => $NewDepartment[1], 
            'AccountNo'           => $AccountNo,
            'ApprovedLimit'       => round($request['LimitAmount']) , 
            'active'              => 1,
            'status'              => 1,
            'CashOutDiscount'     => 0,
            
            'SubAgent'            => $request['SubAgent'],
            'AgentType'           => $request['AgentType'],
            
			 
           // 'user_fname'          =>$request['Newmovies'],
           

        ]);

    


        
        //return view('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Registration::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $authority = Registration::findOrFail($id);
        $authority->update($request->all());

        return $authority;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $authority = Registration::findOrFail($id);
        $authority->delete();

        return 204;
    }

    public function CheckUserPassword($id){
       // $id="2020-0008;;$2y$10$s.XKjVISW9THbwWRGoCDg.ym5KIKcEkaDR8TaihrGu6M3PEoAmxLC";
  
      $PassData   = explode(';;' ,$id);
       $GetUser =  User::select('*')
                      ->where('AccountNo',$PassData[0])
                     // ->where('password',$Pass ) //bcrypt($request['password'])  Hash::check('test', bcrypt('test'))
                      ->where('active',1)
                      ->first();
                      $Password = array();
                    if(Hash::check(trim($PassData[1]),trim($GetUser->password))) {
                      
                        $Password[] = [
                           '_id'                      => $GetUser->_id,
                           'username'                 => $GetUser->username,
                           'password'                 => $GetUser->password,
                           'Confirmed'                => 'YES',
                        ];    
                       

                    }else{
                        $Password[] = [
                            '_id'                      => $GetUser->_id,
                            'username'                 => $GetUser->username,
                            'password'                 => $GetUser->password,
                            'Confirmed'                => 'NO',
                         ];    
             
                     }
                     return response()->json($Password);	
           

    }



    public function ViewUserList()
    { 
        return Registration::select('*')->where('active',1)->orderBy('user_lname','ASC')->paginate(20);
               
                
    }

    public function RestoreUser(Request $request)
    { 
        date_default_timezone_set('Asia/Hong_Kong');
        $CurrentDate    = date('Y-m-d H:i:s');

        $GetUser =  Registration::select('*') ->where('AccountNo',$request['AccountNo'])->first();
        $GetUser->status                        = 1;
        $GetUser->RemarksRestore                = $request['RemarksRestore'] ;
        $GetUser->RemarksRestoreDate            = $CurrentDate ;
     
        $GetUser->save(); 
    }


    public function RemoveUser(Request $request)
    { 
        date_default_timezone_set('Asia/Hong_Kong');
        $CurrentDate    = date('Y-m-d H:i:s');

        $GetUser =  Registration::select('*') ->where('AccountNo',$request['AccountNo'])->first();
        $GetUser->status                        = $request['RemarksRemove'] ;
        $GetUser->RemarksRemove                 = $request['RemarksRemove'] ;
        $GetUser->RemarksRemoveDate             = $CurrentDate ;
        $GetUser->save(); 
    }



    public function UserProfileView($id)
    {
           
     $Registration    = Registration::select('*')->where('AccountNo',$id)->first();
            $Userrole = Userrole::select('*') 
                  ->where('AccountNo',$Registration->AccountNo)->get();
                $ListUserRole= array();
                   foreach($Userrole as $Userroles)
                    { 
                    
                        $ListUserRole[] = [
                       
                        'role_name'					      => $Userroles->role_name,
                        'acctTypeName'					  => $Userroles->acctTypeName,
                        'UserRoleID'					  => $Userroles->_id,
                        'Limit'					          => $Userroles->Limit,
                     
                      ] ;
                                  
                    }
                    $UserRoleAccess = UserRoleAccess::select('*') 
                                ->where('AccountNo',$Registration->AccountNo)->get();
                            $ListUserRoleAccess= array();
                     foreach($UserRoleAccess as $UserRoleAccesss)
                      { 
                      
                          $ListUserRoleAccess[] = [
                            'UserRoleAccessID'				  => $UserRoleAccesss->_id,
                            'role_name_access'				  => $UserRoleAccesss->role_name_access,
                            'role_number_url'				  => $UserRoleAccesss->role_number_url,
                            'acctTypeSubName'				  => $UserRoleAccesss->acctTypeSubName,
                            'acctTypeSubID'				      => $UserRoleAccesss->acctTypeSub,
                            'status'				          => $UserRoleAccesss->status,
                            'active'				          => $UserRoleAccesss->active,
                       
                        ] ;
                                    
                      }


                      $UserCommission = AgentCom::select('*') 
                                ->where('AccountNo',$Registration->AccountNo)->get();
                            $ListUserCommission= array();
                     foreach($UserCommission as $UserCommissions)
                      { 
                      
                          $ListUserCommission[] = [
                            'UserCommissionID'				  => $UserCommissions->_id,
                            'ClassName'				          => $UserCommissions->ClassName,
                            'PerilsName'				      => $UserCommissions->PerilsName,
                            'AmountCom'				          => $UserCommissions->AmountCom,
                            'PerilsNo'				          => $UserCommissions->PerilsNo,
                            'status'				          => $UserCommissions->status,
                            'active'				          => $UserCommissions->active,
                       
                        ] ;
                                    
                      }


            
                        $UsersRecordView[] = [
                            'user_fname'          => $Registration->user_fname,
                            'user_mname'          => $Registration->user_mname,
                            'user_lname'          => $Registration->user_lname,
                            'email'               => $Registration->email,
                            'username'            => $Registration->username,
                            'department'          => $Registration->department, 
                            'departmentID'        => $Registration->departmentID, 
                            'AccountNo'           => $Registration->AccountNo,
                            'ApprovedLimit'       => $Registration->ApprovedLimit , 
                            'active'              => $Registration->active,
                            'status'              => $Registration->status,
                            'CashOutDiscount'     => $Registration->CashOutDiscount,
                            'SubAgent'            => $Registration->SubAgent,
                            'AgentType'           => $Registration->AgentType,
                            'ListUserRole' 		  => $ListUserRole,	
                            'ListUserRoleAccess'  => $ListUserRoleAccess,
                            'ListUserCommission'  => $ListUserCommission,	 			  
                        
                      ] ;
         
                    return response()->json($UsersRecordView);
    	
    }

    public function RemoveUserAccess(Request $request)
    { 
        date_default_timezone_set('Asia/Hong_Kong');
        $CurrentDate    = date('Y-m-d H:i:s');

        $GetUser =  UserRoleAccess::select('*') ->where('_id',$request['UserRoleAccessID'])->first();
        $GetUser->status                        = $request['RemarksRemove'] ;
        $GetUser->RemarksRemove                 = $request['RemarksRemove'] ;
        $GetUser->RemarksRemoveDate             = $CurrentDate ;
        $GetUser->save(); 
    }


    public function RestoreUserAccess(Request $request)
    { 
        date_default_timezone_set('Asia/Hong_Kong');
        $CurrentDate    = date('Y-m-d H:i:s');

        $GetUser =  UserRoleAccess::select('*') ->where('_id',$request['UserRoleAccessID'])->first();
        $GetUser->status                         = 1 ;
        $GetUser->RemarksRestore                 = $request['RemarksRestore'] ;
        $GetUser->RemarksRestoreDate             = $CurrentDate ;
        $GetUser->save(); 
    }


    public function UpdateUserDetails(Request $request)
    { 
    
    $NewDepartment    = explode(";;",$request['select_department']);
    
    $Registration    = Registration::select('*')->where('AccountNo',$request['AccountNo'])->first();

    if (empty($request['select_department'])){
            $department     =   $Registration->department ;
            $departmentID   =   $Registration->departmentID ;
    }else{
        $department     =   $NewDepartment[0];
        $departmentID   =   $NewDepartment[1];
    }


    if (!empty($request['password'])){
        $Registration->password            = bcrypt($request['password']);
    }
        $Registration->user_fname       =  $request['firstname'];
        $Registration->user_mname       =  $request['middlename'];
        $Registration->user_lname       =  $request['lastname'];
        $Registration->email            =  $request['email'];
        $Registration->username         =  $request['username'];
        $Registration->department       =  $department ;
        $Registration->departmentID     =  $departmentID ;
        $Registration->ApprovedLimit    =  round($request['LimitAmount']) ; 
        $Registration->SubAgent         =  $request['SubAgent'];
        $Registration->AgentType        =  $request['AgentType'];
        $Registration->save(); 
      
}


public function AddNewPrivileges(Request $request)
{ 
    $totalType        = $request['select_type'];
    for($i=0;$i <  count($totalType) ;$i++)
     {
         
         $totalAuthority         = $request['select_authority'][$i];
         $totalSubTypes          = $request['select_SubTypes'][$i];
         $ExplodeType            = explode(";;",$request['select_type'][$i]);

         for($k=0 ;$k < count($totalAuthority)  ;$k++)
        { 
          
              $Newselect_authority    = explode(";;",$request['select_authority'][$i][$k]);
              $AType 	= substr($ExplodeType[0],0,1 );
              $Approver = substr($Newselect_authority[0],0,1);
              
              Userrole::create([
                      'AccountNo'        =>  $request['AccountNo'] ,
                      'role_name'        =>  $Newselect_authority[0], //$request['select_authority'][$i][$k],
                      'role_number'      =>  $Newselect_authority[1], //$request['select_authority'][$i][$k], 
                      'active'           => 1,
                      'status'           => 1,
                      'acctTypeName'     =>   $ExplodeType[0], 
                      'acctType'         =>   $ExplodeType[1],
                      'icon_display'     =>   $ExplodeType[2],
                      'UnderSubMenu'     =>   $ExplodeType[3],
                      'UnderSubMenuName' =>   $ExplodeType[4],
                      'RoleAlias'		 =>  strtoupper($Approver . $AType ) ,
                      'CName'		     =>  $request['firstname'] . ' ' . $request['lastname']  , 
                      'Limit'            =>  round($request['LimitAmount'])					
                      
                  ]);
        }
         for($p=0 ;$p < count($totalSubTypes)  ;$p++)
        { 
          
              $Newselect_SubTypes    = explode(";;",$request['select_SubTypes'][$i][$p]);
              
              UserRoleAccess::create([
                      'AccountNo'        			=> 	$request['AccountNo'] ,
                      'role_name_access'        	=>  $Newselect_SubTypes[0], //$request['select_authority'][$i][$k],
                      'role_number_access'      	=>  $Newselect_SubTypes[1], //$request['select_authority'][$i][$k], 
                      'role_number_url'             =>  $Newselect_SubTypes[2],
                      'active'           			=> 1,
                      'status'           			=> 1,
                      'acctTypeSubName'     		=>  $ExplodeType[0], 
                      'acctTypeSub'         		=>  $ExplodeType[1],
                      'icon_display'                =>  $Newselect_SubTypes[3],
                      
                  ]);
        }
        
    }
}



}
