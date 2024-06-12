<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{asset('adminlte/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo"
             class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Marx No Suy</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset('adminlte/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2"
                     alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{auth()->user()->name}}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">

            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @can('category-list')
                    <li class="nav-item">
                        <a href="{{route('categories.index')}}" class="nav-link">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                Category
                            </p>
                        </a>
                    </li>
                @endcan
                    <li class="nav-item">
                        <a href="{{route('banner.index')}}" class="nav-link">
                            <i class="nav-icon fas fa-band-aid"></i>
                            <p>
                                Banner
                            </p>
                        </a>
                    </li>
                @can('menu-list')
                    <li class="nav-item">
                        <a href="{{route('menus.index')}}" class="nav-link">
                            <i class="nav-icon fas fa-magic"></i>
                            <p>
                                Menu
                            </p>
                        </a>
                    </li>
                @endcan

                @can('product-list')
                    <li class="nav-item">
                        <a href="{{route('product.index')}}" class="nav-link">
                            <i class="nav-icon fas fa-shoe-prints"></i>
                            <p>
                                Product
                            </p>
                        </a>
                    </li>
                @endcan
                    <li class="nav-item">
                        <a href="{{route('order.index')}}" class="nav-link">
                            <i class="nav-icon fas fa-check-circle"></i>
                            <p>
                                Order
                            </p>
                        </a>
                    </li>
                @can('slider-list')
                    <li class="nav-item">
                        <a href="{{route('sliders.index')}}" class="nav-link">
                            <i class="nav-icon fas fa-sliders-h"></i>
                            <p>
                                Slider
                            </p>
                        </a>
                    </li>
                @endcan

                @can('setting-list')
                    <li class="nav-item">
                        <a href="{{route('setting.index')}}" class="nav-link">
                            <i class="nav-icon fas fa-screwdriver"></i>
                            <p>
                                Setting
                            </p>
                        </a>
                    </li>
                @endcan

                @can('user-list')
                    <li class="nav-item">
                        <a href="{{route('users.index')}}" class="nav-link">
                            <i class="nav-icon fas fa-user-alt"></i>
                            <p>
                                List User
                            </p>
                        </a>
                    </li>
                @endcan


                @can('role-list')
                    <li class="nav-item">
                        <a href="{{route('roles.index')}}" class="nav-link">
                            <i class="nav-icon fas fa-ruler"></i>
                            <p>
                                Role
                            </p>
                        </a>
                    </li>
                @endcan
                @can('role-list')
                    <li class="nav-item">
                        <a href="{{route('permission.creatPermission')}}" class="nav-link">
                            <i class="nav-icon fas fa-ruler"></i>
                            <p>
                                Permission
                            </p>
                        </a>
                    </li>
                @endcan
                    <li class="nav-item float">
                        <a href="{{route('logoutAmin')}}" class="nav-link">
                            <i class="nav-icon fas fa-sign-out-alt"></i>
                            <p>
                                Log out
                            </p>
                        </a>
                    </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
