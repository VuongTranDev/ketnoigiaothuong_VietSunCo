<header id="header" class="fixed-top navbar-custom">
    <nav class="navbar navbar-expand-lg navbar-top">
        <div class="container-xl">
            <div class="collapse navbar-collapse pt-1 pb-1">
                <div class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll">
                    <a href="/" class="me-4"><i class="fa-solid fa-phone me-2"
                            style="color: #fff;"></i>0914.416.363</a>
                    <a href="/"><i class="fa-solid fa-envelope me-2" style="color: #fff;"></i>hi@vietsunco.com</a>
                </div>
                <div>
                    <a class="ms-2" href="#" id="openForm">Đăng ký thành viên
                        <img src="{{ asset('frontend/image/subscribe.png') }}" alt="Đăng ký thành viên" width="15">
                    </a>
                    <a href="">
                        <img class="ms-2" src="{{ asset('frontend/image/language-en.png') }}" alt="Tiếng Anh"
                            width="20" height="12">
                    </a>
                    <a href="">
                        <img class="ms-2" src="{{ asset('frontend/image/language-vn.png') }}" alt="Tiếng Việt"
                            width="20" height="12">
                    </a>
                </div>
            </div>
        </div>
    </nav>
    <!-- Form đăng ký -->
    <div class="full-screen-container" id="registerForm" style="display: none;">
        <div class="form-container">
            <h2>Đăng ký thành viên</h2>
            <div class="form-group">
                <label>Họ và tên*</label>
                <input type="text" id="representative" placeholder="Nhập tại đây">
            </div>
            <div class="form-group half-width">
                <label>Số điện thoại*</label>
                <input type="text" id="phone_number" placeholder="Nhập tại đây">
            </div>
            <div class="form-group half-width">
                <label>Tên công ty*</label>
                <input type="text" id="company_name" placeholder="Nhập tại đây">
            </div>
            <div class="form-group">
                <label>Tên viết tắt của công ty*</label>
                <input type="text" id="short_name" placeholder="Nhập tại đây">
            </div>
            <div class="form-group">
                <label>Link của công ty*</label>
                <input type="text" id="link" placeholder="Nhập tại đây">
            </div>
            <div class="form-group">
                <label>Thông tin công ty</label>
                <textarea id="content" placeholder="Thông tin công ty"></textarea>
            </div>
            <button class="submit-btn" id="submitCompanyForm">Gửi thông tin</button>
        </div>
    </div>

    <nav class="navbar navbar-expand-lg navbar-bottom">
        <div class="container-xl">
            <!-- Button trigger offcanvas -->
            <div class="d-lg-none nav-brand-none">Ketnoigiaothuong.com</div>
            <button class="navbar-toggler ms-auto d-lg-none" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasMenu" aria-controls="offcanvasMenu" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Offcanvas menu -->
            <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasMenu"
                aria-labelledby="offcanvasMenuLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasMenuLabel">Ketnoigiaothuong.com</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="/">Trang chủ</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Về chúng tôi</a>
                        </li>
                        <li class="nav-item dropdown dropdown-field">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Lĩnh vực
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="/">A</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="/">B</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="/">C</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="/">D</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('news') }}">Tin tức</a>
                        </li>
                    </ul>
                    {{-- <form action="" class="search-group me-4">
                            <a href="" class="search-icon"><i class="fa-solid fa-magnifying-glass"></i></a>
                        </form> --}}
                    <div class="d-flex align-items-center">
                        <form class="d-flex align-items-center search me-3" role="search" action=""
                            method="GET" autocomplete="off">
                            <input class="me-2 search-txt" type="text" placeholder="Tìm kiếm..."
                                aria-label="Search" name="query" value="{{ request('query') }}">
                            <a class="search-btn" href="#">
                                <i class="fas fa-search"></i>
                            </a>
                        </form>
                        {{-- <a href="{{ route('auth.login') }}" style="color: #3EAEF4;"><i class="fa-solid fa-user" style="font-size: 20px;"></i>
                        </a> --}}
                        <div class="btn-group">
                            @if (session('user'))
                                <button type="button" style="background-color: #3EAEF4; color: white;"
                                    class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ session('user')->email }}
                                    <i class="fa-solid fa-user" style="font-size: 20px;"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('partner.dashboard') }}">Hồ sơ</a></li>
                                    <li><a class="dropdown-item" href="#">Đổi mật khẩu</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li>
                                        <form id="logout-form" action="{{ route('auth.logout') }}" method="POST"
                                            style="display: none;">
                                            @csrf <!-- Include CSRF token for security -->
                                        </form>
                                        <a class="dropdown-item" href=""
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            Đăng xuất
                                        </a>
                                    </li>

                                </ul>
                            @else
                                <a href="{{ route('auth.login') }}" class="btn"
                                    style="background-color: #3EAEF4; color: white;">
                                    Đăng nhập
                                    <i class="fa-solid fa-user" style="font-size: 20px;"></i>
                                </a>
                            @endif
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>

@push('script')
    <script>
        // JavaScript để hiển thị và ẩn form
        document.getElementById('openForm').addEventListener('click', function(event) {
            event.preventDefault(); // Ngăn không cho link chuyển trang
            document.getElementById('registerForm').style.display = 'flex';
        });

        // Đóng form khi nhấn vào khu vực bên ngoài form
        document.getElementById('registerForm').addEventListener('click', function(event) {
            if (event.target === this) {
                this.style.display = 'none';
            }
        });
    </script>

@endpush
