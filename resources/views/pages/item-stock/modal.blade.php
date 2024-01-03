<div class="modal fade" id="modal-pull">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action="{{route('item-stock.pull')}}" method="post">
				@csrf
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Tarik Barang</h4>
				</div>
				<div class="modal-body">
					<input type="hidden" name="item_stock_id" value="">
					<div class="row">
						<div class="form-group col-md-12">
							<label>Status</label>
							<select class="form-control select2" id="status_stock" name="status" style="width: 100%;"></select>
						</div>
						<div class="form-group col-md-6">
							<label>Remarks</label>
							<textarea class="form-control" name="remarks" rows="5" id="remarks"></textarea>
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