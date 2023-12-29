@extends('default')

@section('content_header')
<x-title-bar title="{{$title}}" />
@endsection

@section('content')
<div class="row">
  <div class="col-xs-2 mb-10">
    <a href="{{route('prescription.create')}}" class="btn btn-primary btn-sm"><span class="fa fa-plus"></span>&emsp;Tambah Data</a>
  </div>
  <div class="col-xs-12">
    <div class="box">
      <div class="box-body">
        <table class="table table-bordered table-hover" id="table-data" width="100%">
          <thead>
            <tr>
              <th width="5%">No</th>
              <th>Nomor Penjualan</th>
              <th>Tanggal Order</th>
              <th>Status</th>
              <th>User Input</th>
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
      ajax: "{{ route('prescription.index') }}",
      columns: [{
          data: 'DT_RowIndex',
          name: 'DT_RowIndex',
          orderable: false,
          searchable: false
        },
        {
          data: 'number',
          name: 'number'
        },
        {
          data: 'order_date',
          name: 'order_date'
        },
        {
          data: 'status_label',
          name: 'status',
          defaultContent: ''
        },
        {
          data: 'created_by',
          name: 'created_by',
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