<?php

namespace App\Http\Controllers\FileMaintenance\Coverages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ProductLinesPerils;

class PerilsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ProductLinesPerils::latest()->paginate(10);
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
        $CountPeril    = ProductLinesPerils::count() + 1;
        $NewCountPeril = str_pad($CountPeril, 4, '0' , STR_PAD_LEFT);

        return ProductLinesPerils::create([
            'PerilsNo'      => $currentYear."-".$request['PerilsCode']."-".$NewCountPeril,
            'PerilsCode'    => $request['PerilsCode'],
            'PerilsName'    => $request['PerilsName'],
            'Checkbox'      => $request['Checkbox'] = 'true',
            'Checkbox1'     => $request['Checkbox1'],
            'LinesNo'       => $request['LinesNo'],
            'Active'        => $request['Active'] = 1,
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
        return ProductLinesPerils::find($id);
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
        $CountPeril    = ProductLinesPerils::count();
        $NewCountPeril = str_pad($CountPeril, 4, '0' , STR_PAD_LEFT);

        $peril              = ProductLinesPerils::findOrFail($id);
        $peril->PerilsCode  = $request['PerilsCode'];
        $peril->PerilsName  = $request['PerilsName'];
        $peril->Checkbox1   = $request['Checkbox1'];
        $peril->LinesNo     = $request['LinesNo'];
        $peril->save();

        return $peril;
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
        $peril = ProductLinesPerils::findOrFail($id);
        $peril->forceDelete();
    }

    public function softDelete($id) 
    {
        $peril = ProductLinesPerils::find($id);
        if ($peril->delete()) {
            $peril->Active = $peril['Active'] = 0;
            $peril->save();
        }
    }

    public function restore($id) 
    {
        $peril = ProductLinesPerils::find($id);
        if ($peril->restore()) {
            $peril->Active = $peril['Active'] = 1;
            $peril->save();
        }
    }

    public function getPerils()
    {
        return ProductLinesPerils::select('*')->where('Active', 1)->get();
    }

    public function GetPeril()
    {
        return ProductLinesPerils::select('*')->where('Active', '1')->where('Checkbox', 'true')->paginate(10);
             //->orderBy("Formula",'ASC')
              //->orderBy('Checked','ASC')
             // ->groupBy('Checked')
    }
}
