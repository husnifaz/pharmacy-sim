<div class="modal fade" id="modal-default">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Default Modal</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="form-group col-md-12">
						<label>Item</label>
						<select class="form-control select2 itemId" style="width: 100%;"></select>
					</div>
					<div class="form-group col-md-12">
						<label>Harga</label>
						<input type="text" class="form-control price-item" value="" readonly>
					</div>
					<div class="form-group col-md-12">
						<label>Jumlah</label>
						<input type="text" class="form-control qty-item" name="number" data-order=1 value="">
					</div>
					<div class="form-group col-md-12">
						<label>Total</label>
						<input type="text" class="form-control total-item" name="number" data-order=1 value="">
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary">Tambah Barang</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>