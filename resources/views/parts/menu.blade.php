<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">
  <!-- Sidebar Menu -->
  <ul class="sidebar-menu" data-widget="tree">
    <li class="header">HEADER</li>
    <!-- Optionally, you can add icons to the links -->
    @foreach (App\Models\Menu::getListMenu() as $menu)
        <li class="{{ (request()->is($menu->url.'*')) ? 'active' : '' }}">
            <a href="{{url($menu->url)}}"><i class="{{'fa '.$menu->icons}}"></i> <span>{{$menu->name}}</span></a>
        </li>
    @endforeach
  </ul>
  <!-- /.sidebar-menu -->
</section>
<!-- /.sidebar -->
</aside>