<div class="modal fade" id="modal-default">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action="{{route('order.store-detail')}}" method="post">
				@csrf
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Default Modal</h4>
				</div>
				<div class="modal-body">
					<input type="hidden" name="purchase_order_id" value="{{isset($model) ? $model->id : null}}">
					<div class="row">
						<div class="form-group col-md-12">
							<label>Item</label>
							<select class="form-control select2 itemId" name="item_id" style="width: 100%;"></select>
						</div>
						<div class="form-group col-md-12">
							<label>Harga</label>
							<input type="text" class="form-control price-item" name="price" readonly>
						</div>
						<div class="form-group col-md-12">
							<label>Jumlah</label>
							<input type="text" class="form-control qty-item" name="qty">
						</div>
						<div class="form-group col-md-12">
							<label>Tanggal Kadaluarsa</label>
							<input type="text" class="form-control expired-item" id="datepicker-expired" name="expired_date">
						</div>
						<div class="form-group col-md-12">
							<label>Nomor Batch</label>
							<input type="text" class="form-control batch-item" name="batch_number">
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