<?php

namespace App\Http\Controllers\FileMaintenance\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Type;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Type::latest()->paginate(10);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $currentYear  = date('Y');
        $CountType    = Type::count() + 1;
        $NewCountType = str_pad($CountType, 4, '0' , STR_PAD_LEFT);

        return Type::create([
            'TypeNo'     => $currentYear."-".$NewCountType,
            'TypeName'   => $request['TypeName'],
            'Active'     => $request['Active'] = 1,
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
        return Type::find($id);
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
        $currentYear  = date('Y');
        $CountType    = Type::count();
        $NewCountType = str_pad($CountType, 4, '0' , STR_PAD_LEFT);

        $Type           = Type::findOrFail($id);
        $Type->TypeName = $request['TypeName'];
        $Type->save();

        return $Type;
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
        $Type = Type::findOrFail($id);
        $Type->forceDelete();
    }

    public function softDelete($id) 
    {
        $Type = Type::find($id);
        if ($Type->delete()) {
            $Type->Active = $Type['Active'] = 0;
            $Type->save();
        }
    }

    public function restore($id) 
    {
        $Type = Type::find($id);
        if ($Type->restore()) {
            $Type->Active = $Type['Active'] = 1;
            $Type->save();
        }
    }

    public function getUserType() 
    {
        return Type::select('TypeName')->where('Active', 1)->get();
    }
}
