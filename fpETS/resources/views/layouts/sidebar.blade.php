<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">WareHouse.co</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('products.index') }}">
            <i class="fas fa-fw fa-box"></i>
            <span>Product</span>
        </a>
    </li>

    <li class="nav-item">
    @can('manage-categories')
        <a class="nav-link" href="{{ route('categories.index') }}">
            <i class="fas fa-fw fa-tags"></i> <!-- Update the icon here -->
            <span>Categories</span>
        </a>
    @endcan
    </li>

    <li class="nav-item">
        @can('view-user-orders')
            <a class="nav-link" href="{{ route('orders.cart') }}">
                <i class="fas fa-fw fa-shopping-cart"></i>
                <span>View Cart</span> <!-- This leads to the cart page -->
            </a>
        @endcan
    </li>

    <li class="nav-item">
        @can('view-user-orders')
            <a class="nav-link" href="{{ route('orders.user') }}">
                <i class="fas fa-fw fa-user"></i>
                <span>Your Orders</span>
            </a>
        @endcan
    </li>

    <li class="nav-item">
        @can('view-orders')
            <a class="nav-link" href="{{ route('orders.all') }}">
                <i class="fas fa-fw fa-list"></i>
                <span>All Orders</span>
            </a>
        @endcan
    </li>

    <li class="nav-item">
        @can('manage-shipments')
            <a class="nav-link" href="{{ route('shipments.index') }}">
                <i class="fas fa-fw fa-shipping-fast"></i>
                <span>Shipment</span>
            </a>
        @endcan
    </li>

    <li class="nav-item">
        @can('manage-suppliers')
            <a class="nav-link" href="{{ route('suppliers') }}">
                <i class="fas fa-fw fa-truck"></i>
                <span>Supplier</span>
            </a>
        @endcan
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

    <!-- Divider -->
    <hr class="sidebar-divider mt-2">

    <!-- Review Nav Item - Centered at Bottom -->
    <li class="nav-item mt-auto">
        <a class="nav-link text-center" href="{{ route('reviews.index') }}">
            <i class="fas fa-fw fa-star"></i>
            <span>Review Us!</span>
        </a>
    </li>
</ul>