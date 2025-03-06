<!-- Sidebar -->
<div class="sidebar" style="background: (to bottom, #000000, #333333);">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
            <a href="#" class="d-block" style="color: #ffd700;">Welcome User!!</a>
        </div>
    </div>

    @csrf
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
            <li class="nav-item menu-open">
                <a href="#" class="nav-link active" style="background-color: #ffd700 !important; color: #000000 !important; border-radius: 5px;">
                    <i class="nav-icon fas fa-film" style="color: #000000 !important;"></i>
                    <p>
                        Cinema Studio System
                        <i class="right fas fa-angle-left" style="color: #000000 !important;"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <!-- Customers -->
                    <li class="nav-item">
                        <a href="{{ route('Customers') }}" class="nav-link">
                            <i class="nav-icon far fa-circle text-danger" ></i>
                            <p>Customers</p>
                        </a>
                    </li>

                    <!-- Films -->
                    <li class="nav-item">
                        <a href="{{route('Films')}}" class="nav-link">
                            <i class="nav-icon far fa-circle text-danger" ></i>
                            <p>Films</p>
                        </a>
                    </li>

                    <!-- Actors -->
                    <li class="nav-item">
                        <a href="{{route('Actors')}}" class="nav-link">
                            <i class="nav-icon far fa-circle text-danger" ></i>
                            <p>Actors</p>
                        </a>
                    </li>

                    <!-- Categories -->
                    <li class="nav-item">
                        <a href="{{route('Categories')}}" class="nav-link">
                            <i class="nav-icon far fa-circle text-danger" ></i>
                            <p>Categories</p>
                        </a>
                    </li>

                    <!-- Inventory -->
                    <li class="nav-item">
                        <a href="{{route('Inventory')}}" class="nav-link">
                            <i class="nav-icon far fa-circle text-danger" ></i>
                            <p>Inventory</p>
                        </a>
                    </li>

                    <!-- Rentals -->
                    <li class="nav-item">
                        <a href="{{route('Rentals')}}" class="nav-link">
                            <i class="nav-icon far fa-circle text-danger" ></i>
                            <p>Rentals</p>
                        </a>
                    </li>

                    <!-- Payments -->
                    <li class="nav-item">
                        <a href="{{route('Payments')}}" class="nav-link">
                            <i class="nav-icon far fa-circle text-danger" ></i>
                            <p>Payments</p>
                        </a>
                    </li>

                    <!-- Staff -->
                    <li class="nav-item">
                        <a href="{{route('Staff')}}" class="nav-link">
                            <i class="nav-icon far fa-circle text-danger" ></i>
                            <p>Staff</p>
                        </a>
                    </li>

                    <!-- Stores -->
                    <li class="nav-item">
                        <a href="{{route('Stores')}}" class="nav-link">
                            <i class="nav-icon far fa-circle text-danger" ></i>
                            <p>Stores</p>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
