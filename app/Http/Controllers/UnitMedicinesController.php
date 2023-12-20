<?php

namespace App\Http\Controllers;

use App\Models\UnitMedicines;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class UnitMedicinesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = 'Daftar Satuan Obat';

        if ($request->ajax()) {
            $data = UnitMedicines::query();
            return DataTables::of($data)->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return '<div class="btn-group" style="width: 100%; text-align: center">
                    <form action="' . route('unit-medicine.destroy', $row) . '" method="post">
                    ' . method_field('DELETE') . '
                    ' . csrf_field() . '
                      <a href="' . route('unit-medicine.edit', $row) . '" class="btn bg-orange btn-xs"><span class="fa fa-edit"></span></a>
                      <button class="btn btn-danger btn-xs" onClick="confirmDelete(event)" type="submit"><span class="fa fa-trash"></span></a>
                    </form>
                  </div>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('pages.unit-medicines.index', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Tambah Satuan Obat';
        return view('pages.unit-medicines.form', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $model = new UnitMedicines();
        $model->fill($request->all());
        $model->save();

        return redirect()->route('unit-medicine.index')->with('success', 'Save Success');
    }

    /**
     * Display the specified resource.
     */
    public function show(UnitMedicines $unitMedicines)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UnitMedicines $unit_medicine)
    {
        $title = 'Edit Data Satuan Obat';
        $model = $unit_medicine;

        return view('pages.unit-medicines.form', compact('model', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UnitMedicines $unit_medicine)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $unit_medicine->fill($request->all());
        $unit_medicine->save();

        return redirect()->route('unit-medicine.index')->with('success', 'Update Success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UnitMedicines $unit_medicine)
    {
        $unit_medicine->delete();
        return redirect()->route('unit-medicine.index')->with('success', 'Deleted');
    }


    public function dropdown()
    {
        $models = UnitMedicines::select('id', 'name as text')->get();

        return response()->json([
            'status' => true,
            'data' => $models
        ], 200);
    }
}
