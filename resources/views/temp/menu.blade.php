<aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="http://localhost:2502/travinhqt_laravel/quanly/Observationstation" class="brand-link">
        <!-- <i class="fas fa-globe-americas fa-1x"></i>
        <span class="brand-text font-weight-light">Quan trắc Trà Vinh</span> -->
        <div class="title">
            <img id="logo" src="{{ asset('public/webapp/assets/images/SoTNMT.png') }}" style="width: 40px;"/>
            <span id="titlefont1"
                  style="font-size: 17px; font-weight: bold; color: red">
                QUẢN TRỊ QUAN TRẮC</span>
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
        <!-- Sidebar user (optional) -->
        <!-- Sidebar Menu -->
    {{-- <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="true">
            <li class="nav-item has-treeview menu-open">
                <a href="#" class="nav-link active">
                    <i class="nav-icon fas fa-edit"></i>
                    <p>
                        Danh mục
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('ObservationType') }}" class="nav-link active">
    <i class="far fa-circle nav-icon"></i>
    <p>Loại hình</p>
    </a>
    </li>
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Loại trạm</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Thông số</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Đơn vị</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Tổ chức</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Địa danh</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Chỉ số chất lượng MT</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="../forms/validation.html" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Mục đích sử dụng</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="../forms/validation.html" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>.....</p>
        </a>
    </li>
    </ul>
    </li>
    <li class="nav-item has-treeview">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-table"></i>
            <p>
                Quản lý
                <i class="fas fa-angle-left right"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="../tables/simple.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Trạm quan trắc</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="../tables/data.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Camera</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="../tables/jsgrid.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>.....</p>
                </a>
            </li>
        </ul>
    </li>
    <li class="nav-item has-treeview">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-table"></i>
            <p>
                Quản trị
                <i class="fas fa-angle-left right"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="../tables/simple.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Người dùng</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="../tables/simple.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Nhóm người dùng</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="../tables/data.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Quyền</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="../tables/data.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Phân quyền người dùng</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="../tables/jsgrid.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>.....</p>
                </a>
            </li>
        </ul>
    </li>
    </ul>
    </nav> --}}
    <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
