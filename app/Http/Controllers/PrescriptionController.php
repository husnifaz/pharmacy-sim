<?php

namespace App\Http\Controllers;

use App\Jobs\OrderStock;
use App\Models\Items;
use App\Models\ItemStock;
use App\Models\MedicineUses;
use App\Models\PrescriptionDetails;
use App\Models\Prescriptions;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderDetail;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PrescriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = 'Daftar Penjualan Obat';

        if ($request->ajax()) {
            $data = Prescriptions::query();
            return DataTables::of($data)->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $button = '';
                    $button .= '<a href="' . route('prescription.show', ['order' => $row->id]) . '" class="btn btn-success btn-xs"><span class="fa fa-external-link"></span></a>';
                    if ($row->status != 2) {
                        $button .= '<a href="' . route('prescription.edit', ['order' => $row->id]) . '" class="btn bg-orange btn-xs"><span class="fa fa-edit"></span></a>';
                        $button .= '<button class="btn btn-danger btn-xs" onClick="confirmDelete(event)" type="submit"><span class="fa fa-trash"></span></button>';
                    }
                    return '<div class="btn-group" style="width: 100%; text-align: center">
                    <form action="' . route('prescription.destroy', $row) . '" method="post">
                    ' . method_field('DELETE') . '
                    ' . csrf_field() . '
                    ' . $button . '
                    </form>
                  </div>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('pages.prescription.index', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Tambah Penjualan Obat';
        $details = [];
        return view('pages.prescription.form', compact('title', 'details'));
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
            'order_date' => 'required',
        ]);

        $model = new Prescriptions();
        $model->fill($request->all());
        $model->number = Prescriptions::generateNumber();
        $model->created_by = auth()->user()->id;
        $model->save();

        return redirect()->route('prescription.edit', ['order' => $model->id])->with('success', 'Save Success');
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
        $model = PurchaseOrder::find($request->order)->with('purchaseOrderDetails', 'purchaseOrderDetails.item')->first();

        $model->append('created_by_label');

        return view('pages.prescription.show', compact('model', 'title'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\employees  $employees
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $title = 'Detail Penjualan Barang';
        $model = Prescriptions::find($request->order);
        $details = PrescriptionDetails::where('prescription_id', $request->order)->get();

        return view('pages.prescription.form', compact('model', 'title', 'details'));
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
     * dropdown obat
     */
    public function listItemStock(Request $request)
    {
        $item = $request->get('item_id', false);
        $ed = $request->get('expired_date', false);
        $batch = $request->get('batch_number', false);

        $model = ItemStock::select('id', 'expired_date', 'batch_number');
        if ($item) {
            $model = $model->where('item_id', $item);
        }
        if ($ed) {
            $model = $model->where('expired_date', $ed);
        }
        if ($batch) {
            $model = $model->where('batch_number', $batch);
        }

        $model = $model->get();

        return response()->json($model);
    }

    /**
     * dropdown obat
     */
    public function listMedicineUses(Request $request)
    {
        $term = $request->get('query', false);

        $model = MedicineUses::select('id', 'name AS text');
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
            'item_stock_id' => 'required',
        ]);

        $model = new PrescriptionDetails();
        $model->fill($request->all());
        $model->created_by = auth()->user()->id;
        $model->save();

        return redirect()->route('prescription.edit', ['order' => $model->prescription_id])->with('success', 'Tambah Barang Sukses');
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

        return redirect()->route('prescription.edit', ['order' => $model->purchase_order_id])->with('success', 'Delete item success');
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

        return redirect()->route('prescription.index')->with('success', 'Order selesai');
    }
}
