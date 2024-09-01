<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{ asset('AdminLTE-3.2.0')}}/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">PBKK B</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('AdminLTE-3.2.0')}}/dist/img/Oh.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Nicklaus Natanael S G</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Pertemuan 1
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('ganjil-genap') }}" class="nav-link {{ request()->routeIs('ganjil-genap') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Ganjil Genap</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('fibonacci') }}" class="nav-link {{ request()->routeIs('fibonacci') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Fibonacci</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('prima') }}" class="nav-link {{ request()->routeIs('prima') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Bilangan Prima</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('routing') }}" class="nav-link {{ request()->routeIs('routing') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Routing</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>