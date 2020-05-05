<?php

namespace App\Http\Controllers\FileMaintenance\Coverages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ProductLinesCharges;

class ChargesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        ProductLinesCharges::latest()->paginate(10);
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
        $CountCharges    = ProductLinesCharges::count() + 1;
        $NewCountCharges = str_pad($CountCharges, 4, '0' , STR_PAD_LEFT);

        return ProductLinesCharges::create([
            'ChargesNo'      => $currentYear."-".$request['ChargesCode']."-".$NewCountCharges,
            'ChargesCode'    => $request['ChargesCode'],
            'ChargesName'    => $request['ChargesName'],
            'ChargesAmount'  => $request['ChargesAmount'],
            'ChargesType'    => $request['ChargesType'],
            'ChargesRemarks' => $request['ChargesRemarks'],
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
        ProductLinesCharges::find($id);
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
        $CountCharges    = ProductLinesCharges::count();
        $NewCountCharges = str_pad($CountCharges, 4, '0' , STR_PAD_LEFT);

        $charge                  = ProductLinesCharges::findOrFail($id);
        $charge->ChargesNo       = $currentYear."-".$request['ChargesCode']."-".$NewCountCharges;
        $charge->ChargesCode     = $request['ChargesCode'];
        $charge->ChargesName     = $request['ChargesName'];
        $charge->ChargesAmount   = $request['ChargesAmount'];
        $charge->ChargesType     = $request['ChargesType'];
        $charge->ChargesRemarks  = $request['ChargesRemarks'];
        $charge->save();

        return $charge;
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
        $charge = ProductLinesCharges::findOrFail($id);
        $charge->forceDelete();
    }

    public function softDelete($id) 
    {
        $charge = ProductLinesCharges::find($id);
        if ($charge->delete()) {
            $charge->Active = $charge['Active'] = 0;
            $charge->save();
        }
    }

    public function restore($id) 
    {
        $charge = ProductLinesCharges::find($id);
        if ($charge->restore()) {
            $charge->Active = $charge['Active'] = 1;
            $charge->save();
        }
    }

    public function getCharges()
    {
        return ProductLinesCharges::select('*')->paginate(10);
    }
}
