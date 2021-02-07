<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * List .
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $model = Menu::orderBy('id', 'asc')->with('menuParent')->get();
        return view('pages.menu.index', compact('model'));
    }

    /**
     * List .
     *
     * @return \Illuminate\View\View
     */
    public function form()
    {
        return view('pages.menu.form');
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
            dd($e);
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    /**
     * Edit.
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $model = Menu::findOrFail($id);
        return view('pages.menu.form', compact('model'));
    }

    /**
     * Edit.
     *
     * @return \Illuminate\View\View
     */
    public function update(Request $request, $id)
    {
        $model = Menu::findOrFail($id);

        $model->fill($request->all());
        $model->save();

        return redirect('menu')->with('success', 'Success');
    }

    /**
     * Delete.
     *
     */
    public function delete($id)
    {
        $model = Menu::findOrFail($id);
        $model->delete();

        return redirect('menu')->with('success', 'Success');
    }
}
