<?php

namespace App\Http\Controllers;

use App\Models\Employees;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = 'Daftar Pegawai';

        if ($request->ajax()) {
            $data = Employees::query();
            return DataTables::of($data)->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return '<div class="btn-group" style="width: 100%; text-align: center">
                    <form action="' . route('employee.destroy', $row) . '" method="post">
                    ' . method_field('DELETE') . '
                    ' . csrf_field() . '
                      <a href="' . route('employee.show', $row) . '" class="btn bg-olive btn-xs"><span class="fa fa-eye"></span></a>
                      <a href="' . route('employee.edit', $row) . '" class="btn bg-orange btn-xs"><span class="fa fa-edit"></span></a>
                      <button class="btn btn-danger btn-xs" onClick="confirmDelete(event)" type="submit"><span class="fa fa-trash"></span></a>
                    </form>
                  </div>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('pages.employees.index', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Tambah Pegawai';
        return view('pages.employees.form', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required',
            'name' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $model = new Employees();
        $model->fill($request->all());
        $model->dob = \Carbon\Carbon::parse($request->tgl_lahir)->format('Y-m-d');
        if ($request->image) {
            $imageName = 'employees_' . $model->nik . '.' . $request->image->getClientOriginalExtension();
            $path = $request->image->storeAs('employees', $imageName);
            $model->image_url = $path;
        }

        $model->save();

        return redirect()->route('employee.index')->with('success', 'Save Success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\employees  $employees
     * @return \Illuminate\Http\Response
     */
    public function show(Employees $employee)
    {
        $model = Employees::find($employee)->first();
        return view('pages.employees.show', compact('model'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\employees  $employees
     * @return \Illuminate\Http\Response
     */
    public function edit(Employees $employee)
    {
        $title = 'Edit Data Pegawai';
        $model = Employees::find($employee)->first();

        return view('pages.employees.form', compact('model', 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\employees  $employees
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employees $employee)
    {
        $request->validate([
            'nik' => 'required',
            'name' => 'required',
        ]);

        $employee->fill($request->all());
        $employee->dob = \Carbon\Carbon::parse($request->dob)->format('Y-m-d');
        $employee->save();

        return redirect()->route('employee.index')->with('success', 'Update Success');
    }

    /**
     * Remove the specified resource from storage.  
     *
     * @param  \App\Models\employees  $employees
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employees $employee)
    {
        $employee->delete();
        return redirect()->route('employee.index')->with('success', 'Deleted');
    }
}
