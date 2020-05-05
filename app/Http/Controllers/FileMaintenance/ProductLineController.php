<?php

namespace App\Http\Controllers\FileMaintenance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ProductLines;

class ProductLineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return ProductLines::select('*', 'deleted_at')->where('Active', 1)->paginate(10);
        return ProductLines::latest()->paginate(10);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $currentYear = date('Y');
        $CountProductLines = ProductLines::count() + 1;
        $NewCountProductLines = str_pad($CountProductLines, 4, '0' , STR_PAD_LEFT);

        return ProductLines::create([
            'LinesNo' => $currentYear."-".$request['LinesCode']."-".$NewCountProductLines,
            'LinesCode' => $request['LinesCode'],
            'LinesName' => $request['LinesName'],
            'Active' => $request['Active'] = 1,
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
        return ProductLines::find($id);
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
        $currentYear = date('Y');
        $CountProductLines = ProductLines::count();
        $NewCountProductLines = str_pad($CountProductLines, 4, '0' , STR_PAD_LEFT);

        $lines = ProductLines::findOrFail($id);
        $lines->LinesNo = $currentYear."-".$request['LinesCode']."-".$NewCountProductLines;
        $lines->LinesCode = $request['LinesCode'];
        $lines->LinesName = $request['LinesName'];
        $lines->save();

        return $lines;
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
        $lines = ProductLines::findOrFail($id);
        $lines->forceDelete();
    }

    public function softDelete($id) {
        $lines = ProductLines::find($id);
        if ($lines->delete()) {
            $lines->Active = $lines['Active'] = 0;
            $lines->save();
        }
    }

    public function restore($id) {
        $lines = ProductLines::find($id);
        if ($lines->restore()) {
            $lines->Active = $lines['Active'] = 1;
            $lines->save();
        }
    }
}
