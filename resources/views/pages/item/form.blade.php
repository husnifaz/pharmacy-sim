@extends('default')
@section('content_header')
  @if (isset($model))
  <x-title-bar title="Form Edit Item"/>
  @else
  <x-title-bar title="Form Input Item"/>
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
        <form action="{{route('item.update', $model->id)}}" method="post" enctype="multipart/form-data">
          @method('PUT')
        @else
        <form action="{{route('item.store')}}" method="post" enctype="multipart/form-data">
        @endif
          @csrf
        <div class="row">
          <div class="col-md-12">
              <div class="box-body col-md-8">
                <div class="form-group">
                <label>Nama Obat</label>
                  <input type="text" class="form-control input-sm" name="name" value="{{isset($model) ? $model->nik : old('name')}}">
                </div>
                <div class="form-group">
                  <label>Generik</label>
                  <input type="text" class="form-control input-sm" name="generik" value="{{isset($model) ? $model->nama : old('generik')}}">
                </div>
                <input type="submit" class="btn btn-primary" value="submit"/>
              <!-- /.box-body -->
            </div>
            </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

