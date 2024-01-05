<div class="modal fade" id="modal-pull">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action="{{route('item-stock.pull')}}" method="post" id="form-pull-item">
				@csrf
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Tarik Barang</h4>
				</div>
				<div class="modal-body">
					<input type="hidden" name="item_stock_id" id="item_stock_id" value="">
					<div class="row">
						<div class="form-group col-md-12">
							<label>Status</label>
							<select class="form-control" id="status_stock" name="status" style="width: 100%;" required>
								<option value="" selected="selected">Pilih Status</option>
								@foreach ($statusList as $key => $list)
								<option value="{{$key}}">{{$list}}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group col-md-12">
							<label>Remarks</label>
							<textarea class="form-control" name="remarks" rows="5" id="remarks" required></textarea>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<input type="submit" class="btn btn-primary btn-submit" value="Tambah Obat">
				</div>
			</form>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modal-so-add">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action="{{route('item-stock.add-stock-opname')}}" method="post">
				@csrf
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Tambah Stok by SO</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<input type="hidden" name="item_stock_id" value="" id="item_stock_id">
						<div class="form-group col-md-12">
							<label>Item</label>
							<input type="text" class="form-control" value="{{$itemName}}" disabled/>
							<input type="hidden" class="form-control" name="item_id" value="{{$id}}"/>
						</div>
						<div class="form-group col-md-5">
							<label>Tanggal Kadaluarsa</label>
							<input type="date" class="form-control" name="expired_date" />
						</div>
						<div class="form-group col-md-5">
							<label>Nomor Batch</label>
							<input type="text" class="form-control" name="batch_number" />
						</div>
						<div class="form-group col-md-2">
							<label>Stok</label>
							<input type="text" class="form-control" id="total_stock" name="quantity">
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<input type="submit" class="btn btn-primary btn-submit" value="Tambah Stok">
				</div>
			</form>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>