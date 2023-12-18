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
        <form role="form" action="{{route('menu.update', $model)}}" method="post">
          @else
          <form role="form" action="{{route('menu.store')}}" method="post">
            @endif
            @csrf
            <div class="box-body">
              <div class="row">
                <div class="form-group col-md-6">
                  <label>Nama Menu</label>
                  <input type="text" class="form-control" name="name" value="{{isset($model) ? $model->name : old('name')}}">
                </div>
                <div class="form-group col-md-6">
                  <label>Url</label>
                  <input type="text" class="form-control" name="url" value="{{isset($model) ? $model->url : old('url')}}">
                </div>
              </div>
              <div class="row">
                <div class="form-group col-md-4">
                  <label>Order</label>
                  <input type="text" class="form-control" name="order" value="{{isset($model) ? $model->order : old('order')}}">
                </div>
                <div class="form-group col-md-4">
                  <label>Ikon</label>
                  <input type="text" class="form-control" name="icons" value="{{isset($model) ? $model->icons : old('icons')}}">
                </div>
                <div class="form-group col-md-4">
                  <label>Parent Menu</label>
                  <select class="form-control select2" name="parent_id">
                    <option value="">&nbsp;</option>
                    @foreach(\App\Models\Menu::getListParentMenu() as $parent)
                    @if (isset($model->parent_id))
                    <option value="{{$parent->id}}" {{($parent->id == $model->id) ? 'selected' : ''}}>{{$parent->name}}</option>
                    @else
                    <option value="{{$parent->id}}">{{$parent->name}}</option>
                    @endif
                    @endforeach
                  </select>
                </div>
              </div>
              <input type="submit" class="btn btn-primary btn-submit" value="submit" />
              <!-- /.box-body -->
          </form>
      </div>
    </div>
  </div>
</div>
@endsection