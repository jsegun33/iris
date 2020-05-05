<?php

namespace App\Http\Controllers\FileMaintenance\Coverages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ProductLinesPerilsTaripa;

class TaripaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ProductLinesPerilsTaripa::latest()->paginate(10);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $currentYear    = date('Y');
        $CountTaripa    = ProductLinesPerilsTaripa::count() + 1;
        $NewCountTaripa = str_pad($CountTaripa, 4, '0' , STR_PAD_LEFT);

        return ProductLinesPerilsTaripa::create([
            'TaripaNo'       => $currentYear."-"."TP"."-".$NewCountTaripa,
            'SubLinesNo'     => $request['ClassNo'],
            'PerilsNo'       => $request['PerilsNo'],
            'CoverageAmount' => $request['CoverageAmount'],
            'PremiumAmount'  => $request['PremiumAmount'],
            'Formula'        => $request['Formula'],
            'PerilsName'     => $request['PerilsName'],
            'Active'         => $request['Active'] = 1,
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
        return ProductLinesPerilsTaripa::find($id);
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
        $currentYear    = date('Y');
        $CountTaripa    = ProductLinesPerilsTaripa::count();
        $NewCountTaripa = str_pad($CountTaripa, 4, '0' , STR_PAD_LEFT);

        $taripa                 = ProductLinesPerilsTaripa::findOrFail($id);
        $taripa->SubLinesNo     = $request['ClassNo'];
        $taripa->PerilsNo       = $request['PerilsNo'];
        $taripa->CoverageAmount = $request['CoverageAmount'];
        $taripa->PremiumAmount  = $request['PremiumAmount'];
        $taripa->Formula        = $request['Formula'];
        $taripa->PerilsName     = $request['PerilsName'];
        $taripa->save();

        return $taripa;
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
        $taripa = ProductLinesPerilsTaripa::findOrFail($id);
        $taripa->forceDelete();
    }

    public function softDelete($id) 
    {
        $taripa = ProductLinesPerilsTaripa::find($id);
        if ($taripa->delete()) {
            $taripa->Active = $taripa['Active'] = 0;
            $taripa->save();
        }
    }

    public function restore($id) 
    {
        $taripa = ProductLinesPerilsTaripa::find($id);
        if ($taripa->restore()) {
            $taripa->Active = $taripa['Active'] = 1;
            $taripa->save();
        }
    }

    public function getTaripas()
    {
        return ProductLinesPerilsTaripa::select('*')->where('Active', '1')->get();
    }
}
