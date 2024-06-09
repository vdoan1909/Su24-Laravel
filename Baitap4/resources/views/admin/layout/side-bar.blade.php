<div id="scrollbar">
    <div class="container-fluid">

        <div id="two-column-menu">
        </div>
        <ul class="navbar-nav" id="navbar-nav">
            <li class="menu-title"><span>Menu</span></li>
            <li class="nav-item">
                <a class="nav-link menu-link {{ Request::RouteIs('admin.dashboard') ? 'active' : '' }}"
                    href="{{ route('admin.dashboard') }}">
                    <i class="ri-dashboard-2-line"></i> <span>Dashboards</span>
                </a>
            </li> <!-- end Dashboard Menu -->
            <li class="nav-item">
                <a class="nav-link menu-link {{ Request::RouteIs(['admin.catalogues.index', 'admin.catalogues.create']) ? 'active' : '' }}"
                    href="#catalogue" data-bs-toggle="collapse" role="button" aria-expanded="false"
                    aria-controls="catalogue">
                    <i class="ri-list-check"></i> <span>Catalogues</span>
                </a>
                <div class="collapse menu-dropdown" id="catalogue">
                    <ul class="nav nav-sm flex-column">
                        <li class="nav-item">
                            <a href="{{ route('admin.catalogues.index') }}"
                                class="nav-link {{ Request::RouteIs('admin.catalogues.index') ? 'active' : '' }}">
                                List Catalogues
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.catalogues.create') }}"
                                class="nav-link {{ Request::RouteIs('admin.catalogues.create') ? 'active' : '' }}">
                                Create Catalogue
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link menu-link {{ Request::RouteIs(['admin.products.index', 'admin.products.create']) ? 'active' : '' }}"
                    href="#product" data-bs-toggle="collapse" role="button" aria-expanded="false"
                    aria-controls="product">
                    <i class="ri-product-hunt-line"></i> <span>Products</span>
                </a>
                <div class="collapse menu-dropdown" id="product">
                    <ul class="nav nav-sm flex-column">
                        <li class="nav-item">
                            <a href="{{ route('admin.products.index') }}"
                                class="nav-link {{ Request::RouteIs('admin.products.index') ? 'active' : '' }}">
                                List Products
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.products.create') }}"
                                class="nav-link {{ Request::RouteIs('admin.products.create') ? 'active' : '' }}">
                                Create Product
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
    <!-- Sidebar -->
</div>
