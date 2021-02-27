@extends('auth.baseauth')
@section('title', 'Halaman Registrasi')
@section('content')
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href="{{url('')}}"><b>About</b>Laravel</a>
  </div>

  <div class="register-box-body">
    <p class="login-box-msg">Silahkan isi identitas</p>

    <form action="{{route('register')}}" method="post">
      @csrf
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Nama Lengkap" name="name" value="{{old('name')}}">
        <span class="form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="email" class="form-control" placeholder="Email" name="email" value="{{old('email')}}">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group @error('password') has-error @enderror">
        <input type="password" class="form-control" placeholder="Kata Sandi" name="password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        @error('password')
          <span class="help-block">{{$message}}</span>
        @enderror
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Konfirmasi Sandi" name="password_confirmation">
        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col">
          <div class="checkbox icheck">
            <div>
              <label>
                <input type="checkbox"> Saya menyetujui syarat dan ketentuan yang berlaku <a href="#">terms</a>
              </label>
            </div>
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.col -->
      <div class="col">
        <button type="submit" class="btn btn-primary btn-block btn-flat">Dafter</button>
      </div>
    </form>

    <a href="login.html" class="text-center">Saya Telah Mempunyai Akun</a>
  </div>
  <!-- /.form-box -->
</div>
@endsection