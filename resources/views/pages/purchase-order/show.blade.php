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
						<label>Tanggal Order</label>
						<p>{{\Carbon\Carbon::parse($model->order_date)->locale('id')->translatedFormat('d F Y')}}</p>
					</div>
					<div class="col-md-3">
						<label>Status</label>
						<br>
						<p class="label bg-green" style="font-size: 14px;">{{$model->status_label}}</p>
					</div>
					<div class="col-md-3">
						<label>Dibuat Oleh</label>
						<p>{{$model->user->name ?? ''}}</p>
					</div>
					<div class="col-md-12">
						<label>Remark</label>
						<p>{{$model->remarks}}</p>
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
								<td>{{$detail->order_price}}</td>
								<td>{{$detail->quantity}}</td>
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