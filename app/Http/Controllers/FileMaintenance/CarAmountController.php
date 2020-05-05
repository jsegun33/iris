<?php

namespace App\Http\Controllers\FileMaintenance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\CarAmount;

class CarAmountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CarAmount::latest()->paginate(10);
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
        $CountAmount    = CarAmount::count() + 1;
        $NewCountAmount = str_pad($CountAmount, 4, '0' , STR_PAD_LEFT);

        return CarAmount::create([
            'CarAmountNo'     => $currentYear."-".$NewCountAmount,
            'CarAmount'       => $request['CarAmount'],
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
        return CarAmount::find($id);
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
        $CountAmount    = CarAmount::count();
        $NewCountAmount = str_pad($CountAmount, 4, '0' , STR_PAD_LEFT);

        $amount              = CarAmount::findOrFail($id);
        $amount->CarAmountNo = $currentYear."-".$NewCountAmount;
        $amount->CarAmount   = $request['CarAmount'];
        $amount->save();

        return $amount;
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
        $amount = CarAmount::findOrFail($id);
        $amount->forceDelete();
    }

    public function softDelete($id) 
    {
        $amount = CarAmount::find($id);
        if ($amount->delete()) {
            $amount->Active = $amount['Active'] = 0;
            $amount->save();
        }
    }

    public function restore($id) 
    {
        $amount = CarAmount::find($id);
        if ($amount->restore()) {
            $amount->Active = $amount['Active'] = 1;
            $amount->save();
        }
    }

    public function getCarAmount() 
    {
        // return CarAmount::select('CarAmount')->where('Active', '1')->get();
        return CarAmount::select('CarAmount')->where('Active', 'Active')->get();
    }
}
