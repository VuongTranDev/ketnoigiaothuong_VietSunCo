<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('admin.dashboard') }}" style="color: #3EAEF4;">Ketnoigiaothuong.com</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('admin.dashboard') }}">||</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="dropdown {{ setActive(['admin.dashboard']) }}">
                <a href="{{ route('admin.dashboard') }}" class="nav-link"><i
                        class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>
            <li class="menu-header">Manager</li>
            {{-- <li
                class="dropdown {{ setActive([
                    'admin.companies.index',
                    'admin.categories.index',
                ]) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-box"></i>
                    <span>Quản lý công ty</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['admin.companies.index']) }}"><a class="nav-link"
                            href="{{ route('admin.companies.index') }}">Tất cả công ty</a></li>

                    <li class="{{ setActive(['admin.categories.index']) }}"><a class="nav-link"
                            href="{{ route('admin.categories.index') }}">Lĩnh vực</a></li>

                </ul>
            </li> --}}

            <li>
                <a class="nav-link {{ setActive(['admin.companies.index']) }}" href="{{ route('admin.companies.index') }}">
                    <i class="fas fa-hotel"></i>
                    <span>Quản lý công ty</span>
                </a>
            </li>

            <li>
                <a class="nav-link {{ setActive(['admin.categories.index']) }}" href="{{ route('admin.categories.index') }}">
                    <i class="fas fa-box"></i>
                    <span>Lĩnh vực</span>
                </a>
            </li>



            {{-- <li class="dropdown {{ setActive(['admin.news.*', 'admin.blog-comments.index']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fab fa-blogger-b"></i>
                    <span>Quản lý tin tức</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['admin.news.*']) }}"><a class="nav-link"
                            href="{{ route('admin.news.index') }}">Tin tức</a></li>
                    <li class="{{ setActive(['admin.blog-comments.index']) }}"><a class="nav-link" href="">Blog
                            Comments</a></li>
                </ul>
            </li> --}}

            <li>
                <a class="nav-link {{ setActive(['admin.news.index']) }}" href="{{ route('admin.news.index') }}">
                    <i class="fab fa-blogger-b"></i>
                    <span>Tin tức</span>
                </a>
            </li>

            {{-- <li>
                <a class="nav-link {{ setActive(['user.messages.index']) }}"
                    href="{{ route('user.message.index') }}"><i class="fas fa-user"></i>
                    <span>Messages</span>
                </a>
            </li> --}}

            <li class="{{ setActive(['admin.send-contact.*']) }}">
                <a class="nav-link {{ setActive(['admin.send-contact.*']) }}"
                    href="{{ route('admin.send-contact.index') }}">
                    <i class="fas fa-comments"></i>
                    <span>Liên hệ</span>
                </a>
            </li>

            <li class="menu-header">Settings & More</li>


            <li
                class="dropdown {{ setActive([
                    'admin.footer-grid-info.index',
                    'admin.footer-socials.*',
                    'admin.footer-grid-two.*',
                    'admin.footer-grid-three.*',
                ]) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                        class="fas fa-th-large"></i><span>Footer</span></a>
                <ul class="dropdown-menu">

                    <li class="{{ setActive(['admin.footer-grid-info.index']) }}"><a class="nav-link"
                            href="{{ route('admin.footer-grid-info.index') }}">Footer Info</a></li>

                    <li class="{{ setActive(['admin.footer-socials.*']) }}"><a class="nav-link"
                            href="{{ route('admin.footer-socials.index') }}">Footer Socials</a></li>

                    <li class="{{ setActive(['admin.footer-grid-two.*']) }}"><a class="nav-link"
                            href="{{ route('admin.footer-grid-two.index') }}">Footer Grid Two</a></li>

                    <li class="{{ setActive(['admin.footer-grid-three.*']) }}"><a class="nav-link"
                            href="{{ route('admin.footer-grid-three.index') }}">Footer Grid Three</a></li>

                </ul>
            </li>



            {{-- <li><a class="nav-link {{ setActive(['admin.subscribers.*']) }}" href=""><i
                        class="fas fa-user"></i>
                    <span>Subscribers</span></a></li> --}}
            <li><a class="nav-link" href="{{ route('admin.backup.index') }}"><i class="fas fa-wrench"></i>
                    <span>Backup</span></a></li>
            {{-- <li><a class="nav-link" href=""><i class="fas fa-wrench"></i>
                    <span>Settings</span></a></li> --}}

        </ul>

    </aside>
</div>
