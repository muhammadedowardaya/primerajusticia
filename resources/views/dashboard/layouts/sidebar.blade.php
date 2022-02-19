<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link{{ request()->is('dashboard') ? ' active' : '' }}" aria-current="page"
                    href="/dashboard">
                    <span data-feather="home"></span>
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link{{ request()->is('dashboard/posts*') ? ' active' : '' }}" href="/dashboard/posts">
                    <span data-feather="file-text"></span>
                    My Posts
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link{{ request()->is('posts*') ? ' active' : '' }}" href="/posts">
                    <span data-feather="file-text"></span>
                    All Posts
                </a>
            </li>
        </ul>

        @can('admin', Post::class)
            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                <span>Administrator</span>
            </h6>

            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link{{ request()->is('dashboard/categories*') ? ' active' : '' }}"
                        href="/dashboard/categories">
                        <span data-feather="grid"></span>
                        Post Categories
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link{{ request()->is('dashboard/galleries*') ? ' active' : '' }}"
                        href="/dashboard/galleries">
                        <span data-feather="grid"></span>
                        Gallery
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link{{ request()->is('dashboard/pengacara*') ? ' active' : '' }}"
                        href="/dashboard/pengacara">
                        <span data-feather="grid"></span>
                        Pengacara
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link{{ request()->is('dashboard/bantuan') ? ' active' : '' }}"
                        href="/dashboard/bantuan">
                        <span data-feather="grid"></span>
                        Bantuan Hukum
                    </a>
                </li>
            </ul>

            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                <span>Primera Justicia Profile</span>
            </h6>

            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link{{ request()->is('dashboard/gambar') ? ' active' : '' }}" href="/dashboard/gambar">
                        <span data-feather="grid"></span>
                        Gambar Halaman Profile
                    </a>
                </li>
            </ul>

            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link{{ request()->is('dashboard/profile') ? ' active' : '' }}" href="/">
                        <span data-feather="grid"></span>
                        Profile Perusahaan
                    </a>
                </li>
            </ul>
        @endcan
    </div>
</nav>
