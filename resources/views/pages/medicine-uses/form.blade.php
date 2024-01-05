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
        <form action="{{route('medicine-use.update', $model)}}" method="post">
          @method('PUT')
          @else
          <form action="{{route('medicine-use.store')}}" method="post">
            @endif
            @csrf
            <div class="row">
              <div class="col-md-12">
                <div class="box-body col-md-8">
                  <div class="form-group">
                    <label>Nama</label>
                    <input type="text" class="form-control" name="name" value="{{isset($model) ? $model->name : old('name')}}">
                  </div>
                  <div class="form-group">
                    <div class="radio">
                      <label style="margin-right: 20px;">
                        <input type="radio" name="status" id="optionsRadios1" value="1" {{isset($model) ? $model->status == 1 ? 'checked' : '' : 'checked'}}>
                        Aktif
                      </label>
                      <label>
                        <input type="radio" name="status" id="optionsRadios2" value="0" {{isset($model) ? $model->status == 0 ? 'checked' : '' : ''}}>
                        Non Aktif
                      </label>
                    </div>
                  </div>
                  <input type="submit" class="btn btn-primary btn-submit" value="submit" />
                </div>
              </div>
            </div>
          </form>
      </div>
    </div>
  </div>
</div>
@endsection