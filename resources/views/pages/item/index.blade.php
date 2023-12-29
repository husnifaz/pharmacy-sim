@extends('default')
@section('content_header')
<x-title-bar title="{{$title}}" />
@endsection
@section('content')
<div class="row">
  <div class="col-xs-2 mb-10">
    <a href="{{route('item.create')}}" class="btn btn-primary btn-sm"><span class="fa fa-plus"></span>&emsp;Tambah Data</a>
  </div>
  <div class="col-xs-12">
    <div class="box">
      <!-- /.box-header -->
      <div class="box-body">
        <table class="table table-bordered table-hover" id="table-data" width="100%">
          <thead>
            <tr>
              <th width="5%">No</th>
              <th>Nama Item</th>
              <th>Generik</th>
              <th>Harga Beli</th>
              <th>Harga Jual</th>
              <th>Satuan</th>
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
@endsection
@section('script')
<script>
  $(function() {
    var table = $('#table-data').DataTable({
      processing: true,
      serverSide: true,
      lengthChange: false,
      ajax: "{{ route('item.index') }}",
      columns: [{
          data: 'DT_RowIndex',
          name: 'DT_RowIndex',
          orderable: false,
          searchable: false
        },
        {
          data: 'name',
          name: 'name'
        },
        {
          data: 'generic',
          name: 'generic'
        },
        {
          data: 'order_price',
          name: 'order_price'
        },
        {
          data: 'price',
          name: 'price'
        },
        {
          data: 'unit_medicine.name',
          defaultContent: ''
        },
        {
          data: 'status_label',
          defaultContent: ''
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
</script>
@endsection