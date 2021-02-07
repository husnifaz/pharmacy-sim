@extends('default')
@section('content_header')
  <x-title-bar title="List pegawai"/>
@endsection
@section('content')
    <div class="row">
      @if ($message = Session::get('success'))
      <div class="col-xs-12">
        <div class="alert alert-success alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <h4><i class="icon fa fa-check"></i>Success</h4>
          {{$message}}
        </div>
      </div>
      @endif
      <div class="col-xs-2 mb-10">
        <a href="{{route('pegawai.create')}}" class="btn btn-primary btn-sm"><span class="fa fa-plus"></span>&emsp;Tambah Data</a>
      </div>
      <div class="col-xs-12">
        <div class="box">
          <!-- /.box-header -->
          <div class="box-body">
            <table class="table table-bordered table-hover" id="data1">
              <thead>
              <tr>
                <th width="5%">No</th>
                <th>Nama pegawai</th>
                <th>NIK</th>
                <th width="10%">Aksi</th>
              </tr>
              </thead>
              <tbody>
              @foreach ($model as $key => $item)
                <tr>
                  <td>{{$key+1}}</td>
                  <td>{{$item->name}}</td>
                  <td>{{$item->nik}}</td>
                  <td>
                    <div class="btn-group">
                      <a href="" class="btn bg-olive btn-xs"><span class="fa fa-eye"></span></a>
                      <a href="pegawai/edit/{{$item->id}}" class="btn bg-orange btn-xs"><span class="fa fa-edit"></span></a>
                      <a class="btn btn-danger btn-xs" onClick="confirm('Apakah Anda Yakin ?')" href="pegawai/delete/{{$item->id}}"><span class="fa fa-trash"></span></a>
                    </div>
                  </td>
                </tr>
              @endforeach
              </tbody>
            </table>
          </div>
          <!-- /.box-body -->
        </div>
      </div>
    </div>
@endsection