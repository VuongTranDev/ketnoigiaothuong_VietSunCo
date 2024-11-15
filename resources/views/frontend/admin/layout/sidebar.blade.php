<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('admin.dashboard') }}" style="color: #6777ef;">Ketnoigiaothuong.com</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('admin.dashboard') }}">||</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="dropdown {{ setActive(['admin.dashboard']) }}">
                <a href="{{ route('admin.dashboard') }}" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>
            <li class="menu-header">Mamager</li>



            <li
                class="dropdown {{ setActive(['admin.news.*', 'admin.blog-comments.index']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                        class="fab fa-blogger-b"></i> <span>Quản lý tin tức</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['admin.news.*']) }}"><a class="nav-link" href="{{ route('admin.news.index') }}">Tin tức</a></li>
                    <li class="{{ setActive(['admin.blog-comments.index']) }}"><a class="nav-link"
                            href="">Blog Comments</a></li>
                </ul>
            </li>




            <li class="menu-header">Settings & More</li>


            <li
                class="dropdown {{ setActive([
                    'admin.footer-info.index',
                    'admin.footer-socials.*',
                    'admin.footer-grid-two.*',
                    'admin.footer-grid-three.*',
                ]) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                        class="fas fa-th-large"></i><span>Footer</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['admin.footer-info.index']) }}"><a class="nav-link"
                            href="">Footer Info</a></li>

                    <li class="{{ setActive(['admin.footer-socials.*']) }}"><a class="nav-link"
                            href="">Footer Socials</a></li>

                    <li class="{{ setActive(['admin.footer-grid-two.*']) }}"><a class="nav-link"
                            href="">Footer Grid Two</a></li>

                    <li class="{{ setActive(['admin.footer-grid-three.*']) }}"><a class="nav-link"
                            href="">Footer Grid Three</a></li>

                </ul>
            </li>



            {{-- <li><a class="nav-link {{ setActive(['admin.subscribers.*']) }}" href=""><i
                        class="fas fa-user"></i>
                    <span>Subscribers</span></a></li> --}}

            <li><a class="nav-link" href=""><i class="fas fa-wrench"></i>
                    <span>Settings</span></a></li>

        </ul>

    </aside>
</div>
