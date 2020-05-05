<?php

namespace App\Http\Controllers\FileMaintenance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\CarBrand;

class CarBrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CarBrand::latest()->paginate(10);
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
        $CountBrand    = CarBrand::count() + 1;
        $NewCountBrand = str_pad($CountBrand, 4, '0' , STR_PAD_LEFT);
        
        return CarBrand::create([ 
            'BrandNo'         => $curYear."-".$NewCountBrand, 
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
        return CarBrand::find($id);
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
        $CountBrand    = CarBrand::count();
        $NewCountBrand = str_pad($CountBrand, 4, '0' , STR_PAD_LEFT);

        $brand                  = CarBrand::findOrFail($id);
        $brand->BrandNo         = $curYear."-".$NewCountBrand;
        $brand->BrandName       = $request['BrandName'];
        $brand->save();

        return $brand;
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
        $brand = CarBrand::findOrFail($id);
        $brand->forceDelete();
    }

    public function softDelete($id) 
    {
        $brand = CarBrand::find($id);
        if ($brand->delete()) {
            $brand->Active = $brand['Active'] = 0;
            $brand->save();
        }
    }

    public function restore($id) 
    {
        $brand = CarBrand::find($id);
        if ($brand->restore()) {
            $brand->Active = $brand['Active'] = 1;
            $brand->save();
        }
    }

    public function getCarBrand()
    {
        // return CarBrand::select('BrandName')->where('Active', '1')->get();
        return CarBrand::select('BrandName')->where('Active', 'Active')->get();
    }
}
