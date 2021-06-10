@extends('default')
@section('content_header')
<x-title-bar title="Detail User" />
@endsection
@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="box box-primary">
      <div class="box-body">
        <div class="row group-detail">
          <div class="col-md-3">
            <label>Nama User</label>
            <p>{{$model->name}}</p>
          </div>
          <div class="col-md-3">
            <label>Email</label>
            <p>{{$model->email}}</p>
          </div>
        </div>
        <div class="row group-detail">
          <div class="col-md-3">
            <label>Hak Akses</label>
            <p></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection