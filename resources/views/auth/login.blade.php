@extends('auth.baseauth')
@section('title', 'Halaman Login')
@section('content')
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
  <a href="{{url('')}}"><b>About</b>Laravel</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>

    <form action="{{route('login')}}" method="post">
    @csrf
      <div class="form-group @error('password') has-error @enderror">
        <input type="email" class="form-control" placeholder="Email" name="email" value="{{old('email')}}">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        @error('email')
          <span class="help-block">{{$message}}</span>
        @enderror
      </div>
      <div class="form-group @error('password') has-error @enderror">
        <input type="password" class="form-control" placeholder="Password" name="password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        @error('password')
          <span class="help-block">{{$message}}</span>
        @enderror
      </div>
      <div class="row">
        <!-- <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> Remember Me
            </label>
          </div>
        </div> -->
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
    <!-- /.social-auth-links -->

    <a href="#">I forgot my password</a><br>
    <a href="register.html" class="text-center">Register a new membership</a>

  </div>
  <!-- /.login-box-body -->
</div>
@endsection