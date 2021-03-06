@extends('default')
@section('content_header')
  @if (isset($model))
  <x-title-bar title="Form Edit Pegawai"/>
  @else
  <x-title-bar title="Form Input Pegawai"/>
  @endif
  @if ($errors->any())
  <div class="{{'alert alert-danger alert-dismissible'}}">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    @foreach($errors->all() as $error)
      <li>{{$error}}</li>
    @endforeach
  </div>
  @endif
@endsection
@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="box">
      <div class="box-body">
        @if (isset($model))
        <form action="{{route('pegawai.update', $model->id)}}" method="post" enctype="multipart/form-data">
          @method('PUT')
        @else
        <form action="{{route('pegawai.store')}}" method="post" enctype="multipart/form-data">
        @endif
          @csrf
        <div class="row">
          <div class="col-md-12">
              <div class="box-body col-md-8">
                <div class="form-group">
                <label>NIK</label>
                  <input type="text" class="form-control input-sm" name="nik" value="{{isset($model) ? $model->nik : old('nik')}}">
                </div>
                <div class="form-group">
                  <label>Nama Lengkap</label>
                  <input type="text" class="form-control input-sm" name="nama" value="{{isset($model) ? $model->nama : old('nama')}}">
                </div>
                <div class="form-group">
                  <div class="radio">
                    <label>
                      <input type="radio" name="gender" id="optionsRadios1" value="1" {{isset($model) ? $model->gender == 1 ? 'checked' : '' : ''}}>
                      Laki-laki
                    </label>
                  </div>
                  <div class="radio">
                    <label>
                      <input type="radio" name="gender" id="optionsRadios2" value="2" {{isset($model) ? $model->gender == 2 ? 'checked' : '' : ''}}>
                      Perempuan
                    </label>
                  </div>
                </div>
                <div class="form-group">
                  <label>Alamat</label>
                  <textarea class="form-control" rows="3" name="alamat">{{isset($model) ? $model->alamat : old('alamat')}}</textarea>
                </div>
                <div class="form-group">
                  <label>Tanggal Lahir</label>
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right" id="datepicker" name="tgl_lahir" value="{{isset($model) ? \Carbon\Carbon::parse($model->tgl_lahir)->format('d-m-Y') : old('tgl_lahir')}}">
                  </div>
                  <!-- /.input group -->
                </div>
                <div class="form-group">
                <label>No Telp.</label>
                  <input type="number" class="form-control input-sm" name="no_telp" value="{{isset($model) ? $model->no_telp : old('no_telp')}}">
                </div>
                <input type="submit" class="btn btn-primary" value="submit"/>
              <!-- /.box-body -->
            </div>
              <div class="box-body col-md-4">
                <div class="text-center">
                  <img src="{{asset('img/default-user-image.png')}}" class="img-circle" alt="User Image" width="200">
                  <div class="form-group">
                      <label for="exampleInputFile">Pilih Gambar</label>
                      <input type="file" id="exampleInputFile" style="margin-left: 4rem;" name="image">
                  </div>
                </div>
              </div>
            </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

