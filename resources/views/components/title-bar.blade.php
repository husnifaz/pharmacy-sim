@section('title', $title)
<h1>{{$title}}</h1>
<ol class="breadcrumb">
  <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
  <?php $segments = ''; ?>
  @foreach(Request::segments() as $segment)
  <?php $segments .= '/' . $segment; ?>
  <li><a href="{{$segments}}">{{ucfirst($segment)}}</a></li>
  @endforeach
</ol>