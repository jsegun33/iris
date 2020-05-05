<?php

namespace App\Http\Controllers\FileMaintenance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use App\CarDenomination;
use App\ProductLinesSub;

class DenominationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ProductLinesSub::latest()->paginate(10);
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
        $CountMV   = ProductLinesSub::count() + 1;
        $NewCountMV = str_pad($CountMV, 4, '0' , STR_PAD_LEFT);

        return ProductLinesSub::create([
            'SubLinesNo'        => $currentYear."-".$request['SubLinesCode']."-".$NewCountMV,
            'SubLinesCode'      => $request['SubLinesCode'],
            'SubLinesName'      => $request['SubLinesName'],
            'Class'             => $request['Class'],
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
        return ProductLinesSub::find($id);
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
        $currentYear         = date('Y');
        $CountSubLinesMV     = ProductLinesSub::count();
        $NewCountSubLinesMV  = str_pad($CountSubLinesMV, 4, '0' , STR_PAD_LEFT);

        $mv                         = ProductLinesSub::findOrFail($id);
        $mv->SubLinesNo             = $currentYear."-".$request['SubLinesCode']."-".$NewCountSubLinesMV;
        $mv->SubLinesCode           = $request['SubLinesCode'];
        $mv->SubLinesName           = $request['SubLinesName'];
        $mv->Class                  = $request['Class'];
        $mv->save();

        return $mv;
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
        $mv = ProductLinesSub::findOrFail($id);
        $mv->forceDelete();
    }

    public function softDelete($id) {
        $mv = ProductLinesSub::find($id);
        if ($mv->delete()) {
            $mv->Active = $mv['Active'] = 0;
            $mv->save();
        }
    }

    public function restore($id) {
        $mv = ProductLinesSub::find($id);
        if ($mv->restore()) {
            $mv->Active = $mv['Active'] = 1;
            $mv->save();
        }
    }

    public function getDenomination()
    {
        return ProductLinesSub::select('*')->where('Active', '1')->get();
    }
}
