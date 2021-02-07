@extends('default')
@section('content_header')
  @if (isset($model))
  <x-title-bar title="Form Edit Menu"/>
  @else
  <x-title-bar title="Form Input Menu"/>
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
    @if (isset($model))
    <form role="form" action="{{url('menu/update', $model->id)}}" method="post">
    @else
    <form role="form" action="store" method="post">
    @endif
      @csrf
      <div class="box-body col-md-8">
        <div class="form-group">
          <label>Nama Menu</label>
          <input type="text" class="form-control input-sm" name="name" value="{{isset($model) ? $model->name : old('name')}}">
        </div>
        <div class="form-group">
          <label>Url</label>
          <input type="text" class="form-control input-sm" name="url" value="{{isset($model) ? $model->url : old('url')}}">
        </div>
        <div class="form-group">
          <label>Order</label>
          <input type="text" class="form-control input-sm" name="order" value="{{isset($model) ? $model->order : old('order')}}">
        </div>
        <div class="form-group">
          <label>Ikon</label>
          <input type="text" class="form-control input-sm" name="icons" value="{{isset($model) ? $model->icons : old('icons')}}">
        </div>
        <div class="form-group">
          <label>Parent Menu</label>
          <select class="form-control input-sm" name="parent_id">
            @foreach(\App\Models\Menu::getListParentMenu() as $parent)
              @if (isset($model))
                @if (isset($model->parent_id))
                <option value="{{$parent->id}}" {{($parent->id == $model->id) ? 'selected' : ''}}>{{$parent->name}}</option>
                @else
                <option value=""></option>
                @endif
              @else
              <option value="" selected disabled hidden>-Pilih-</option>
              <option value="{{$parent->id}}">{{$parent->name}}</option>
              @endif
            @endforeach
          </select>
        </div>
        <input type="submit" class="btn btn-primary" value="submit"/>
      <!-- /.box-body -->
    </form>
  </div>
</div>
@endsection