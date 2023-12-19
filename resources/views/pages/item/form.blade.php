@extends('default')
@section('content_header')
<x-title-bar title="{{$title}}" />
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
                    <input type="text" class="form-control input-sm" name="generic" value="{{isset($model) ? $model->generic : old('generic')}}">
                  </div>
                  <div class="form-group">
                    <label>Harga</label>
                    <input type="number" class="form-control input-sm" name="price" value="{{isset($model) ? $model->price : old('price')}}">
                  </div>
                  <div class="form-group">
                        <div class="icheck-primary">
                          <input type="checkbox" class="check-val" name="status" id="label_status" value="0" {{isset($model) ? ($model->status) ? 'checked' : '' : 'checked'}} >
                          <label for="label_status">Aktif</label>
                        </div>
                      </div>
                  <input type="submit" class="btn btn-primary btn-submit" value="submit" />
                </div>
          </form>
      </div>
    </div>
  </div>
</div>
@endsection