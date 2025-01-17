<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('partner.dashboard') }}" style="color:#3EAEF4;">Ketnoigiaothuong.com</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('partner.dashboard') }}">||</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="dropdown {{ setActive(['partner.dashboard']) }}">
                <a href="{{ route('partner.dashboard') }}" class="nav-link"><i
                        class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>
            <li class="menu-header">Manager</li>


            <li class="dropdown {{ setActive(['partner.company.*', 'partner.address.*']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                        class="fas fa-building"></i></i>
                    <span>Quản lý công ty</span></a>
                <ul class="dropdown-menu">

                    <li class="{{ setActive(['partner.company.index']) }}"><a class="nav-link" href="{{ route('partner.company.index') }}">Thông tin công ty</a></li>
                    {{-- <li class=""><a class="nav-link" href="">Lĩnh vực</a></li> --}}
                    <li class="{{ setActive(['partner.address.*']) }}"><a class="nav-link" href="{{ route('partner.address.index') }}">Địa chỉ</a></li>
                </ul>
            </li>
            <li class="dropdown {{ setActive(['partner.news.*', 'partner.news.*']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fab fa-blogger-b"></i>
                    <span>Quản lý tin tức</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['partner.news.index']) }}"><a class="nav-link"
                            href="{{ route('partner.news.index') }}">Tin tức</a></li>
                    <li class="{{ setActive(['partner.news.hotnews']) }}"><a class="nav-link"
                            href="{{ route('partner.news.hotnews') }}">Tin tức hot </a></li>
                </ul>
            </li>
            <li><a class="nav-link {{ setActive(['user.messages.index']) }}" href="{{ route('user.message.index') }}"><i
                class="fas fa-user"></i>
            <span>Messages</span></a></li>
            {{-- <li class=" {{ setActive([]) }}">
                <a href="{{ route('partner.company.index') }}" class="nav-link " ><i
                        class="fas fa-building"></i></i>
                    <span>Thông tin công ty</span></a>
            </li>



            {{-- <li class="menu-header">Settings & More</li> --}}

            {{-- <li><a class="nav-link {{ setActive(['admin.subscribers.*']) }}" href=""><i
                        class="fas fa-user"></i>
                    <span>Subscribers</span></a></li> --}}

            {{-- <li><a class="nav-link" href=""><i class="fas fa-wrench"></i>
                    <span>Settings</span></a></li> --}}

        </ul>

    </aside>
</div>
