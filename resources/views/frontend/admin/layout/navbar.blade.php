<nav class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto">
        <li style="list-style: none;">
            <a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i>
            </a>
        </li>
    </form>
    <ul class="navbar-nav navbar-right">
        <li class="dropdown"><a href="#" data-toggle="dropdown"
                class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                <img alt="image" style="width: 40px;height: 40px;
        object-fit: cover;"
                    src="{{ asset('frontend/image/icon.png') }}" class="rounded-circle mr-1">
                <div class="d-sm-none d-lg-inline-block">Hi {{ Auth::user()->email }} </div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                {{-- <a href="" class="dropdown-item has-icon">
                    <i class="far fa-user"></i> Profile
                </a>

                <a href="" class="dropdown-item has-icon">
                    <i class="fas fa-cog"></i> Settings
                </a> --}}
                <div class="dropdown-divider"></div>
                <form method="POST" action="{{ route('auth.logout') }}">
                    @csrf
                    <a onclick="event.preventDefault();
                         this.closest('form').submit();"
                        class="dropdown-item has-icon text-danger">
                        <i class="fas fa-sign-out-alt"></i> Đăng xuất
                    </a>
                </form>
            </div>
        </li>
    </ul>
</nav>
