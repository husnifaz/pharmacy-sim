@extends('default')

@section('content_header')
<x-title-bar title="{{$title}}" />
@endsection

@section('content')
<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="col-md-6 col-xs-6" style="margin-top: 10px;">
        <a href="{{route('menu.create')}}" class="btn btn-primary btn-sm"><span class="fa fa-plus"></span>&emsp;Tambah Data</a>
      </div>
      <div class="box-body">
        <table class="table table-bordered table-hover" id="table-data">
          <thead>
            <tr>
              <th width="5%">No</th>
              <th>Nama Menu</th>
              <th>Url</th>
              <th width="5%">Order</th>
              <th>Ikon</th>
              <th width="20%">Parent Menu</th>
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
      ordering: false,
      ajax: "{{ route('menu.index') }}",
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
          data: 'url',
          name: 'url'
        },
        {
          data: 'order',
          name: 'order'
        },
        {
          data: 'icons',
          name: 'icons'
        },
        {
          data: 'menu_parent.name',
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