@extends('default')
@section('content_header')
  <x-title-bar title="Form Edit Menu"/>
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
    <form role="form" action="{{url('menu/update', $model->id)}}" method="post">
      @csrf
      <div class="box-body col-md-8">
        <div class="form-group">
          <label>Nama Menu</label>
          <input type="text" class="form-control input-sm" name="name" value="{{$model->name}}">
        </div>
        <div class="form-group">
          <label>Url</label>
          <input type="text" class="form-control input-sm" name="url" value="{{$model->url}}">
        </div>
        <div class="form-group">
          <label>Order</label>
          <input type="text" class="form-control input-sm" name="order" value="{{$model->order}}">
        </div>
        <div class="form-group">
          <label>Ikon</label>
          <input type="text" class="form-control input-sm" name="icons" value="{{$model->icons}}">
        </div>
        <div class="form-group">
          <label>Parent Menu</label>
          <select class="form-control input-sm" name="parent_id">
            <option value="{{$model->parent_id}}" selected disabled hidden></option>
            @foreach(\App\Models\Menu::getListParentMenu() as $parent)
              <option value="{{$parent->id}}">{{$parent->name}}</option>
            @endforeach
          </select>
        </div>
        <input type="submit" class="btn btn-primary" value="submit"/>
      <!-- /.box-body -->
    </form>
  </div>
</div>
@endsection