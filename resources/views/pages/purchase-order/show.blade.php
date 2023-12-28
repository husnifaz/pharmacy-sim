@extends('default')
@section('content_header')
<x-title-bar title="{{$title}}" />
@endsection
@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="box">
			<div class="box-body">
				<div class="row group-detail">
					<div class="col-md-3">
						<label>Nomor Order</label>
						<p>{{$model->number}}</p>
					</div>
					<div class="col-md-3">
						<label>Distributor</label>
						<p>{{$model->distributor}}</p>
					</div>
					<div class="col-md-3">
						<label>Tanggal Order</label>
						<p>{{$model->order_date}}</p>
					</div>
				</div>
				<div class="row group-detail">
					<div class="col-md-3">
						<label>Status</label>
						<p><b>{{$model->status_label}}<b></p>
					</div>
					<div class="col-md-3">
						<label>Dibuat Oleh</label>
						<p>{{$model->created_by_label}}</p>
					</div>
				</div>
			</div>
			<div class="box-body" style="margin-top: 2rem;">
				<table class="table table-bordered table-hover" style="margin-bottom: 2rem;">
					<thead>
						<tr>
							<th width="5%">No</th>
							<th>Nama Obat</th>
							<th>Harga</th>
							<th>Jumlah</th>
							<th width="10%">Tanggal Kadaluarsa</th>
							<th>Nomor Batch</th>
							<th>Total</th>
						</tr>
					</thead>
					<tbody>
						@foreach($model->purchaseOrderDetails as $key => $detail)
						<tr>
							<td>{{$key + 1}}</td>
							<td>{{$detail->item->name}}</td>
							<td>{{$detail->price}}</td>
							<td>{{$detail->qty}}</td>
							<td>{{$detail->expired_date}}</td>
							<td>{{$detail->batch_number}}</td>
							<td>{{$detail->total}}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection