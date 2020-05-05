<?php

namespace App\Http\Controllers\FileMaintenance\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\SubType;

class SubTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return SubType::latest()->paginate(10);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $currentYear     = date('Y');
        $CountSubType    = SubType::count() + 1;
        $NewCountSubType = str_pad($CountSubType, 4, '0' , STR_PAD_LEFT);

        return SubType::create([
            'SubTypeNo'         => $currentYear."-".$NewCountSubType,
            'SubLink_TypeName'  => $request['SubLink_TypeName'],
            'SubLink_URL'       => $request['SubLink_URL'],
            'SubMenu_Type'      => $request['SubMenu_Type'],
            'TypeID'            => $request['TypeID'],
            'Active'            => $request['Active'] = 1,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return SubType::find($id);
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
        $currentYear     = date('Y');
        $CountSubType    = SubType::count();
        $NewCountSubType = str_pad($CountSubType, 4, '0' , STR_PAD_LEFT);

        $SubType                   = SubType::findOrFail($id);
        $SubType->SubLink_TypeName = $request['SubLink_TypeName'];
        $SubType->SubLink_URL      = $request['SubLink_URL'];
        $SubType->SubMenu_Type     = $request['SubMenu_Type'];
        $SubType->TypeID           = $request['TypeID'];
        $SubType->save();

        return $SubType;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Force Delete
        $SubType = SubType::findOrFail($id);
        $SubType->forceDelete();
    }

    public function softDelete($id) 
    {
        $SubType = SubType::find($id);
        if ($SubType->delete()) {
            $SubType->Active = $SubType['Active'] = 0;
            $SubType->save();
        }
    }

    public function restore($id) 
    {
        $SubType = SubType::find($id);
        if ($SubType->restore()) {
            $SubType->Active = $SubType['Active'] = 1;
            $SubType->save();
        }
    }

    public function getUserSubType() 
    {
        return SubType::select('*')->where('Active', 1)->paginate(10);
    }

    // public function SubTypesList($id)
    // {
    //     // $ExplodeID  =  explode(";;", trim($id)); 
	// 	return SubType::select('*')->where('TypeID', $id)->where('Active', 1)->paginate(100);
    // }

    public function SubTypesList($id)
    {
        $ExplodeID  =  explode(";;", trim($id)); 
		return SubType::select('*')->where('Active',1)->where('TypeID', trim($ExplodeID[1]))->paginate(100);
    }
}
