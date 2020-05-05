<?php

namespace App\Http\Controllers\FileMaintenance\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Authority;

class AuthorityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Authority::latest()->paginate(10);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $currentYear       = date('Y');
        $CountAuthority    = Authority::count() + 1;
        $NewCountAuthority = str_pad($CountAuthority, 4, '0' , STR_PAD_LEFT);

        return Authority::create([
            'AuthorityNo'   => $currentYear."-".$NewCountAuthority,
            'AuthorityName' => $request['AuthorityName'],
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
        return Authority::find($id);
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
        $currentYear       = date('Y');
        $CountAuthority    = Authority::count();
        $NewCountAuthority = str_pad($CountAuthority, 4, '0' , STR_PAD_LEFT);

        $Authority                = Authority::findOrFail($id);
        $Authority->AuthorityName = $request['AuthorityName'];
        $Authority->save();

        return $Authority;
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
        $Authority = Authority::findOrFail($id);
        $Authority->forceDelete();
    }

    public function softDelete($id) 
    {
        $Authority = Authority::find($id);
        if ($Authority->delete()) {
            $Authority->Active = $Authority['Active'] = 0;
            $Authority->save();
        }
    }

    public function restore($id) 
    {
        $Authority = Authority::find($id);
        if ($Authority->restore()) {
            $Authority->Active = $Authority['Active'] = 1;
            $Authority->save();
        }
    }

    public function getUserAuthority() 
    {
        return Authority::select('AuthorityName')->where('Active', 1)->get();
    }
}
