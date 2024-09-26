<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="index.html">
            <span class="sidebar-brand-text align-middle">
                Support Ticket
                <sup><small class="badge bg-primary text-uppercase">Pro</small></sup>
            </span>
            <svg class="sidebar-brand-icon align-middle" width="32px" height="32px" viewbox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="1.5" stroke-linecap="square" stroke-linejoin="miter" color="#FFFFFF" style="margin-left: -3px">
                <path d="M12 4L20 8.00004L12 12L4 8.00004L12 4Z"></path>
                <path d="M20 12L12 16L4 12"></path>
                <path d="M20 16L12 20L4 16"></path>
            </svg>
        </a>

        <div class="sidebar-user">
            <div class="d-flex justify-content-center">
                <div class="flex-shrink-0">
                    <img src="{{ asset('asset/backend/img/avatars/avatar.jpg')}}" class="avatar img-fluid rounded me-1" alt="Jassa">
                </div>
                <div class="flex-grow-1 ps-2">
                    <a class="sidebar-user-title dropdown-toggle" href="#" data-bs-toggle="dropdown">
                        Al Mahfuz
                    </a>
                    <div class="dropdown-menu dropdown-menu-start">
                        <a class="dropdown-item" href="pages-profile.html"><i class="align-middle me-1" data-feather="user"></i> Profile</a>                        
                        <div class="dropdown-divider"></div>
                        {{-- <a class="dropdown-item" href="{{ route('logout') }}">Log out</a> --}}
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                
                            <button type="submit" class="dropdown-item">
                                Log out
                            </button>
                        </form>
                    </div>

                    <div class="sidebar-user-subtitle">Admin</div>
                </div>
            </div>
        </div>

        <ul class="sidebar-nav">

            <li class="sidebar-item active">
                <a data-bs-target="#dashboards" data-bs-toggle="collapse" class="sidebar-link">
                    <i class="align-middle" data-feather="user"></i> <span class="align-middle">Tickets</span>
                </a>
                <ul id="dashboards" class="sidebar-dropdown list-unstyled collapse show" data-bs-parent="#sidebar">
                    <li class="sidebar-item active"><a class="sidebar-link" href="index.html">Analytics</a></li>
                </ul>
            </li>
        </ul>

        
    </div>
</nav>