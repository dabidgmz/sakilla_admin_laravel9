<!-- Sidebar -->
<div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <!-- <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div> -->
        <div class="info">
          <a href="#" class="d-block">Welcome User!!</a>
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
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
            <i class="nav-icon fas fa-film"></i>
              <p>
                Cinema Studio System
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <!-- Customers -->
              <li class="nav-item">
                <a href="{{ route('Customers') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Customers</p>
                </a>
              </li>

              <!-- Films -->
              <li class="nav-item">
                <a href="{{route('Films')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Films</p>
                </a>
              </li>

              <!-- Actors -->
              <li class="nav-item">
                <a href="{{route('Actors')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Actors</p>
                </a>
              </li>

              <!-- Categories -->
              <li class="nav-item">
                <a href="{{route('Categories')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Categories</p>
                </a>
              </li>

              <!-- Inventory -->
              <li class="nav-item">
                <a href="{{route('Inventory')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Inventory</p>
                </a>
              </li>

              <!-- Rentals -->
              <li class="nav-item">
                <a href="{{route('Rentals')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Rentals</p>
                </a>
              </li>

              <!-- Payments -->
              <li class="nav-item">
                <a href="{{route('Payments')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Payments</p>
                </a>
              </li>

              <!-- Staff -->
              <li class="nav-item">
                <a href="{{route('Staff')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Staff</p>
                </a>
              </li>

              <!-- Stores -->
              <li class="nav-item">
                <a href="{{route('Stores')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Stores</p>
                </a>
              </li>
            </ul>
          </li>
          <!-- <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Simple Link
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li> -->
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>