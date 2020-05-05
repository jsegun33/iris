<?php

namespace App\Http\Controllers\FileMaintenance\Coverages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ProductLinesSurcharge;

class SurchargeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ProductLinesSurcharge::latest()->paginate(10);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $currentYear        = date('Y');
        $CountSurcharge     = ProductLinesSurcharge::count() + 1;
        $NewCountSurcharge  = str_pad($CountSurcharge, 4, '0' , STR_PAD_LEFT);

        return ProductLinesSurcharge::create([
            'SurchargeNo'    => $currentYear."-".$NewCountSurcharge,
            'SurchargeName'  => $request['SurchargeName'],
            'Charge'         => $request['Charge'] = 0,
            'LinesNo'        => $request['LinesNo'],
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
        return ProductLinesSurcharge::find($id);
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
        $currentYear   = date('Y');
        $CountPeril    = ProductLinesSurcharge::count();
        $NewCountPeril = str_pad($CountPeril, 4, '0' , STR_PAD_LEFT);

        $surcharge                  = ProductLinesSurcharge::findOrFail($id);
        $surcharge->SurchargeName   = $request['SurchargeName'];
        $surcharge->LinesNo         = $request['LinesNo'];
        $surcharge->save();

        return $surcharge;
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
       $surcharge = ProductLinesSurcharge::findOrFail($id);
       $surcharge->forceDelete();
   }

   public function softDelete($id) 
   {
       $surcharge = ProductLinesSurcharge::find($id);
       if ($surcharge->delete()) {
           $surcharge->Active = $surcharge['Active'] = 0;
           $surcharge->save();
       }
   }

   public function restore($id) 
   {
       $surcharge = ProductLinesSurcharge::find($id);
       if ($surcharge->restore()) {
           $surcharge->Active = $surcharge['Active'] = 1;
           $surcharge->save();
       }
   }

   public function getSurcharge()
   {
       return ProductLinesSurcharge::select('*')->where('Active', '1')->get();
   }

}
