<div class="modal fade" id="modal-default">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action="{{route('prescription.store-detail')}}" method="post">
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
							<input type="text" class="form-control qty-item" name="qty">
						</div>
						<div class="form-group col-md-6">
							<label>Tanggal Kadaluarsa</label>
							<select class="form-control select2 select-expired" name="expired_date" style="width: 100%;" disabled></select>
						</div>
						<div class="form-group col-md-6">
							<label>Nomor Batch</label>
							<select class="form-control select2 select-batch" name="item_stock_id" style="width: 100%;" disabled></select>
						</div>
						<div class="form-group col-md-12">
							<label>Total</label>
							<input type="text" class="form-control total-item" name="total">
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<input type="submit" class="btn btn-primary" value="Tambah Obat">
				</div>
			</form>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>