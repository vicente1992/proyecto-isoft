<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

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
            <a class="nav-link collapsed fs-6" href="#">
                <i class="bi bi-cart"></i>
                <span>Ventas</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed fs-6" href="{{ route('bills.index') }}">
                <i class="bi bi-grid"></i>
                <span>Egresos</span>

            </a>
        </li>



    </ul>

</aside><!-- End Sidebar-->