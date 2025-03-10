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
        <div style="max-height: 400px; overflow-y: auto;">
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
                        <!-- Actors -->
                        <li class="nav-item">
                            <a href="{{ route('Actors') }}" class="nav-link">
                                <i class="nav-icon far fa-circle text-danger"></i>
                                <p>Actors</p>
                            </a>
                        </li>

                        <!-- Address -->
                        <li class="nav-item">
                            <a href="{{ route('Address') }}" class="nav-link">
                                <i class="nav-icon far fa-circle text-danger"></i>
                                <p>Address</p>
                            </a>
                        </li>

                        <!-- Categories -->
                        <li class="nav-item">
                            <a href="{{ route('Categories') }}" class="nav-link">
                                <i class="nav-icon far fa-circle text-danger"></i>
                                <p>Categories</p>
                            </a>
                        </li>

                        <!-- Citys -->
                        <li class="nav-item">
                            <a href="{{ route('Citys') }}" class="nav-link">
                                <i class="nav-icon far fa-circle text-danger"></i>
                                <p>Citys</p>
                            </a>
                        </li>

                        <!-- Customers -->
                        <li class="nav-item">
                            <a href="{{ route('Customers') }}" class="nav-link">
                                <i class="nav-icon far fa-circle text-danger"></i>
                                <p>Customers</p>
                            </a>
                        </li>

                        <!-- Films -->
                        <li class="nav-item">
                            <a href="{{ route('Films') }}" class="nav-link">
                                <i class="nav-icon far fa-circle text-danger"></i>
                                <p>Films</p>
                            </a>
                        </li>

                        <!-- Film Actors -->
                        <li class="nav-item">
                            <a href="{{ route('Flim_Actor') }}" class="nav-link">
                                <i class="nav-icon far fa-circle text-danger"></i>
                                <p>Flim Actors</p>
                            </a>
                        </li>

                        <!-- Film Categories -->
                        <li class="nav-item">
                            <a href="{{ route('Flim_Category') }}" class="nav-link">
                                <i class="nav-icon far fa-circle text-danger"></i>
                                <p>Flimm Categories</p>
                            </a>
                        </li>

                        <!-- Film Text -->
                        <li class="nav-item">
                            <a href="{{ route('Film_text') }}" class="nav-link">
                                <i class="nav-icon far fa-circle text-danger"></i>
                                <p>Film Text</p>
                            </a>
                        </li>

                        <!-- Inventory -->
                        <li class="nav-item">
                            <a href="{{ route('Inventories') }}" class="nav-link">
                                <i class="nav-icon far fa-circle text-danger"></i>
                                <p>Inventories</p>
                            </a>
                        </li>

                        <!-- Languages -->
                        <li class="nav-item">
                            <a href="{{ route('Languages') }}" class="nav-link">
                                <i class="nav-icon far fa-circle text-danger"></i>
                                <p>Languages</p>
                            </a>
                        </li>

                        <!-- Payments -->
                        <li class="nav-item">
                            <a href="{{ route('Payments') }}" class="nav-link">
                                <i class="nav-icon far fa-circle text-danger"></i>
                                <p>Payments</p>
                            </a>
                        </li>

                        <!-- Rentals -->
                        <li class="nav-item">
                            <a href="{{ route('Rentals') }}" class="nav-link">
                                <i class="nav-icon far fa-circle text-danger"></i>
                                <p>Rentals</p>
                            </a>
                        </li>

                        <!-- Staff -->
                        <li class="nav-item">
                            <a href="{{ route('Staff') }}" class="nav-link">
                                <i class="nav-icon far fa-circle text-danger"></i>
                                <p>Staff</p>
                            </a>
                        </li>

                        <!-- Stores -->
                        <li class="nav-item">
                            <a href="{{ route('Stores') }}" class="nav-link">
                                <i class="nav-icon far fa-circle text-danger"></i>
                                <p>Stores</p>
                            </a>
                        </li>

                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    <!-- /.sidebar-menu -->
</div>
