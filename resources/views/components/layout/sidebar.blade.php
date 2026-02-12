<nav class="pc-sidebar">
    <div class="navbar-wrapper" style="margin-top: -0.85em">
        <div class="m-header">
            <a href="{{ route('home') }}" class="b-brand text-primary">
                <!-- ========   Change your logo from here   ============ -->
                {{-- <img src="{{ asset('src/assets/images/writely-logo.png') }}" alt="" class="logo logo-lg" /> --}}
                <h1 class="m-auto">Writely.</h1>
            </a>
        </div>
        <div class="navbar-content">
            <ul class="pc-navbar">
                {{-- <li class="pc-item pc-caption">
                    <label>Dashboard</label>
                    <i class="ti ti-dashboard"></i>
                </li> --}}
                <li class="pc-item {{ request()->routeIs('home') ? 'active' : '' }}">
                    <a href="{{ route('home') }}" class="pc-link">
                        <span class="pc-micon">
                            <i class='ti ti-home'></i>
                        </span>
                        <span class="pc-mtext">Home</span>
                    </a>
                </li>

                <li class="pc-item {{ request()->routeIs('explore') ? 'active' : '' }}">
                    <a href="{{ route('explore') }}" class="pc-link">
                        <span class="pc-micon">
                            <i class='ti ti-compass'></i>
                        </span>
                        <span class="pc-mtext">Explore</span>
                    </a>
                </li>

                {{-- <li class="pc-item {{ request()->routeIs('category') ? 'active' : '' }}">
                    <a href="{{ route('category') }}" class="pc-link">
                        <span class="pc-micon">
                            <i class='ti ti-tag'></i>
                        </span>
                        <span class="pc-mtext">Category</span>
                    </a>
                </li> --}}

                @if (Auth::check())
                    <li class="pc-item {{ request()->routeIs('messages') ? 'active' : '' }}">
                        <a href="{{ route('messages') }}" class="pc-link">
                            <span class="pc-micon">
                                <i class='ti ti-messages'></i>
                            </span>
                            <span class="pc-mtext">Message</span>
                        </a>
                    </li>
                @endif

                {{-- <li class="pc-item pc-caption">
                    <label>Elements</label>
                    <i class="ti ti-apps"></i>
                </li>
                <li class="pc-item">
                    <a href="#" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-typography"></i></span>
                        <span class="pc-mtext">Typography</span>
                    </a>
                </li>
                <li class="pc-item">
                    <a href="#" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-color-swatch"></i></span>
                        <span class="pc-mtext">Color</span>
                    </a>
                </li>
                <li class="pc-item">
                    <a href="#" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-plant-2"></i></span>
                        <span class="pc-mtext">Icons</span>
                    </a>
                </li>

                <li class="pc-item pc-caption">
                    <label>Pages</label>
                    <i class="ti ti-news"></i>
                </li>
                <li class="pc-item">
                    <a class="pc-link" target="_blank" href="../pages/login-v3.html">
                        <span class="pc-micon"><i class="ti ti-lock"></i></span>
                        <span class="pc-mtext">Login</span>
                    </a>
                </li>
                <li class="pc-item">
                    <a href="#" target="_blank" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-user-plus"></i></span>
                        <span class="pc-mtext">Register</span>
                    </a>
                </li>

                <li class="pc-item pc-caption">
                    <label>Other</label>
                    <i class="ti ti-brand-chrome"></i>
                </li>
                <li class="pc-item pc-hasmenu">
                    <a href="#!" class="pc-link"><span class="pc-micon"><i class="ti ti-menu"></i></span>
                        <span class="pc-mtext">Menu levels</span><span class="pc-arrow"><i
                                data-feather="chevron-right"></i></span>
                    </a>
                    <ul class="pc-submenu">
                        <li class="pc-item"><a class="pc-link" href="#!">Level 2.1</a></li>
                        <li class="pc-item pc-hasmenu">
                            <a href="#!" class="pc-link">Level 2.2<span class="pc-arrow"><i
                                        data-feather="chevron-right"></i></span></a>
                            <ul class="pc-submenu">
                                <li class="pc-item"><a class="pc-link" href="#!">Level 3.1</a></li>
                                <li class="pc-item"><a class="pc-link" href="#!">Level 3.2</a></li>
                                <li class="pc-item pc-hasmenu">
                                    <a href="#!" class="pc-link">Level 3.3<span class="pc-arrow"><i
                                                data-feather="chevron-right"></i></span></a>
                                    <ul class="pc-submenu">
                                        <li class="pc-item"><a class="pc-link" href="#!">Level 4.1</a></li>
                                        <li class="pc-item"><a class="pc-link" href="#!">Level 4.2</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="pc-item pc-hasmenu">
                            <a href="#!" class="pc-link">Level 2.3<span class="pc-arrow"><i
                                        data-feather="chevron-right"></i></span></a>
                            <ul class="pc-submenu">
                                <li class="pc-item"><a class="pc-link" href="#!">Level 3.1</a></li>
                                <li class="pc-item"><a class="pc-link" href="#!">Level 3.2</a></li>
                                <li class="pc-item pc-hasmenu">
                                    <a href="#!" class="pc-link">Level 3.3<span class="pc-arrow"><i
                                                data-feather="chevron-right"></i></span></a>
                                    <ul class="pc-submenu">
                                        <li class="pc-item"><a class="pc-link" href="#!">Level 4.1</a></li>
                                        <li class="pc-item"><a class="pc-link" href="#!">Level 4.2</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="pc-item">
                    <a href="#" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-brand-chrome"></i></span>
                        <span class="pc-mtext">Sample page</span>
                    </a>
                </li> --}}
            </ul>
            @if (Auth::check())
                <div class="p-3">
                    <a href="{{ route('post.create') }}" class="btn btn-primary w-100 py-2 fw-semibold shadow-sm">
                        <i class="ti ti-pencil"></i>
                        <span>Create Post</span>
                    </a>
                </div>
            @endif
            <div class="w-100 text-center">
                <div class="badge theme-version badge rounded-pill bg-light text-dark f-12"></div>
            </div>
        </div>
    </div>
</nav>
