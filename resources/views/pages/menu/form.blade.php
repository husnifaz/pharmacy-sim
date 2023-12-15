@extends('default')
@section('content_header')
@if (isset($model))
<x-title-bar title="Form Edit Menu" />
@else
<x-title-bar title="Form Input Menu" />
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
        <form role="form" action="{{url('menu/update', $model->id)}}" method="post">
          @else
          <form role="form" action="store" method="post">
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
              <input type="submit" class="btn btn-primary" value="submit" />
              <!-- /.box-body -->
          </form>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')
<script>
  $('input[type="submit"]').click(function(e) {
    e.preventDefault()
    Swal.fire({
      title: "Good job!",
      text: "You clicked the button!",
      icon: "success"
    });
    // console.log(this.closest("form").submit())
  })
</script>
@endsection