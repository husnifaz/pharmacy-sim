<?php

namespace App\Http\Controllers;

use App\Models\Items;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderDetail;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class OrderController extends Controller
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
            $data = Items::with('unitMedicine');
            return DataTables::of($data)->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return '<div class="btn-group" style="width: 100%; text-align: center">
                    <form action="' . route('item.destroy', $row) . '" method="post">
                    ' . method_field('DELETE') . '
                    ' . csrf_field() . '
                      <a href="' . route('item.edit', $row) . '" class="btn bg-orange btn-xs"><span class="fa fa-edit"></span></a>
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
        $title = 'Tambah Pembelian Barang';
        return view('pages.purchase-order.form', compact('title'));
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
            'number' => 'required',
            'distributor' => 'required',
            'order_date' => 'required',
        ]);

        $model = new PurchaseOrder();
        $model->fill($request->all());
        $model->order_date = \Carbon\Carbon::parse($request->order_date)->format('Y-m-d');
        $model->created_by = auth()->user()->id;
        $model->save();

        return redirect()->route('order.edit', ['order' => $model->id])->with('success', 'Save Success');
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
    public function edit(Request $request)
    {
        $title = 'Detail Pembelian barang';
        $model = PurchaseOrder::find($request->order)->first();
        $details = PurchaseOrderDetail::where('purchase_order_id', $request->order)->with('item')->get();

        return view('pages.purchase-order.form', compact('model', 'title', 'details'));
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

    /**
     * dropdown obat
     */
    public function listItem(Request $request)
    {
        $term = $request->get('query', false);
        $model = Items::select('id', 'name as text', 'price');
        if ($term) {
            $model = $model->where('name', 'like', "%$term%");
        }

        $model = $model->get();

        return response()->json($model);
    }

    /**
     * Store data item detail.
     *
     */
    public function storeDetail(Request $request)
    {
        $request->validate([
            'item_id' => 'required',
            'qty' => 'required',
            'total' => 'required',
            'expired_date' => 'required',
        ]);

        $model = new PurchaseOrderDetail();
        $model->fill($request->all());
        $model->expired_date = \Carbon\Carbon::parse($request->expired_date)->format('Y-m-d');
        $model->save();

        return redirect()->route('order.edit', ['order' => $model->purchase_order_id])->with('success', 'Tambah Barang Sukses');
    }
}
