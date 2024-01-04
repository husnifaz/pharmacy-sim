<?php

namespace App\Http\Controllers;

use App\Models\Items;
use App\Models\ItemStock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class ItemStockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = 'Daftar Stok Obat';

        if ($request->ajax()) {
            $data = ItemStock::select(DB::raw("
                items.id, items.name as item_name, sum(quantity) as total_stock
            "))->leftJoin("items", "items.id", "item_stocks.item_id")
                ->groupBy('id', 'item_name');

            return DataTables::of($data)->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return '<div class="btn-group">
                      <a href="' . route('item-stock.show', ['id' => $row->id]) . '" class="btn bg-green btn-xs"><span class="fa fa-external-link"></span></a>
                  </div>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('pages.item-stock.index', compact('title'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\employees  $employees
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $id = $request->get('id', null);

        $model = Items::find($id);
        $title = 'Detail Stok Obat : ' . $model->name;

        if ($request->ajax()) {
            $data = ItemStock::where('item_id', $id);

            return DataTables::of($data)->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return '<div class="btn-group">
                      <button class="btn bg-blue btn-xs" id="bt-pull" data-id="{{$row->id}}" data-toggle="tooltip" data-placement="top" title="Tarik Barang"><span class="fa fa-level-down"></span></button>
                      <button class="btn bg-green btn-xs" id="bt-so" data-id="{{$row->id}}" data-toggle="tooltip" data-placement="top" title="Stok opname"><span class="fa fa-refresh"></span></button>
                  </div>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('pages.item-stock.show', compact('title', 'id'));
    }
}
