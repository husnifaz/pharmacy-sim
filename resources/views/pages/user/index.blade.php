@extends('default')
@section('content_header')
<x-title-bar title="{{$title}}" />
@endsection
@section('content')
<div class="row">
  <div class="col-xs-2 mb-10">
    <a href="{{route('user.create')}}" class="btn btn-primary btn-sm"><span class="fa fa-plus"></span>&emsp;Tambah Data</a>
  </div>
  <div class="col-xs-12">
    <div class="box">
      <!-- /.box-header -->
      <div class="box-body">
        <table class="table table-bordered table-hover" id="table-data">
          <thead>
            <tr>
              <th width="3%">No</th>
              <th>Nama</th>
              <th>Email</th>
              <th width="8%">Aksi</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
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
      ajax: "{{ route('user.index') }}",
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
          data: 'email',
          name: 'email'
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