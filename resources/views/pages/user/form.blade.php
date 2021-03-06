@extends('default')
@section('content_header')
  @if (isset($model))
  <x-title-bar title="Form Edit Pengguna"/>
  @else
  <x-title-bar title="Form Input Pengguna"/>
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
        <form action="{{route('user.update', $model->id)}}" method="post">
          @method('PUT')
        @else
        <form action="{{route('user.store')}}" method="post" enctype="multipart/form-data">
        @endif
          @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="box-body col-md-7">
                <div class="form-group">
                <label>Nama Lengkap</label>
                  <input type="text" class="form-control input-sm" name="name" value="{{isset($model) ? $model->name : old('name')}}" disabled>
                </div>
                <div class="form-group">
                  <label>Email</label>
                  <input type="email" class="form-control input-sm" name="email" value="{{isset($model) ? $model->email : old('email')}}">
                </div>
                <div class="form-group">
                  <label>Password</label>
                  <input type="password" class="form-control input-sm" value="" disabled>
                </div>
                <input type="submit" class="btn btn-primary" value="Simpan"/>
              </div>
              <!-- /.box-body -->
              <div class="col-md-4" style="margin-left: 5rem; margin-top: 2rem">
                <div class="panel box box-primary">
                  <div class="box-header with-border">
                    <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                        Daftar Otoritas
                      </a>
                    </h4>
                  </div>
                  <div id="collapseOne" class="panel-collapse collapse in">
                    <div class="box-body">
                    <div class="form-group">
                      @foreach (\App\Models\Menu::whereNotNull('parent_id')->get() as $menu)
                      <div class="checkbox">
                        <label>
                          <input type="checkbox" name="roles[]" value="{{$menu->id}}" checked>
                          {{$menu->name}}
                        </label>
                      </div>
                      @endforeach
                    </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

