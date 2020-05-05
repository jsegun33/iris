<?php

namespace App\Http\Controllers\FileMaintenance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\CarBodyType;

class CarBodyTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CarBodyType::latest()->paginate(10);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $curYear          = date('Y');
        $CountBodyType    = CarBodyType::count() + 1;
        $NewCountBodyType = str_pad($CountBodyType, 4, '0' , STR_PAD_LEFT);
        
        return CarBodyType::create([ 
            'BodyTypeNo'      => $curYear."-".$NewCountBodyType, 
            'BodyTypeName'    => $request['BodyTypeName'],
            'Description'     => $request['Description'],
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
        return CarBodyType::find($id);
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
        $curYear          = date('Y');
        $CountBodyType    = CarBodyType::count();
        $NewCountBodyType = str_pad($CountBodyType, 4, '0' , STR_PAD_LEFT);

        $body                    = CarBodyType::findOrFail($id);
        $body->BodyTypeNo        = $curYear."-".$NewCountBodyType;
        $body->BodyTypeName      = $request['BodyTypeName'];
        $body->Description       = $request['Description'];
        $body->save();

        return $body;
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
        $body = CarBodyType::findOrFail($id);
        $body->forceDelete();
    }

    public function softDelete($id) 
    {
        $body = CarBodyType::find($id);
        if ($body->delete()) {
            $body->Active = $body['Active'] = 0;
            $body->save();
        }
    }

    public function restore($id) 
    {
        $body = CarBodyType::find($id);
        if ($body->restore()) {
            $body->Active = $body['Active'] = 1;
            $body->save();
        }
    }

    public function getCarBodyType()
    {
        // return CarBodyType::select('BodyTypeName', 'Description')->where('Active', '1')->get();
        return CarBodyType::select('BodyTypeName', 'Description')->where('Active', 'Active')->get();
    }
}
