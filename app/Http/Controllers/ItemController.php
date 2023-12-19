<?php

namespace App\Http\Controllers;

use App\Models\Items;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = 'Daftar Obat';

        if ($request->ajax()) {
            $data = Items::query();
            return DataTables::of($data)->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return '<div class="btn-group" style="width: 100%; text-align: center">
                    <form action="' . route('employee.destroy', $row) . '" method="post">
                    ' . method_field('DELETE') . '
                    ' . csrf_field() . '
                      <a href="' . route('employee.edit', $row) . '" class="btn bg-orange btn-xs"><span class="fa fa-edit"></span></a>
                      <button class="btn btn-danger btn-xs" onClick="confirmDelete(event)" type="submit"><span class="fa fa-trash"></span></a>
                    </form>
                  </div>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('pages.item.index', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Tambah Obat';
        return view('pages.item.form', compact('title'));
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
            'name' => 'required',
            'price' => 'required',
        ]);

        $model = new Items();
        $model->fill($request->all());
        $model->save();

        return redirect()->route('item.index')->with('success', 'Save Success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\employees  $employees
     * @return \Illuminate\Http\Response
     */
    public function show(Items $item)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\employees  $employees
     * @return \Illuminate\Http\Response
     */
    public function edit(Items $item)
    {
        $title = 'Edit Data Obat';
        $model = Items::find($item)->first();

        return view('pages.item.form', compact('model', 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\employees  $employees
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Items $item)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
        ]);

        $item->fill($request->all());
        $item->save();

        return redirect()->route('item.index')->with('success', 'Update Success');
    }

    /**
     * Remove the specified resource from storage.  
     *
     * @param  \App\Models\employees  $employees
     * @return \Illuminate\Http\Response
     */
    public function destroy(Items $item)
    {
        $item->delete();
        return redirect()->route('item.index')->with('success', 'Deleted');
    }
}
