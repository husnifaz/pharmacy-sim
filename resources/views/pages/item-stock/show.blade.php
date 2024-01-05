@extends('default')
@section('content_header')
<x-title-bar title="{{$title}}" />
@endsection
@section('content')
<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <!-- /.box-header -->
      <div class="box-body">
        <div class="col">
          <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-so-add"><span class="fa fa-plus"></span>&emsp;Tambah Stock Opname Obat</button>
        </div>
        <table class="table table-bordered table-hover" id="table-data" width="100%">
          <thead>
            <tr>
              <th width="5%">No</th>
              <th>Stok</th>
              <th>Tanggal Kadaluarsa</th>
              <th>Nomor Batch</th>
              <th>Status</th>
              <th width="10%">Aksi</th>
            </tr>
          </thead>
          <tbody></tbody>
        </table>
      </div>
      <!-- /.box-body -->
    </div>
  </div>
</div>
@include('pages.item-stock.modal')
@endsection
@section('script')
<script>
  $(function() {
    var table = $('#table-data').DataTable({
      processing: true,
      serverSide: true,
      lengthChange: false,
      ajax: "{{ route('item-stock.show', ['id' => $id]) }}",
      columns: [{
          data: 'DT_RowIndex',
          name: 'DT_RowIndex',
          orderable: false,
          searchable: false
        },
        {
          data: 'quantity',
          name: 'quantity',
          orderable: false,
          searchable: false
        },
        {
          data: 'expired_date',
          name: 'expired_date'
        },
        {
          data: 'batch_number',
          name: 'batch_number'
        },
        {
          data: 'status_label',
          name: 'status',
          orderable: false,
          searchable: false
        },
        {
          data: 'action',
          name: 'action',
          orderable: false,
          searchable: false
        },
      ]
    });
  });

  function btPull(id) {
    $('#modal-pull').modal('show')
    $('#item_stock_id').val(id)
  }

  function btStockOpname(id) {
    $('#modal-so-add').modal('show')
    $('#item_stock_id').val(id)
  }

  $(".select-item").select2({
      ajax: {
        url: "{{route('prescription.list-item')}}", // Replace with your actual endpoint URL
        dataType: 'json',
        delay: 250,
        data: function(params) {
          return {
            query: params.term, // Search term
          };
        },
        processResults: function(data, params) {
          return {
            results: data,
          };
        },
        cache: true
      },
      placeholder: 'Ketik nama obat',
      minimumInputLength: 1
    })
</script>
@endsection