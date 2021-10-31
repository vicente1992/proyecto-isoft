<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    @section('admin-section')
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link collapsed fs-6" href="{{ route('home') }}">
                <i class="bi bi-grid"></i>
                <span>Dahsboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed fs-6" href="{{ route('product.index') }}">
                <i class='bx bx-store-alt'></i>
                <span>Productos</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed fs-6" href="{{ route('user.index') }}">
                <i class=" bi bi-people"></i>
                <span>Usuarios</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed fs-6" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-cart"></i><span>Ventas</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="icons-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a class="fs-6" href="{{ route('sales.index') }}">
                        <i class="bi bi-cart"></i><span>Ver Ventas</span>
                    </a>
                </li>
                <li>
                    <a class="fs-6" href="{{ route('sales.create') }}">
                        <i class=" bi bi-cart"></i></i><span>Realizar Venta</span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed fs-6" href="{{ route('bills.index') }}">
                <i class="bi bi-grid"></i>
                <span>Egresos</span>

            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed fs-6" href="{{ route('reports.index') }}">
                <i class='bx bx-bar-chart-alt-2'></i>
                <span>Reportes</span>

            </a>
        </li>
    </ul>
    @endsection
    @section('seller-section')
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link collapsed fs-6" href="{{ route('home') }}">
                <i class="bi bi-grid"></i>
                <span>Dahsboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed fs-6" href="{{ route('product.index') }}">
                <i class='bx bx-store-alt'></i>
                <span>Productos</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed fs-6" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-cart"></i><span>Ventas</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="icons-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a class="fs-6" href="{{ route('sales.index') }}">
                        <i class="bi bi-cart"></i><span>Ver Ventas</span>
                    </a>
                </li>
                <li>
                    <a class="fs-6" href="{{ route('sales.create') }}">
                        <i class=" bi bi-cart"></i></i><span>Realizar Venta</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed fs-6" href="{{ route('reports.index') }}">
                <i class='bx bx-bar-chart-alt-2'></i>
                <span>Reportes</span>

            </a>
        </li>
    </ul>
    @endsection
    @if (in_array(Auth::user()->role,['admin']))
    @yield('admin-section')
    @else
    @yield('seller-section')
    @endif
</aside>