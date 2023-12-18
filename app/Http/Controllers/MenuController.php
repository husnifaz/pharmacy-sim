<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class MenuController extends Controller
{
    /**
     * List .
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $title = 'Daftar Menu';

        if ($request->ajax()) {
            $data = Menu::with('menuParent');
            return DataTables::of($data)->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return '<div class="btn-group">
                    <form action="' . route('menu.destroy', $row) . '" method="post">
                    ' . method_field('DELETE') . '
                    ' . csrf_field() . '
                      <a href="' . route('menu.show', $row) . '" class="btn bg-olive btn-xs"><span class="fa fa-eye"></span></a>
                      <a href="' . route('menu.edit', $row) . '" class="btn bg-orange btn-xs"><span class="fa fa-edit"></span></a>
                      <button class="btn btn-danger btn-xs" onClick="confirmDelete(event)" type="submit"><span class="fa fa-trash"></span></a>
                    </form>
                  </div>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('pages.menu.index', compact('title'));
    }

    /**
     * List .
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $title = 'Tambah Menu';
        return view('pages.menu.form', compact('title'));
    }

    /**
     * Store to Database.
     *
     * @return \Illuminate\View\View
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'order' => 'numeric|nullable'
        ]);

        try {
            $model = new Menu();
            $model->fill($request->all());
            $model->save();

            return redirect('menu')->with('success', 'Save Success');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    /**
     * Edit.
     *
     * @return \Illuminate\View\View
     */
    public function edit(Menu $menu)
    {
        $title = 'Edit Menu';
        $model = Menu::findOrFail($menu);
        return view('pages.menu.form', compact('model', 'title'));
    }

    /**
     * Edit.
     *
     * @return \Illuminate\View\View
     */
    public function update(Request $request, Menu $menu)
    {
        $model = Menu::findOrFail($menu);

        $model->fill($request->all());
        $model->save();

        return redirect('menu')->with('success', 'Success');
    }

    /**
     * Delete.
     *
     */
    public function destroy(Menu $menu)
    {
        $model = Menu::findOrFail($menu);
        $model->delete();

        return redirect('menu')->with('success', 'Success');
    }
}
