<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{asset('/home')}}" class="brand-link">
        <img src="{{asset('adminlte/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">TrangShop</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset('adminlte/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Trang Chu</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <li class="nav-item">
                    <a href="{{route('categories.index')}}" class="nav-link {{strpos(Route::current()->getName(), 'categories.') !== false ? 'active' : ''}}">
                        <i class="nav-icon fas fa-th"></i>
                        <p>Category
                            <span class="right badge badge-danger">New</span>
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('menus.index')}}" class="nav-link {{strpos(Route::current()->getName(), 'menus.') !== false ? 'active' : ''}}">
                        <i class="nav-icon fas fa-th"></i>
                        <p>Menu</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('product.index')}}" class="nav-link {{strpos(Route::current()->getName(), 'product.') !== false ? 'active' : ''}}">
                        <i class="nav-icon fas fa-th"></i>
                        <p>Products</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('slider.index')}}" class="nav-link {{strpos(Route::current()->getName(), 'slider.') !== false ? 'active' : ''}}">
                        <i class="nav-icon fas fa-th"></i>
                        <p>Slider</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('config.index')}}" class="nav-link {{strpos(Route::current()->getName(), 'config.') !== false ? 'active' : ''}}">
                        <i class="nav-icon fas fa-th"></i>
                        <p>Config</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('user.index')}}" class="nav-link {{strpos(Route::current()->getName(), 'user.') !== false ? 'active' : ''}}">
                        <i class="nav-icon fas fa-th"></i>
                        <p>Users</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('role.index')}}" class="nav-link {{strpos(Route::current()->getName(), 'role.') !== false ? 'active' : ''}}">
                        <i class="nav-icon fas fa-th"></i>
                        <p>Roles</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('permission.create')}}" class="nav-link {{strpos(Route::current()->getName(), 'permission.') !== false ? 'active' : ''}}">
                        <i class="nav-icon fas fa-th"></i>
                        <p>Manage Permissions</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
