<?php

namespace App\Http\Controllers\FileMaintenance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\CarClass;

class ClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CarClass::latest()->paginate(10);
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
        $CountKind    = CarClass::count() + 1;
        $NewCountKind = str_pad($CountKind, 4, '0' , STR_PAD_LEFT);

        $ClassName    = $request['ClassName'];
        $ClassInputNo = $request['ClassInputNo'];

        $NewCountClassNo = str_pad($ClassInputNo, 4, '0' , STR_PAD_LEFT);

        return CarClass::create([
            'SubLinesClassNo' => $currentYear."-".$ClassName.$ClassInputNo."-".$NewCountKind,
            'ClassName'       => $ClassName,
            'ClassInputNo'    => $ClassInputNo,
            'ClassNo'         => $currentYear."-".$ClassName."-".$NewCountClassNo,
            'Active'          => $request['Active'] = 1,
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
        return CarClass::find($id);
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
        $currentYear           = date('Y');
        $CountSubLinesClass    = CarClass::count();
        $NewCountSubLinesClass = str_pad($CountSubLinesClass, 4, '0' , STR_PAD_LEFT);

        $ClassName    = $request['ClassName'];
        $ClassInputNo = $request['ClassInputNo'];

        $NewCountClassNo = str_pad($ClassInputNo, 4, '0' , STR_PAD_LEFT);

        $class                  = CarClass::findOrFail($id);
        $class->SubLinesClassNo = $currentYear."-".$ClassName.$ClassInputNo."-".$NewCountSubLinesClass;
        $class->ClassName       = $ClassName;
        $class->ClassInputNo    = $ClassInputNo;
        $class->ClassNo         = $currentYear."-".$ClassName."-".$NewCountClassNo;
        $class->save();

        return $class;
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
        $class = CarClass::findOrFail($id);
        $class->forceDelete();
    }

    public function softDelete($id) 
    {
        $class = CarClass::find($id);
        if ($class->delete()) {
            $class->Active = $class['Active'] = 0;
            $class->save();
        }
    }

    public function restore($id) 
    {
        $class = CarClass::find($id);
        if ($class->restore()) {
            $class->Active = $class['Active'] = 1;
            $class->save();
        }
    }

    public function getCarClass()
    {
        $car =  CarClass::select('ClassName', 'ClassInputNo', 'ClassNo')->get();
        return $car;
    }
}
