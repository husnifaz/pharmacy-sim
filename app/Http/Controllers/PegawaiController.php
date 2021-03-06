<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = Pegawai::orderBy('id', 'asc')->get();
        return view('pages.pegawai.index', compact('model'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.pegawai.form');
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
            'nama' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $model = new Pegawai();
        $model->fill($request->all());
        $model->tgl_lahir = \Carbon\Carbon::parse($request->tgl_lahir)->format('Y-m-d');
        if ($request->image) {
            $imageName = 'pegawai_'.$model->nik.'.'.$request->image->getClientOriginalExtension();
            $path = $request->image->storeAs('pegawai', $imageName, 'public');
            $model->image_url = $path;
        }

        $model->save();

        return redirect('pegawai')->with('success', 'Save Success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function show(pegawai $pegawai)
    {
        $model = Pegawai::find($pegawai)->first();
        return view('pages.pegawai.show', compact('model'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function edit(pegawai $pegawai)
    {
        $model = Pegawai::find($pegawai)->first();
        return view('pages.pegawai.form', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, pegawai $pegawai)
    {
        $request->validate([
            'nik' => 'required',
            'nama' => 'required',
        ]);

        $pegawai->fill($request->all());
        $pegawai->tgl_lahir = \Carbon\Carbon::parse($request->tgl_lahir)->format('Y-m-d');
        $pegawai->save();

        return redirect('pegawai')->with('success', 'Update Success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function destroy(pegawai $pegawai)
    {
        $pegawai->delete();
        return redirect('pegawai')->with('success', 'Deleted');
    }
}
