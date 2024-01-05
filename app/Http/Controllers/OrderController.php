<?php

namespace App\Http\Controllers;

use App\Jobs\OrderStock;
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
        $title = 'Daftar Order Barang';

        if ($request->ajax()) {
            $data = PurchaseOrder::query();
            return DataTables::of($data)->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $button = '';
                    $button .= '<a href="' . route('order.show', ['order' => $row->id]) . '" class="btn btn-success btn-xs"><span class="fa fa-external-link"></span></a>';
                    if ($row->status != 2) {
                        $button .= '<a href="' . route('order.edit', ['order' => $row->id]) . '" class="btn bg-orange btn-xs"><span class="fa fa-edit"></span></a>';
                        $button .= '<button class="btn btn-danger btn-xs" onClick="confirmDelete(event)" type="submit"><span class="fa fa-trash"></span></button>';
                    }
                    return '<div class="btn-group" style="width: 100%; text-align: center">
                    <form action="' . route('order.destroy', $row) . '" method="post">
                    ' . method_field('DELETE') . '
                    ' . csrf_field() . '
                    ' . $button . '
                    </form>
                  </div>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('pages.purchase-order.index', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Tambah Pembelian Barang';
        $details = [];
        return view('pages.purchase-order.form', compact('title', 'details'));
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
            'order_date' => 'required',
        ]);

        $model = new PurchaseOrder();
        $model->fill($request->all());
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
    public function show(Request $request)
    {
        $title = 'Detail Order';
        $model = PurchaseOrder::where('id', $request->order)->with('purchaseOrderDetails', 'purchaseOrderDetails.item', 'user')->first();

        return view('pages.purchase-order.show', compact('model', 'title'));
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
        $model = PurchaseOrder::find($request->order);
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
        $model = Items::select('id', 'name as text', 'order_price');
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
            'quantity' => 'required',
            'total' => 'required',
            'expired_date' => 'required',
        ]);

        $model = new PurchaseOrderDetail();
        $model->fill($request->all());
        $model->save();

        return redirect()->route('order.edit', ['order' => $model->purchase_order_id])->with('success', 'Tambah Barang Sukses');
    }

    /**
     * Delete child
     *
     */
    public function deleteChild(Request $request)
    {
        $model = PurchaseOrderDetail::find($request->id);
        if ($model) {
            $model->delete();
        }

        return redirect()->route('order.edit', ['order' => $model->purchase_order_id])->with('success', 'Delete item success');
    }

    /**
     * finalization order
     *
     */
    public function finishOrder(Request $request)
    {
        $model = PurchaseOrder::find($request->id);
        $model->fill($request->all());
        $model->status = 2;
        $model->save();

        $model->purchaseOrderDetails;

        OrderStock::dispatch($model);

        return redirect()->route('order.index')->with('success', 'Order selesai');
    }
}
