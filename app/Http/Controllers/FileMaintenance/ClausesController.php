<?php

namespace App\Http\Controllers\FileMaintenance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ClausesWarranties;

class ClausesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ClausesWarranties::latest()->paginate(10);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $currentYear            = date('Y');
        $ClausesWarranties      = ClausesWarranties::count() + 1;
        $NewClausesWarranties   = str_pad($ClausesWarranties, 4, '0' , STR_PAD_LEFT);

        return ClausesWarranties::create([
            'Number'         => $currentYear."-".$NewClausesWarranties,
            'Name'           => $request['Name'],
            'Required'       => $request['Required'],
            'Default'        => $request['Default'],
            'Belong'         => $request['Belong'],
            'Remarks'        => $request['Remarks'],
            'Statement'      => $request['Statement'],
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
        return ClausesWarranties::find($id);
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
        $curYear                = date('Y');
        $ClausesWarranties      = ClausesWarranties::count();
        $NewClausesWarranties   = str_pad($ClausesWarranties, 4, '0' , STR_PAD_LEFT);

        $clauses                = ClausesWarranties::findOrFail($id);
        $clauses->Number        = $curYear."-".$NewClausesWarranties;
        $clauses->Name          = $request['Name'];
        $clauses->Required      = $request['Required'];
        $clauses->Default       = $request['Default'];
        $clauses->Belong        = $request['Belong'];
        $clauses->Remarks       = $request['Remarks'];
        $clauses->Statement     = $request['Statement'];
        $clauses->save();

        return $clauses;
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
        $clauses = ClausesWarranties::findOrFail($id);
        $clauses->forceDelete();
    }

    public function softDelete($id) 
    {
        $clauses = ClausesWarranties::find($id);
        if ($clauses->delete()) {
            $clauses->Active = $clauses['Active'] = 0;
            $clauses->save();
        }
    }

    public function restore($id) 
    {
        $clauses = ClausesWarranties::find($id);
        if ($clauses->restore()) {
            $clauses->Active = $clauses['Active'] = 1;
            $clauses->save();
        }
    }

    public function getWarranties() 
    {
        return ClausesWarranties::select('Name')->where('Active', 1)->get();
    }
}
