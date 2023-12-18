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
        <form action="{{route('user.update', $model->id)}}" method="post" enctype="multipart/form-data">
          @else
          <form action="{{route('user.store')}}" method="post" enctype="multipart/form-data">
            @endif
            @csrf
            <div class="row">
              <div class="col-md-12">
                <div class="box-body col-md-6">
                  <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" class="form-control" name="name" value="{{isset($model) ? $model->name : old('name')}}">
                  </div>
                  <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" name="email" value="{{isset($model) ? $model->email : old('email')}}">
                  </div>
                  <div class="form-group">
                    <label>Password</label>
                    <div class="input-group">
                      <input type="password" id="password" class="form-control" value="" data-toggle="password" name="password">
                      <span class="input-group-addon input-group-text"><i class=" fa fa-eye"></i>
                      </span>
                    </div>
                  </div>
                  <div class="form-group">
                    <label>Konfirmasi Password</label>
                    <div class="input-group">
                      <input type="password" id="password_retype" class="form-control" value="" data-toggle="password" name="retype_password">
                      <span class="input-group-addon input-group-text"><i class=" fa fa-eye"></i>
                      </span>
                    </div>
                  </div>
                  <div class="form-group">
                    <div>
                      <!-- <img src="{{asset('img/default-user-image.png')}}" class="img-circle" alt="User Image" width="100" id="preview"> -->
                      <div class="form-group">
                        <label for="exampleInputFile">Pilih Gambar</label>
                        <div id="preview"></div>
                        <input type="file" id="file-input" name="image">
                      </div>
                    </div>
                  </div>
                  <input type="submit" class="btn btn-primary btn-submit" value="Simpan" />
                </div>
                <!-- /.box-body -->
                <div class="col-md-5" style="margin-left: 5rem;">
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
                        <div class="icheck-primary">
                          <input type="checkbox" name="roles[]" value="{{$menu->id}}" checked id="label_{{$menu->id}}">
                          <label for="label_{{$menu->id}}">{{$menu->name}}</label>
                        </div>
                        @endforeach
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