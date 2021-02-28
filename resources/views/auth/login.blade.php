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
    @if ($errors->any())
    <div class="callout callout-danger">
      @foreach($errors->all() as $error)
      <p>{{$error}}</p>
      @endforeach
    </div>
    @endif
    <form action="{{route('login')}}" method="post">
    @csrf
      <div class="form-group @error('email') has-error @enderror has-feedback">
        <input type="email" class="form-control" placeholder="Email" name="email" value="{{old('email')}}">
        <span class="fa fa-envelope form-control-feedback"></span>
      </div>
      <div class="form-group @error('password') has-error @enderror has-feedback">
        <input type="password" class="form-control" placeholder="Password" name="password">
        <span class="fa fa-lock form-control-feedback"></span>
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
        <div class="col-xs-12">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
    <!-- /.social-auth-links -->
    <br/>
    <a href="#">I forgot my password</a><br>
    <a href="{{route('register')}}" class="text-center">Register a new membership</a>
  </div>
  <!-- /.login-box-body -->
</div>
@endsection