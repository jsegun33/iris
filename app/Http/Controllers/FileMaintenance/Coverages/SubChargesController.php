<?php

namespace App\Http\Controllers\FileMaintenance\Coverages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ProductLinesSubCharges;

class SubChargesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ProductLinesSubCharges::latest()->paginate(10);
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
        $CountSubCharges    = ProductLinesSubCharges::count() + 1;
        $NewCountSubCharges = str_pad($CountSubCharges, 4, '0' , STR_PAD_LEFT);

        return ProductLinesSubCharges::create([
            'SubChargesNo'      => $currentYear."-".$request['SubChargesCode']."-".$NewCountSubCharges,
            'SubChargesCode'    => $request['SubChargesCode'],
            'SubChargesName'    => $request['SubChargesName'],
            'SubChargesAmount'  => $request['SubChargesAmount'],
            'SubChargesRemarks' => $request['SubChargesRemarks'],
            'ChargesNo'         => $request['ChargesNo'],
            'ChargesName'       => $request['ChargesName'],
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
        return ProductLinesSubCharges::find($id);
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
        $currentYear        = date('Y');
        $CountCharges       = ProductLinesSubCharges::count();
        $NewCountCharges    = str_pad($CountCharges, 4, '0' , STR_PAD_LEFT);

        $charge                     = ProductLinesSubCharges::findOrFail($id);
        $charge->SubChargesNo       = $currentYear."-".$request['SubChargesCode']."-".$NewCountCharges;
        $charge->SubChargesCode     = $request['SubChargesCode'];
        $charge->SubChargesName     = $request['SubChargesName'];
        $charge->SubChargesAmount   = $request['SubChargesAmount'];
        $charge->SubChargesRemarks  = $request['SubChargesRemarks'];
        $charge->ChargesNo          = $request['ChargesNo'];
        $charge->ChargesName        = $request['ChargesName'];
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
        $charge = ProductLinesSubCharges::findOrFail($id);
        $charge->forceDelete();
    }

    public function softDelete($id) 
    {
        $charge = ProductLinesSubCharges::find($id);
        if ($charge->delete()) {
            $charge->Active = $charge['Active'] = 0;
            $charge->save();
        }
    }

    public function restore($id) 
    {
        $charge = ProductLinesSubCharges::find($id);
        if ($charge->restore()) {
            $charge->Active = $charge['Active'] = 1;
            $charge->save();
        }
    }

    public function getSubCharges()
    {
        return ProductLinesSubCharges::select('*')->paginate(10);
    }
}
