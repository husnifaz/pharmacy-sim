<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar Menu -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">MENU</li>
      <!-- Optionally, you can add icons to the links -->
      @foreach (App\Models\Menu::getListMenu(auth()->user()) as $menu)
      <li class="{{count($menu->child) > 0 ? 'treeview' : url($menu->url)}}  {{ (request()->is($menu->url.'*')) ? 'active' : '' }} parent-menu">
        <a href="{{count($menu->child) > 0 ? '#' : url($menu->url) }}"><i class="{{'fa '.$menu->icons}}"></i> <span>{{$menu->name}}</span>
        @if (count($menu->child) > 0)
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        @endif
        </a>
        <ul class="treeview-menu">
          @foreach($menu['child'] as $child)
          <li class="{{ (request()->is($child->url.'*')) ? 'active' : '' }} child-menu"><a href="{{url($child->url)}}">{{$child->name}}</a></li>
          @endforeach
        </ul>
      </li>
      @endforeach
    </ul>
    <!-- /.sidebar-menu -->
  </section>
  <!-- /.sidebar -->
</aside>