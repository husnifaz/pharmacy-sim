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
    @if (isset($model))
    {!!Form::open(['route' => ['pegawai.update', $id], 'method' => 'put'])!!}
    @else
    {!!Form::open(array('action' => 'store', 'method' => 'post'))!!}
    @endif
      @csrf
      <div class="box-body col-md-8">
        <div class="form-group">
          {!!Form::label('name', 'Nama Pegawai')!!}
          {!!Form::text(['name' => 'nama', 'class' => 'form-control input-sm'])!!}
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
          <label>Parent Pegawai</label>
          <select class="form-control input-sm" name="parent_id">

          </select>
        </div>
        <input type="submit" class="btn btn-primary" value="submit"/>
      <!-- /.box-body -->
    </form>
  </div>
</div>
@endsection