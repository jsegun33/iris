<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TypeSubLink;
use App\Type;
use App\Authority;
use App\Department;
use App\ProductLinesPerils;
use App\ProductLineCharges;
use App\ProductLineSubCharges;
use App\UserRoleAccess;
use App\CarBodyType;
use App\CarModel;
use App\BankDetails;
use App\Accessories;
use App\ClausesWarranties;
use App\Status;
use App\ProductLinesSub;
use App\CarAmount;
use App\CarBrand;
use App\ProductLinesSurcharge;
use App\ListBarangay;
use App\ListCity;




class FileMaintenance extends Controller
{
     public function IndexTypeSubLink($id)
    {
        $ExplodeID  =  explode(";;", trim($id)); 
		return TypeSubLink::select('*')->where('active', 1)->where('type_ID', $ExplodeID[1])->paginate(150);
    }
	
	
	  public function SubTypesLoad()
    {
     
		return TypeSubLink::select('*')->orderBy('type_name','ASC')->paginate(20);
    }

    public function SubTypesList($id)
    {
        $ExplodeID  =  explode(";;", trim($id)); 
		return TypeSubLink::select('*')->where('active',1)->where('type_ID', trim($ExplodeID[1]))->orderBy('type_name','ASC')->paginate(150);
    }
	
	public function UpdateTypeSubLink(Request $request)
    {
        //$type = TypeSubLink::findOrFail($id);
		$ExplodeMainMenuType                        = explode(';;' ,trim($request['MainMenuType']));
		$TypeSubLinks								= TypeSubLink::select('*')->where('active',1)->where('_id',trim($request['_id']) )->first(); 
		$TypeSubLinks->SubLink_TypeName 			= $request['SubLink_TypeName'];
        $TypeSubLinks->type_ID 						= $ExplodeMainMenuType[0];
        $TypeSubLinks->type_name					= $ExplodeMainMenuType[1];
        $TypeSubLinks->SubLink_URL					= $request['SubLink_URL'];
        $TypeSubLinks->icon_display 	            = $request['icon_display'];
        $TypeSubLinks->UserMenu 	                = round($request['UserMenu']);
        $TypeSubLinks->save();
        
       
        $UserRoleAccesss	= UserRoleAccess::select('*')->where('active',1)->where('role_number_access',trim($request['_id']) )->get(); 
        foreach($UserRoleAccesss as $UserRoleAccess)
        { 
            $UserRoleAccess->role_name_access 			= $request['SubLink_TypeName'];
            $UserRoleAccess->acctTypeSub 			    = $ExplodeMainMenuType[0];
            $UserRoleAccess->acctTypeSubName		    = $ExplodeMainMenuType[1];
            $UserRoleAccess->role_number_url            = $request['SubLink_URL'];
            $UserRoleAccess->icon_display 	            = $request['icon_display'];
            $UserRoleAccess->save();
        }     
        return $TypeSubLinks;
    }
	
	public function AddTypeSubLink(Request $request)
    {
        $ExplodeMainMenuType         = explode(';;' ,trim($request['MainMenuType']));
        return TypeSubLink::create([
            'SubLink_TypeName'      => $request['SubLink_TypeName'],
            'type_ID'      			=> $ExplodeMainMenuType[0],
            'type_name'      		=> $ExplodeMainMenuType[1],
            'SubLink_URL'      		=> $request['SubLink_URL'],
            'icon_display'	        => $request['icon_display'],
            'active'        	    => 1,
            'status'        	    => 1,
        ]);
    }

    public function SubTypeDelete($id) {
        $TypeSubLink = TypeSubLink::find($id);
        if ($TypeSubLink->delete()) {
            $TypeSubLink->active = $TypeSubLink['active'] = 0;
            $TypeSubLink->save();
        }

        $UserRoleAccess			= UserRoleAccess::select('*')->where('active',"1")->where('role_number_access',trim($id) )->get(); 
        foreach($UserRoleAccess as $UserRoleAccesss)
        { 
            $UserRoleAccesss->active 	= '0';
            $UserRoleAccesss->save();
        } 


    }
    public function SubTypeRestore($id) {
        $TypeSubLink = TypeSubLink::find($id);
        if ($TypeSubLink->delete()) {
            $TypeSubLink->active = $TypeSubLink['active'] = 1;
            $TypeSubLink->save();
        }

        $UserRoleAccess		= UserRoleAccess::select('*')->where('active',"0")->where('role_number_access',trim($id) )->get(); 
        foreach($UserRoleAccess as $UserRoleAccesss)
        { 
            $UserRoleAccesss->active 	= 1;
            $UserRoleAccesss->save();
        } 


    }


    
//---------Type/Menu-------------------------------------
public function MenuType()
    {
        return Type::select('*')->where('status',1)->orderBy('active','DESC')->paginate(50);
    }


public function MenuTypeDisplay()
    {
        return Type::select('*')->where('status',1)->orderBy('type_name','ASC')->paginate(10);
    }
public function MenuTypeAddNew(Request $request)
    {
       
        if ( !empty($request['UnderSubMenu'])){
            $UnderSubMenuRequest         = explode(';;' ,trim($request['UnderSubMenu']));
           $UnderSubMenu                 =  $UnderSubMenuRequest[0];
           $UnderSubMenuName            =  $UnderSubMenuRequest[1];
        }else{
            $UnderSubMenu        =  '';
            $UnderSubMenuName    =  '';
        }
        
        return Type::create([
            'type_name'                 => $request['type_name'],
            'icon_display'           => $request['icon_display'],
            'UnderSubMenu'           =>  $UnderSubMenu ,
            'UnderSubMenuName'       =>  $UnderSubMenuName ,
            'active'                => 1,
            'status'                => 1,
        ]);
    }

public function MenuTypeUpdate(Request $request)
    {
        $id =  $request['_id'];
       
       // $type = Type::findOrFail($id);
       // $type->update($request->all());

       if ( !empty($request['UnderSubMenu']) || $request['UnderSubMenu'] == ''  ){
        $UnderSubMenuRequest            = explode(';;',$request['UnderSubMenu']);
        $UnderSubMenu                   =  $UnderSubMenuRequest[0];
        $UnderSubMenuName               =  $UnderSubMenuRequest[1];
     }else{
         $UnderSubMenu        =  '';
         $UnderSubMenuName    =  '';
     }
                    //$TypesSub	                            = Type::select('*')->where('_id',$id)->first();
                    $Types	                                = Type::select('*')->where('_id',$id)->first(); 
                    $Types->type_name 	                    = $request['type_name'];
                    $Types->icon_display 	                = $request['icon_display'];
                    $Types->UnderSubMenu                    = $UnderSubMenu;
                    $Types->UnderSubMenuName                = $UnderSubMenuName;
                    $Types->UserMenu                         = round($request['UserMenu']);
                    $Types->save();
    
      
        $TypeSubLinks								= TypeSubLink::select('*')->where('active',1)->where('type_ID',$id )->get(); 
       if (!empty ($TypeSubLinks)){

                foreach($TypeSubLinks as $TypeSubLink)
                { 
                    $TypeSubLink->type_name 	            = $request['type_name'];
                    $TypeSubLink->UnderSubMenu              = $UnderSubMenu;
                    $TypeSubLink->UnderSubMenuName          = $UnderSubMenuName;
                    $TypeSubLink->save();

                   
                } 


       }
       
        
        $UserRoleAccess								= UserRoleAccess::select('*')->where('active',1)->where('acctTypeSub',$id )->get(); 
        if (!empty ($UserRoleAccess)){
                foreach($UserRoleAccess as $UserRoleAccesss)
                { 
                    $UserRoleAccesss->acctTypeSubName 	        = $request['type_name'];
                    $UserRoleAccesss->icon_display 	            = $request['icon_display'];
                    $UserRoleAccesss->UnderSubMenu              = $UnderSubMenu;
                    $UserRoleAccesss->UnderSubMenuName           = $UnderSubMenuName;
                    $UserRoleAccesss->save();
                } 
            }        
        return $Types;

               



    }

public function MenuTypeFind($id)
    {
        return Type::find($id);
    }



public function MenuTypeActivateRecord($id) {
          $Types	            = Type::select('*')->where('active', 0)->where('_id',$id)->first(); 
          $Types->active        = 1;
          $Types->save();

          $TypeSubLinks								= TypeSubLink::select('*')->where('active',0)->where('type_ID',$id )->get(); 
        foreach($TypeSubLinks as $TypeSubLink)
        { 
            $TypeSubLink->active 	= 1;
            $TypeSubLink->save();
        } 
        
        $UserRoleAccess								= UserRoleAccess::select('*')->where('active',"0")->where('acctTypeSub',$id )->get(); 
        foreach($UserRoleAccess as $UserRoleAccesss)
        { 
            $UserRoleAccesss->active 	= 1;
            $UserRoleAccesss->save();
        } 

          return $Types;

    }


public function MenuTypeRecordDeletes($id) {
        $type = Type::find($id);
        if ($type->delete()) {
            $type->active = $type['active'] = 0;
            $type->save();
        }

        $TypeSubLinks								= TypeSubLink::select('*')->where('active',1)->where('type_ID',$id )->get(); 
        foreach($TypeSubLinks as $TypeSubLink)
        { 
            $TypeSubLink->active 	= 0;
            $TypeSubLink->save();
        } 
        
        $UserRoleAccess								= UserRoleAccess::select('*')->where('active',"1")->where('acctTypeSub',$id )->get(); 
        foreach($UserRoleAccess as $UserRoleAccesss)
        { 
            $UserRoleAccesss->active 	= '0';
            $UserRoleAccesss->save();
        } 



    }
//---------Authority/Menu-------------------------------------
    public function Authority()
    {
        return Authority::select('*')->orderBy('active','DESC')->paginate(50);
    }

    public function AuthorityList()
    {
        return Authority::select('*')->where('active',1)->paginate(50);
    }
    public function AuthorityAddNew(Request $request)
    {
        $this->validate($request, [
            'authority_name' => 'required | string | max:191',
        ]);
        
        return Authority::create([
            'authority_name' => $request['authority_name'],
            'active' => $request['active'] = 1,
        ]); 
    }



    public function AuthorityUpdate(Request $request, $id)
    {
        $authority = Authority::findOrFail($id);
        $authority->update($request->all());

        return $authority;
    }

    public function AuthorityDelete($id) {
        $authority = Authority::find($id);
        if ($authority->delete()) {
            $authority->active = $authority['active'] = 0;
            $authority->save();
        }
    }

    public function  AuthorityRestore($id) {
        $authority = Authority::find($id);
        if ($authority->restore()) {
            $authority->active = $authority['active'] = 1;
            $authority->save();
        }
    }
    
//---------Department-------------------------------------
public function Department()
{
    return Department::select('*')->orderBy('active','DESC')->paginate(50);
}

public function DepartmentList()
{
    return Department::select('*')->where('active',1)->paginate(50);
}

public function DepartmentAddNew(Request $request)
{
    return Department::create([
        'department_name'   => $request['department_name'],
        'active'            => $request['active'] = 1,
    ]);
}


public function DepartmentUpdate(Request $request, $id)
    {
        $department = Department::findOrFail($id);
        $department->update($request->all());
        return $department;
    }

    public function DepartmentRestore(Request $request, $id)
    {
        $department = Department::find($id);
        //if ($department->restore()) {
            $department->active = $department['active'] = 1;
            $department->save();
        //}
    }

    public function DepartmentDelete($id) {
        $department = Department::find($id);
        if ($department->delete()) {
            $department->active = $department['active'] = 0;
            $department->save();
        }
    }  
//------------------Coverages-----------------
public function Coverages()
{
    return ProductLinesPerils::select('*')->orderBy('Active','DESC')->paginate(50);
}

public function CoveragesAddNew(Request $request)
    {
        $this->validate($request, [
            'PerilsCode'        => 'required | string | max:191',
            'PerilsName'        => 'required | string | max:191',
          
        ]);

        $curYear        = date('Y');
        $CountPerils    = ProductLinesPerils::count() + 1;
        $NewCountPerils = str_pad($CountPerils, 4, '0' , STR_PAD_LEFT);
        
        return ProductLinesPerils::create([ 
            'LinesNo'          => "2019-MC-0001",
            'Checkbox'         => 'true',
            'Checkbox1'        => 'false',
            'PerilsNo'         => $curYear."-".$request['PerilsCode']."-".$NewCountPerils, 
            'PerilsCode'       => $request['PerilsCode'],
            'PerilsName'       => $request['PerilsName'],
            'Disabled'         =>  'false',
            'Active'           => "1",
        ]);
    }

    public function CoveragesDeletes($id) {
        $coverage = ProductLinesPerils::find($id);
        if ($coverage->delete()) {
            $coverage->Active = $coverage['Active'] = 0;
            $coverage->save();
        }
    }

    public function CoveragesRestore($id) {
        $coverage = ProductLinesPerils::find($id);
        if ($coverage->delete()) {
            $coverage->Active = $coverage['Active'] = "1";
            $coverage->save();
        }
    }

//------------------Charges-----------------
public function Charges()
{
    return ProductLineCharges::select('*')->orderBy('Active','DESC')->paginate(50);
}

public function ChargesList()
    {
        return ProductLineCharges::select('*')->where('Active','1')->paginate(50);
    }
public function ChargesAddNew(Request $request)
    {
        $this->validate($request, [
            //'ChargesCode'   => 'required | string | max:8',
            'ChargesName'   => 'required | string | max:191',
            'ChargesAmount' => 'required',
        ]);

        $currentYear     = date('Y');
        $CountCharges    = ProductLineCharges::count() + 1;
        $NewCountCharges = str_pad($CountCharges, 4, '0' , STR_PAD_LEFT);
        $CodeChages1st   = $request['ChargesName'][0];
        $CodeChages2nd   = substr($request['ChargesName'] ,-1);

        return ProductLineCharges::create([
            'ChargesNo'      => $currentYear."-".strtoupper($CodeChages1st) . strtoupper($CodeChages2nd) . "-".$NewCountCharges,
            //'ChargesCode'    => $request['ChargesCode'],
            'ChargesName'       => $request['ChargesName'],
            'ChargesAmount'     => $request['ChargesAmount'],
            'ChargesRemarks'    => $request['ChargesRemarks'],
            'ChargesType'       => $request['ChargesType'],
            'Active'            => "1",
        ]);
    }


    public function ChargesDelete($id) {
        $charge = ProductLineCharges::find($id);
        if ($charge->delete()) {
            $charge->Active = $charge['Active'] = 0;
            $charge->save();
        }
    }
    public function ChargesRestore($id) {
        $charge = ProductLineCharges::find($id);
        if ($charge->delete()) {
            $charge->Active = $charge['Active'] = "1";
            $charge->save();
        }
    }


    public function ChargesUpdate(Request $request, $id)
    {
       
        $charge                 = ProductLineCharges::findOrFail($id);
        $charge->ChargesName    = $request['ChargesName'];
        $charge->ChargesAmount  = $request['ChargesAmount'];
        $charge->ChargesRemarks = $request['ChargesRemarks'];
        $charge->save();

        return $charge;
    }

//---------------sub---Charges-----------------

public function SubCharges()
    {
        return ProductLineSubCharges::select('*')->orderBy('Active','DESC')->paginate(50);
    }

public function SubChargesAddNew(Request $request)
    {
        $this->validate($request, [
          
            'SubChargesName'   => 'required | string | max:191',
            'SubChargesAmount' => 'required',
        ]);

        $ChargesNoExplode = explode(';;',$request['ChargesCode']);

        $currentYear     = date('Y');
        $CountCharges    = ProductLineSubCharges::count() + 1;
        $NewCountCharges = str_pad($CountCharges, 4, '0' , STR_PAD_LEFT);
        $CodeChages1st   = $request['SubChargesName'][0];
        $CodeChages2nd   = substr($request['SubChargesName'] ,-1);

        $ProductLineCharges	= ProductLineCharges::select('*')->where('_id',trim($ChargesNoExplode[0]))->where('ChargesType','Decimal')->first();
        $ProductLineCharges->ChargesAmount = $ProductLineCharges->ChargesAmount  +  $request['SubChargesAmount'];
        $ProductLineCharges->save(); 

        return ProductLineSubCharges::create([
            'ChargesID'         => $ChargesNoExplode[0],
            'ChargesName'       => $ChargesNoExplode[1],
            'ChargesNo'         => $ChargesNoExplode[2],
            'SubChargesCode'    => $currentYear."-".strtoupper($CodeChages1st) .strtoupper($CodeChages2nd) ."-".$NewCountCharges,
            'SubChargesName'    => $request['SubChargesName'],
            'SubChargesAmount'  => $request['SubChargesAmount'],
            'SubChargesRemarks' => $request['SubChargesRemarks'],
            'Active'            =>  "1",
        ]);
        
       
	
	
    }
    public function SubChargesDelete($id) {
        $ChargesExplode           = explode(';;',trim($id));
        $charge = ProductLineSubCharges::find($ChargesExplode[0]);
        if ($charge->delete()) {
            $charge->Active = $charge['Active'] = 0;
            $charge->save();
        }

        $ProductLineCharges	= ProductLineCharges::select('*')->where('_id',trim($ChargesExplode[1]))->where('ChargesType','Decimal')->first();
        $ProductLineCharges->ChargesAmount = $ProductLineCharges->ChargesAmount  - $ChargesExplode[2];
        $ProductLineCharges->save(); 
    }

    public function SubChargesRestore($id) {
        $ChargesExplode           = explode(';;',trim($id));
        $charge = ProductLineSubCharges::find($ChargesExplode[0]);
        if ($charge->delete()) {
            $charge->Active = $charge['Active'] = "1";
            $charge->save();
        }

        $ProductLineCharges	= ProductLineCharges::select('*')->where('_id',trim($ChargesExplode[1]))->where('ChargesType','Decimal')->first();
        $ProductLineCharges->ChargesAmount = $ProductLineCharges->ChargesAmount  + $ChargesExplode[2];
        $ProductLineCharges->save(); 
    }

    public function SubChargesUpdate(Request $request, $id)
    {
        $ChargesNoExplode           = explode(';;',$request['ChargesCode']);
        $charge                     = ProductLineSubCharges::findOrFail($id);
        $charge->ChargesID          = $ChargesNoExplode[0];
        $charge->ChargesName        = $ChargesNoExplode[1];
        $charge->ChargesNo          = $ChargesNoExplode[2];
        $charge->SubChargesName     = $request['SubChargesName'];
        $charge->SubChargesAmount   = $request['SubChargesAmount'];
        $charge->SubChargesRemarks  = $request['SubChargesRemarks'];
        $charge->save();

        $ProductLineCharges	= ProductLineCharges::select('*')->where('_id',trim($ChargesNoExplode[0]))->where('ChargesType','Decimal')->first();
        $ProductLineCharges->ChargesAmount = $ProductLineCharges->ChargesAmount  +  $request['SubChargesAmount'];
        $ProductLineCharges->save(); 
	

        return $charge;
    }


//---------Body Type/Menu--------Audrey----------------------------
public function CarBodyType()
{
    return CarBodyType::select('*')->orderBy('Active','DESC')->paginate(200);
}

public function CarBodyTypeList()
{
    return CarBodyType::select('*')->where('Active', '1')->paginate(200);
}
public function CarBodyTypeAddNew(Request $request)
{
    $this->validate($request, [
        'BodyTypeName' => 'required | string | max:191',
    ]);
    $curYear        = date('Y');
    $CountBodyType    = CarBodyType::count() + 1;
    $NewBodyType= str_pad($CountBodyType, 4, '0' , STR_PAD_LEFT);
        
    return CarBodyType::create([
        'BodyTypeNo.'       => $curYear."-".$NewBodyType, 
        'BodyTypeName'      => $request['BodyTypeName'],
        'Active'            => $request['Active'] = "Active",
    ]); 
}

public function CarBodyTypeUpdate(Request $request, $id)
    {
        $CarBodyType = CarBodyType::findOrFail($id);
        $CarBodyType->update($request->all());

        return $CarBodyType;
    }

    public function CarBodyTypeDelete($id) {
        $CarBodyType = CarBodyType::find($id);
        if ($CarBodyType->delete()) {
            $CarBodyType->Active = $CarBodyType['Active'] = "0";
            $CarBodyType->save();
        }
    }

    public function  CarBodyTypeRestore($id) {
        $CarBodyType = CarBodyType::find($id);
        if ($CarBodyType->restore()) {
            $CarBodyType->Active = $CarBodyType['Active'] = "Active";
            $CarBodyType->save();
        }
    }

// Car Model Audrey ----------------------------------------------------------
    public function CarModel()
    {
        return CarModel::latest('Active')->paginate(15);
    }
    
public function CarModelList()
{
    return CarModel::Lastest()->where('Active', '1')->paginate(200);
}
public function CarModelAddNew(Request $request)
{
    $this->validate($request, [
        'ModelName' => 'required | string | max:191',
    ]);
    
    return CarModel::create([
        'ModelName' => $request['ModelName'],
        'Active' => $request['Active'] = "Active",
    ]); 
}
public function CarModelUpdate(Request $request, $id)
    {
        $CarModel = CarModel::findOrFail($id);
        $CarModel->update($request->all());

        return $CarModel;
    }

    public function CarModelDelete($id) {
        $CarModel = CarModel::find($id);
        if ($CarModel->delete()) {
            $CarModel->Active = $CarModel['Active'] = "Inactive";
            $CarModel->save();
        }
    }

    public function  CarModelRestore($id) {
        $CarModel = CarModel::find($id);
        if ($CarModel->restore()) {
            $CarModel->Active = $CarModel['Active'] = "Active";
            $CarModel->save();
        }
    }

    public function detroy($id)
    {
        // Force Delete
        $brand = CarBrand::findOrFail($id);
        $brand->forceDelete();
    }


// ------------- BankDetails Audrey -----------
  public function BankDetails()
  {
    return BankDetails::select('*')->orderBy('Active','DESC')->paginate(10);
  }
  public function BankDetailsList()
{
    return BankDetails::select('*')->where('Active', '1')->paginate(10);
}
public function BankDetailsAddNew(Request $request)
{
    $this->validate($request, [
        'BankName' => 'required | string | max:191',
        'Remarks'  => 'required | string | max:300',
        'Address'  => 'required | string | max:300',
    ]);
    $curYear        = date('Y');
    $BankDetails    = BankDetails::count() + 1;
    $NewBankDetails= str_pad($BankDetails, 4, '0' , STR_PAD_LEFT);
        
    return BankDetails::create([
        'BankName'      => $request['BankName'],
        'Remarks'      => $request['Remarks'],
        'Address'      => $request['Address'],
        'Active'        => "1",
        'Status'        => "1",
    ]); 
}

public function BankDetailsUpdate(Request $request, $id)
    {
        $BankDetails = BankDetails::findOrFail($id);
        $BankDetails->update($request->all());

        return $BankDetails;
    }

    public function BankDetailsDelete($id) {
        $BankDetails = BankDetails::find($id);
        if ($BankDetails->delete()) {
            $BankDetails->Active = $BankDetails['Active'] = "0";
            $BankDetails->save();
        }
    }

    public function  BankDetailsRestore($id) {
        $BankDetails = BankDetails::find($id);
        if ($BankDetails->restore()) {
            $BankDetails->Active = $BankDetails['Active'] = "1";
            $BankDetails->save();
        }
    }
// Accessories ----------------------------------------------------------------   
    public function Accessories()
    {
        return Accessories::latest()->paginate(5);
    }
    public function AccessoriesAddNew(Request $request)
    {
        $currentYear    = date('Y');
        $Accessories    = Accessories::count() + 1;
        $NewAccessories = str_pad($Accessories, 4, '0' , STR_PAD_LEFT);

        return Accessories::create([
            'Number'         => $currentYear."-".$NewAccessories,
            'SubLinesNO'     => $request['SubLinesNO'],
            'Name'           => $request['Name'],
            'ForType'        => $request['ForType'],
            'Formula1'       => $request['Formula1'],
            'Formula2'       => $request['Formula2'],
            'Greater'        => $request['Greater'],
            'Active'         => $request['Active'] = 1,
        ]);
    }
    public function AccessoriesList($id)
    {
        return Accessories::find($id);
    }
    public function AccessoriesUpdate(Request $request, $id)
    {
        $curYear        = date('Y');
        $Accessories    = Accessories::count();
        $NewAccessories = str_pad($Accessories, 4, '0' , STR_PAD_LEFT);

        $accessories                 = Accessories::findOrFail($id);
        $accessories->Number         = $curYear."-".$NewAccessories;
        $accessories->Name           = $request['Name'];
        $accessories->SubLinesNO     = $request['SubLinesNO'];
        $accessories->Formula1       = $request['Formula1'];
        $accessories->Formula2       = $request['Formula2'];
        $accessories->ForType        = $request['ForType'];
        $accessories->Greater        = $request['Greater'];
        $accessories->save();

        return $accessories;
    }
    public function AccessoriesDelete($id)
    {
        // Force Delete
        $accessories = Accessories::findOrFail($id);
        $accessories->forceDelete();
    }

    public function AccessoriessoftDelete($id) 
    {
        $accessories = Accessories::find($id);
        if ($accessories->delete()) {
            $accessories->Active = $accessories['Active'] = 0;
            $accessories->save();
        }
    }

    public function AccessoriesRestore($id) 
    {
        $accessories = Accessories::find($id);
        if ($accessories->restore()) {
            $accessories->Active = $accessories['Active'] = 1;
            $accessories->save();
        }
    }

    public function getAccessory() 
    {
        return Accessories::select('Name')->where('Active', '1')->get();
    }
// Clauses & Warranties------------------------------------------------------------
public function index()
{
    return ClausesWarranties::latest()->paginate(5);
}

public function store(Request $request)
{
    $currentYear    = date('Y');
    $ClausesWarranties    = ClausesWarranties::count() + 1;
    $NewClausesWarranties = str_pad($ClausesWarranties, 4, '0' , STR_PAD_LEFT);

    return ClausesWarranties::create([
        'Number'         => $currentYear."-".$NewClausesWarranties,
        'Name'           => $request['Name'],
        'Required'       => $request['Required'],
        'Default'       => $request['Default'],
        'Belong'         => $request['Belong'],
        'Remarks'        => $request['Remarks'],
        'Statement'      => $request['Statement'],
        'Active'         => $request['Active'] = 1,
    ]);
}

public function show($id)
{
    return ClausesWarranties::find($id);
}

public function update(Request $request, $id)
   
{
    $curYear        = date('Y');
    $ClausesWarranties    = ClausesWarranties::count();
    $NewClausesWarranties= str_pad($ClausesWarranties, 4, '0' , STR_PAD_LEFT);

    $clauses                = ClausesWarranties::findOrFail($id);
    $clauses->Number        = $curYear."-".$NewClausesWarranties;
    $clauses->Name          = $request['Name'];
    $clauses->Required      = $request['Required'];
    $clauses->Default       = $request['Default'];
    $clauses->Belong        = $request['Belong'];
    $clauses->Remarks       = $request['Remarks'];
    $clauses->Statement     = $request['Statement'];
    $clauses->save();

    return $clauses;
}

public function destroy($id)
{
    // Force Delete
    $clauses = ClausesWarranties::findOrFail($id);
    $clauses->forceDelete();
}
public function softDelete($id) 
{
    $clauses = ClausesWarranties::find($id);
    if ($clauses->delete()) {
        $clauses->Active = $clauses['Active'] = 0;
        $clauses->save();
    }
}

public function restore($id) 
{
    $clauses = ClausesWarranties::find($id);
    if ($clauses->restore()) {
        $clauses->Active = $clauses['Active'] = 1;
        $clauses->save();
    }
}

public function getWarranties() 
{
    return ClausesWarranties::select('Name')->where('Active', '1')->get();
}


//Status --------------------------------------------------------------------
    public function Status()
{
        return Status::latest()->paginate(5);
}

    public function StatusAddNew(Request $request)
{
        return Status::create([
    ]);

}
    public function StatusList($id)
{
        return Status::find($id);
}

    public function StatusUpdate(Request $request, $id)
   
{
    $status                  = Status::findOrFail($id);
    $status->Status          = $request['No.'];
    $status->Description     = $request['Name'];
    $status->Remarks         = $request['Remarks'];
    $status->save();

    return $status;
}

    public function StatusDelete($id)
{
    // Force Delete
    $status = Status::findOrFail($id);
    $status->forceDelete();
}
    public function StatussoftDelete($id) 
{
    $status = Status::find($id);
    if ($status->delete()) {
        $status->Active = $status['Active'] = 0;
        $status->save();
    }
}

    public function Statusrestore($id) 
{
    $status = Status::find($id);
    if ($status->restore()) {
        $status->Active = $status['Active'] = 1;
        $status->save();
    }
}

    public function getStatuses() 
{
    return Status::select('Name')->where('Active', '1')->get();
}

///----------Denomination -------------------
public function GetDenomination() 
{
    return ProductLinesSub::select('*')->where('Active', '1')->orderBy('SubLinesName','ASC')->get();
}

public function GetCarAmount() 
{
    // return CarAmount::select('CarAmount')->where('Active', '1')->get();
    return CarAmount::select('CarAmount')->where('Active', 'Active')->orderBy('CarAmount','ASC')->get();
}


public function GetCarBrands()
{

    return CarBrand::select('BrandName')->where('Active', 'Active')->orderBy('BrandName','ASC')->get();
}

public function GetCarModels($id)
{
   
    return CarModel::select('ModelName', 'BrandName')->where('Active', 'Active')->where('BrandName',$id)->orderBy('ModelName','ASC')->get();
}

public function GetCarBodyTypes()
{
    // return CarBodyType::select('BodyTypeName', 'Description')->where('Active', '1')->get();
    return CarBodyType::select('BodyTypeName', 'Description')->where('Active', 'Active')->orderBy('BodyTypeName','ASC')->get();
}


public function GetSurcharges() 
{
    return ProductLinesSurcharge::select('*')->where('Active', '1')->orderBy('SurchargeName','ASC')->get();
}

public function GetPerils()
{
    return ProductLinesPerils::select('*')->where('Active', '1')->where('Checkbox', 'true')->orderBy('Section','ASC')->get();
 
}

public function GetBarangays($id) 
{
    return ListBarangay::select('*')->where('active', 1)->where('CityCode',round($id))->orderBy('BrgyName','ASC')->get();
 
}

public function GetCities() 
{
    return ListCity::select('*')->where('active', 1)->orderBy('CityName','ASC')->get();
 
}




}
