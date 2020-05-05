<?php

namespace App\Http\Controllers\FileMaintenance\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Department;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Department::latest()->paginate(10);
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
        $CountDepartment    = Department::count() + 1;
        $NewCountDepartment = str_pad($CountDepartment, 4, '0' , STR_PAD_LEFT);

        return Department::create([
            'DepartmentNo'     => $currentYear."-".$NewCountDepartment,
            'DepartmentName'   => $request['DepartmentName'],
            'Active'           => $request['Active'] = 1,
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
        return Department::find($id);
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
        $CountDepartment    = Department::count();
        $NewCountDepartment = str_pad($CountDepartment, 4, '0' , STR_PAD_LEFT);

        $department                     = Department::findOrFail($id);
        $department->DepartmentName     = $request['DepartmentName'];
        $department->save();

        return $department;
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
        $department = Department::findOrFail($id);
        $department->forceDelete();
    }

    public function softDelete($id) 
    {
        $department = Department::find($id);
        if ($department->delete()) {
            $department->Active = $department['Active'] = 0;
            $department->save();
        }
    }

    public function restore($id) 
    {
        $department = Department::find($id);
        if ($department->restore()) {
            $department->Active = $department['Active'] = 1;
            $department->save();
        }
    }

    public function getUserDepartment() 
    {
        return Department::select('DepartmentName')->where('Active', 1)->get();
    }
}
