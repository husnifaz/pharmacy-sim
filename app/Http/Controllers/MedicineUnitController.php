<?php

namespace App\Http\Controllers;

use App\Models\MedicineUnit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class MedicineUnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = 'Daftar Satuan Obat';

        if ($request->ajax()) {
            $data = MedicineUnit::select(DB::raw("id, name, status, created_at, updated_at, case when status = 1 then 'Aktif' else 'Nonaktif' end as status_text"));
            return DataTables::of($data)->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return '<div class="btn-group" style="width: 100%; text-align: center">
                    <form action="' . route('medicine-unit.destroy', $row) . '" method="post">
                    ' . method_field('DELETE') . '
                    ' . csrf_field() . '
                      <a href="' . route('medicine-unit.edit', $row) . '" class="btn bg-orange btn-xs"><span class="fa fa-edit"></span></a>
                      <button class="btn btn-danger btn-xs" onClick="confirmDelete(event)" type="submit"><span class="fa fa-trash"></span></a>
                    </form>
                  </div>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('pages.medicine-unit.index', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Tambah Satuan Obat';
        return view('pages.medicine-unit.form', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $model = new MedicineUnit();
        $model->fill($request->all());
        $model->save();

        return redirect()->route('medicine-unit.index')->with('success', 'Save Success');
    }

    /**
     * Display the specified resource.
     */
    public function show(MedicineUnit $unitMedicines)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MedicineUnit $medicine_unit)
    {
        $title = 'Edit Data Satuan Obat';
        $model = $medicine_unit;

        return view('pages.medicine-unit.form', compact('model', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MedicineUnit $medicine_unit)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $medicine_unit->fill($request->all());
        $medicine_unit->save();

        return redirect()->route('medicine-unit.index')->with('success', 'Update Success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MedicineUnit $medicine_unit)
    {
        $medicine_unit->delete();
        return redirect()->route('medicine-unit.index')->with('success', 'Deleted');
    }


    public function dropdown()
    {
        $models = MedicineUnit::select('id', 'name as text')->get();

        return response()->json([
            'status' => true,
            'data' => $models
        ], 200);
    }
}
