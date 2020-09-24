<aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="http://10.151.46.88/travinhqt_laravel/master" class="brand-link">
        <!-- <i class="fas fa-globe-americas fa-1x"></i>
        <span class="brand-text font-weight-light">Quan trắc Trà Vinh</span> -->
        <div class="title">
            <img id="logo" src="{{ asset('public/webapp/assets/images/SoTNMT.png') }}" style="margin-left: 10px; width: 50px;"/>
            <span id="titlefont1"
                  style="font-size: 15px; font-weight: bold; color: red">
                QUẢN TRỊ QUAN TRẮC</span>
            <br>
            <!-- <span id="titlefont1"
                  style="font-size: 17px; font-weight: bold; color: red">
                QUAN TRẮC</span> -->
        </div>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                @foreach($menus as $menu)
                    <li class="nav-item has-treeview {{ (request()->is($menu-> code .'*')) ? 'menu-open' : '' }}">
                        <a class="bg-gradient nav-link {{ (request()->is($menu-> code .'*')) ? 'active' : '' }}"
                           href="#">
                            <i class="nav-icon fas fa-list-alt"></i>
                            <p>
                                {{ $menu->name }}
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @if(count($items = $menu->childs))
                                @foreach($items as $item)
                                    <li class="nav-item">
                                        <?php  $test = $item->Link; ?>
                                        <a href="{{ url('/').'/'.$menu-> code.'/'.$item->Link }}"
                                           class="nav-link {{ (request()->is('*'. $item->Link .'*')) ? 'active' : '' }}">
                                            <i class="far fa-circle nav-icon fa-1x"></i>
                                            <p>{{ $item->name }}</p>
                                        </a>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </li>
                @endforeach
            </ul>
        </nav>
    </div>
    <!-- /.sidebar -->
</aside>
