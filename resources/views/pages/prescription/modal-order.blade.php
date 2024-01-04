<div class="modal fade" id="modal-default">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action="{{route('prescription.store-detail')}}" id="store-detail" method="post">
				@csrf
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Tambah Obat</h4>
				</div>
				<div class="modal-body">
					<input type="hidden" name="prescription_id" value="{{isset($model) ? $model->id : null}}">
					<div class="row">
						<div class="form-group col-md-12">
							<label>Item</label>
							<select class="form-control select2 select-item" name="item_id" style="width: 100%;"></select>
						</div>
						<div class="form-group col-md-12">
							<label>Aturan Pakai</label>
							<select class="form-control select2 select-medicine-uses" name="medicine_uses_id" style="width: 100%;"></select>
						</div>
						<div class="form-group col-md-6">
							<label>Harga</label>
							<input type="text" class="form-control price-item" name="price" readonly>
						</div>
						<div class="form-group col-md-6">
							<label>Jumlah</label>
							<input type="text" class="form-control qty-item" name="quantity">
						</div>
						<div class="form-group col-md-12">
							<label>Total</label>
							<input type="text" class="form-control total-item" name="total">
						</div>
						<div class="form-group col-md-5">
							<label>Tanggal Kadaluarsa</label>
							<select class="form-control select2 select-expired" name="expired_date" style="width: 100%;" disabled></select>
						</div>
						<div class="form-group col-md-5">
							<label>Nomor Batch</label>
							<select class="form-control select2 select-batch" name="batch_number" style="width: 100%;" disabled></select>
						</div>
						<div class="form-group col-md-2">
							<label>Stok</label>
							<input type="text" class="form-control" id="total_stock" value="0" disabled>
						</div>
					</div>
				</div>
				<input type="hidden" name="item_stock_id" id="stock_id" value="">
				<div class="modal-footer">
					<input type="submit" class="btn btn-primary btn-submit" value="Tambah Obat" disabled>
				</div>
			</form>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>