<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" name="viewport">
  <title>@yield('title')</title>
  <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
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

  <!-- <link rel="stylesheet" href="{{asset('css/dataTables.bootstrap.min.css')}}"> -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="{{asset('assets/sweetalert2.css')}}">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/icheck-bootstrap/3.0.1/icheck-bootstrap.min.css">
  <link rel="stylesheet" href="{{asset('css/personal.css?v.1')}}">
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
  <script src="{{asset('assets/sweetalert2.js')}}"></script>
  <script src="{{asset('js/select2.full.min.js')}}"></script>
  <script src="{{asset('js/bootstrap-show-password.min.js')}}"></script>
  <script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('js/dataTables.bootstrap.min.js')}}"></script>
  <script src="{{asset('js/jquery.slimscroll.min.js')}}"></script>
  <script src="{{asset('js/main.js?v.2')}}"></script>
  @yield('script')
  @if(session()->has('success'))
  <script>
    Swal.fire({
      title: "Success",
      icon: "success",
      text: "{{session()->get('success')}}",
      timer: 2000,
      showCancelButton: false,
      showConfirmButton: false
    })
  </script>
  {{session()->forget('success')}}
  @endif

  @if(session()->has('error'))
  <script>
    Swal.fire({
      title: "Ada yang salah",
      icon: "error",
      text: "{{session()->get('error')}}"
    })
  </script>
  {{session()->forget('error')}}
  @endif

  @if($errors->any())
  <script>
    Swal.fire({
      title: "Ada yang salah",
      icon: "error",
      text: "{{$errors->first()}}"
    })
  </script>
  @endif
</body>

</html>