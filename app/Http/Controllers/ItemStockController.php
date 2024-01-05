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
        $itemName = $model->name;
        $statusList = ItemStock::statusList();

        if ($request->ajax()) {
            $data = ItemStock::where('item_id', $id);

            return DataTables::of($data)->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '';
                    if ($row->status == ItemStock::STATUS_ACTIVE) {
                        $btn .= '<button class="btn bg-blue btn-xs" onclick="btPull(' . $row->id . ')" data-toggle="tooltip" data-placement="top" title="Tarik Barang"><span class="fa fa-level-down"></span></button>';
                        $btn .= '<button class="btn bg-green btn-xs" id="bt-so" data-id="{{$row->id}}" data-toggle="tooltip" data-placement="top" title="Stok opname"><span class="fa fa-refresh"></span></button>';
                    } else {
                        $btn .= '<button class="btn bg-default btn-xs" disabled><span class="fa fa-lock"></span></button>';
                    }
                    return '<div class="btn-group">
                      ' . $btn . '
                  </div>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('pages.item-stock.show', compact('title', 'id', 'statusList', 'itemName'));
    }

    /**
     *
     */
    public function pullItem(Request $request)
    {
        $request->validate([
            'item_stock_id' => 'required',
            'status' => 'required',
            'remarks' => 'required',
        ]);

        $model = ItemStock::find($request->item_stock_id);
        if ($model) {
            $model->fill($request->all());
            $model->save();
        }

        return redirect()->route('item-stock.show', ['id' => $model->item_id])->with('success', 'Success update status');
    }

    /**
     *
     */
    public function addStockOpname(Request $request)
    {
        $request->validate([
            'item_id' => 'required',
            'expired_date' => 'required',
            'batch_number' => 'required',
            'quantity' => 'required',
        ]);

        if ($request->item_stock_id) {
            $check = ItemStock::where('id', $request->item_stock_id)->first();
            $check->quantity = $request->quantity;
            $check->save();

            return redirect()->route('item-stock.show', ['id' => $check->item_id])->with('success', 'Update stok sukses');
        }

        $check = ItemStock::where('item_id', $request->item_id)
            ->where('expired_date', $request->expired_date)
            ->where('batch_number', $request->batch_number)
            ->where('status', ItemStock::STATUS_ACTIVE)
            ->first();

        if ($check) {
            return back()->with('error', 'Stok dengan ED dan Batch yang sama sudah ada');
        }

        $model = new ItemStock();
        $model->fill($request->all());
        $model->status = ItemStock::STATUS_ACTIVE;
        $model->save();

        return redirect()->route('item-stock.show', ['id' => $model->item_id])->with('success', 'Tambah stok sukses');
    }
}
