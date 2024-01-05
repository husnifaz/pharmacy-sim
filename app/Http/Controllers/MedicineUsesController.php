<?php

namespace App\Http\Controllers;

use App\Models\MedicineUses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class MedicineUsesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = 'Daftar Aturan Pakai';

        if ($request->ajax()) {
            $data = MedicineUses::select(DB::raw("id, name, status, created_at, updated_at, case when status = 1 then 'Aktif' else 'Nonaktif' end as status_text"));
            return DataTables::of($data)->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return '<div class="btn-group" style="width: 100%; text-align: center">
                    <form action="' . route('medicine-use.destroy', $row) . '" method="post">
                    ' . method_field('DELETE') . '
                    ' . csrf_field() . '
                      <a href="' . route('medicine-use.edit', $row) . '" class="btn bg-orange btn-xs"><span class="fa fa-edit"></span></a>
                      <button class="btn btn-danger btn-xs" onClick="confirmDelete(event)" type="submit"><span class="fa fa-trash"></span></a>
                    </form>
                  </div>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('pages.medicine-uses.index', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Tambah Aturan Pakai';
        return view('pages.medicine-uses.form', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $model = new MedicineUses();
        $model->fill($request->all());
        $model->save();

        return redirect()->route('medicine-use.index')->with('success', 'Save Success');
    }

    /**
     * Display the specified resource.
     */
    public function show(MedicineUses $medicineUses)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MedicineUses $medicine_use)
    {
        $title = 'Edit Data Aturan Pakai';
        $model = $medicine_use;

        return view('pages.medicine-uses.form', compact('model', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MedicineUses $medicine_use)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $medicine_use->fill($request->all());
        $medicine_use->save();

        return redirect()->route('medicine-use.index')->with('success', 'Update Success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MedicineUses $medicine_use)
    {
        $medicine_use->delete();
        return redirect()->route('medicine-use.index')->with('success', 'Deleted');
    }
}
