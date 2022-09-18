<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" name="viewport">
  <title>@yield('title')</title>
  <link rel="icon" href="{{asset('img/AL.ico')}}" type="image/ico" />
  <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('css/font-awesome/css/font-awesome.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{asset('css/ionicons.min.css')}}">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{asset('css/select2.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('css/AdminLTE.min.css')}}">
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
            page. However, you can choose any other skin. Make sure you
            apply the skin class to the body tag so the changes take effect. -->
  <link rel="stylesheet" href="{{asset('css/skin-blue.min.css')}}">

  <link rel="stylesheet" href="{{asset('css/dataTables.bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('css/bootstrap-datepicker.min.css')}}">

  <link rel="stylesheet" href="{{asset('css/personal.css')}}">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.3.10/dist/sweetalert2.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/icheck-bootstrap/3.0.1/icheck-bootstrap.min.css">
</head>

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">
    <div id="header">
      @include('parts.header')
    </div>
    <div id="menu">
      @include('parts.menu')
    </div>
    <div id="content">
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          @yield('content_header')
        </section>

        <!-- Main content -->
        <section class="content">
          @yield('content')
        </section>
        <!-- /.content -->
      </div>
    </div>
    <div id="footer">
      @include('parts.footer')
    </div>
  </div>
  <!-- jQuery 3 -->
  <script src="{{asset('js/jquery.min.js')}}"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="{{asset('js/bootstrap.min.js')}}"></script>
  <!-- AdminLTE App -->
  <script src="{{asset('js/adminlte.min.js')}}"></script>
  <script src="{{asset('js/select2.full.min.js')}}"></script>
  <script src="{{asset('js/bootstrap-show-password.min.js')}}"></script>
  <script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('js/dataTables.bootstrap.min.js')}}"></script>
  <script src="{{asset('js/jquery.slimscroll.min.js')}}"></script>
  <script src="{{asset('js/bootstrap-datepicker.min.js')}}"></script>
  <script src="{{asset('js/main.js')}}"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.3.10/dist/sweetalert2.all.min.js"></script>
  @yield('script');
</body>
@include('parts.modal')

</html>