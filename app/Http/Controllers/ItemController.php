<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = Item::get();
        return view('pages.item.index', compact('model'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.item.form');
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
    public function show(employees $employees)
    {
        $model = Employees::find($employees)->first();
        return view('pages.employees.show', compact('model'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\employees  $employees
     * @return \Illuminate\Http\Response
     */
    public function edit(employees $employees)
    {
        $model = Employees::find($employees)->first();
        return view('pages.employees.form', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\employees  $employees
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, employees $employees)
    {
        $request->validate([
            'nik' => 'required',
            'nama' => 'required',
        ]);

        $employees->fill($request->all());
        $employees->tgl_lahir = \Carbon\Carbon::parse($request->tgl_lahir)->format('Y-m-d');
        $employees->save();

        return redirect('employee.index')->with('success', 'Update Success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\employees  $employees
     * @return \Illuminate\Http\Response
     */
    public function destroy(employees $employees)
    {
        $employees->delete();
        return redirect('employee.index')->with('success', 'Deleted');
    }
}
