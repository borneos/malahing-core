<div class="scrollbar-sidebar" style="overflow: scroll;">
    <div class="app-sidebar__inner">
        <ul class="vertical-nav-menu">
            <li class="app-sidebar__heading">Menu</li>
            <li>
                <a href="/dashboard" class="dashboard {{ request()->is('dashboard') ? 'mm-active' : '' }}"><i class="metismenu-icon pe-7s-rocket"></i>Dashboards</a>
            </li>
            <li class="app-sidebar__heading">Master Data</li>
            <li>
                <a class="users {{ request()->is('users') ? 'mm-active' : '' }}" href="{{ route('admin.users.index') }}"><i class="metismenu-icon pe-7s-users"></i>Admin Users</a>

            </li>
            <li class="{{ (count(request()->segments()) > 1 && request()->segments()[1] === 'master-category') || (count(request()->segments()) > 1 && request()->segments()[1] === 'master-sub-category') || (count(request()->segments()) > 1 && request()->segments()[1] === 'master-sub-sub-category') ? 'mm-active' : '' }}">
                <a href="#"><i class="metismenu-icon pe-7s-server"></i>Master Category<i class="metismenu-state-icon pe-7s-angle-down caret-left"></i></a>
                <ul>
                    <li>
                        <a class="master-category {{ count(request()->segments()) > 1 && request()->segments()[1] == 'master-category' ? 'mm-active' : '' }}" href="#"><i class="metismenu-icon pe-7s-server"></i>Category</a>
                    </li>
                </ul>
            </li>
            <li class="app-sidebar__heading">Blog</li>
            <li>
                <a class="blog-category {{ request()->is('blog-category') ? 'mm-active' : '' }}" href="{{ route('admin.blog-category.index') }}"><i class="metismenu-icon pe-7s-ticket"></i>Blog Category</a>
            </li>
            <li>
                <a class="blog-tags {{ request()->is('blog-tags') ? 'mm-active' : '' }}" href="{{ route('admin.blog-tags.index') }}"><i class="metismenu-icon pe-7s-bookmarks"></i>Blog Tags</a>
            </li>
            <li>
                <a class="blogs {{ request()->is('blogs') ? 'mm-active' : '' }}" href="{{ route('admin.blogs.index') }}"><i class="metismenu-icon pe-7s-note"></i>Blog</a>
            </li>
            <li class="app-sidebar__heading">Marketing</li>
            <li>
                <a class="banners {{ request()->is('banners') ? 'mm-active' : '' }}" href="{{ route('admin.banners.index') }}"><i class="metismenu-icon pe-7s-photo-gallery"></i>Banners</a>
            </li>
        </ul>
    </div>
</div>
