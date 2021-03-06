@extends('default')
@section('content_header')
  <x-title-bar title="Detail Pegawai"/>
@endsection
@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="box box-primary">
      <div class="box-body">
        <div class="box-header with-border">
            <h3 class="box-title">Pegawai : {{$model->nama}}</h3>
        </div>
        <div class="row">
            <div class="col-md-5" style="margin: 2rem">
                <img src="{{$model->image_url ? asset('storage/'.$model->image_url) : asset('img/default-user-image.png')}}" class="img-circle" alt="User Image" width="100">
            </div>
        </div>
        <div class="row group-detail">
            <div class="col-md-3">
                <label>Nama Lengkap</label>
                <p>{{$model->nama}}</p>
            </div>
            <div class="col-md-3">
                <label>NIK</label>
                <p>{{$model->nik}}</p>
            </div>
            <div class="col-md-3">
                <label>Jenis Kelamin</label>
                <p>{{$model->gender_label}}</p>
            </div>
            <div class="col-md-3">
                <label>Alamat</label>
                <p>{{$model->alamat}}</p>
            </div>
        </div>
        <div class="row group-detail">

            <div class="col-md-3">
                <label>Tanggal Lahir</label>
                <p>{{\Carbon\Carbon::parse($model->tgl_lahir)->locale('id')->translatedFormat('d F Y')}}</p>
            </div>
            <div class="col-md-3">
                <label>No. Telepon</label>
                <p>{{$model->no_telp}}</p>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

