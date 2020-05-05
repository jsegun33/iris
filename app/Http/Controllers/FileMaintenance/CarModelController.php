<?php

namespace App\Http\Controllers\FileMaintenance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\CarModel;

class CarModelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CarModel::latest()->paginate(10);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $curYear       = date('Y');
        $CountModel    = CarModel::count() + 1;
        $NewCountModel = str_pad($CountModel, 4, '0' , STR_PAD_LEFT);
        
        return CarModel::create([ 
            'ModelNo'         => $curYear."-".$NewCountModel, 
            'ModelName'       => $request['ModelName'],
            'BrandName'       => $request['BrandName'],
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
        return CarModel::find($id);
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
        $curYear       = date('Y');
        $CountModel    = CarModel::count();
        $NewCountModel = str_pad($CountModel, 4, '0' , STR_PAD_LEFT);

        $model                  = CarModel::findOrFail($id);
        $model->BrandNo         = $curYear."-".$NewCountModel;
        $model->ModelName       = $request['ModelName'];
        $model->BrandName       = $request['BrandName'];
        $model->save();

        return $model;
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
        $model = CarModel::findOrFail($id);
        $model->forceDelete();
    }

    public function softDelete($id) 
    {
        $model = CarModel::find($id);
        if ($model->delete()) {
            $model->Active = $model['Active'] = 0;
            $model->save();
        }
    }

    public function restore($id) 
    {
        $model = CarModel::find($id);
        if ($model->restore()) {
            $model->Active = $model['Active'] = 1;
            $model->save();
        }
    }

    public function getCarModel($id)
    {
       
        return CarModel::select('ModelName', 'BrandName')->where('Active', 'Active')->where('BrandName',$id)->get();
    }
}
