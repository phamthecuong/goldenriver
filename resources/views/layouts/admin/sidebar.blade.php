<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element text-center">
                    <img alt="image" class="rounded-circle" src="{{ asset('images/profile_small.jpg') }}"/>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="block m-t-xs font-bold">
                            @if (\Illuminate\Support\Facades\Auth::check())
                                {{ \Illuminate\Support\Facades\Auth::user()->name }}
                            @endif
                            <b class="caret"></b>
                        </span>

                    </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a class="dropdown-item" href="#">Profile</a></li>
                        <li class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                        </li>
                    </ul>
                </div>
                <div class="logo-element">
                    IN+
                </div>
            </li>
            <li class="{{ request()->is(['admin/dashboard*', 'admin']) ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard.index') }}">
                    <i class="fa fa-th-large"></i>
                    <span class="nav-label">Dashboards</span>
                </a>
            </li>
            <li class="{{ request()->is(['admin/cms*']) ? 'active' : '' }}">
                <a href="#">
                    <i class="fas fa-file-word"></i>
                    <span class="nav-label">CMS</span>
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level collapse">
                    <li class="{{ request()->is(['admin/cms/category*']) ? 'active' : '' }}">
                        <a href="{{ route('admin.cms.category.index') }}">Danh mục</a>
                    </li>
                    <li class="{{ request()->is(['admin/cms/post/create']) ? 'active' : '' }}">
                        <a href="{{ route('admin.cms.post.create') }}">Viết bài</a>
                    </li>
                    <li class="{{ request()->is(['admin/cms/post']) ? 'active' : '' }}">
                        <a href="{{ route('admin.cms.post.index') }}">Bài đã viết</a>
                    </li>
                    <li class="{{ request()->is(['admin/cms/post/deleted']) ? 'active' : '' }}"><a href="{{ route('admin.cms.post.deleted') }}">Bài đã xóa</a></li>
                </ul>
            </li>
            <li class="{{ request()->is('admin/page*') ? 'active' : '' }}">
                <a href="{{ route('admin.page.index') }}">
                    <i class="fa fa-th-large"></i>
                    <span class="nav-label">Quản lý trang</span>
                </a>
            </li>
            <li class="{{ request()->is(['admin/core*']) ? 'active' : '' }}">
                <a href="#">
                    <i class="fas fa-users"></i>
                    <span class="nav-label">Thành viên</span>
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level collapse">
                    <li class="{{ request()->is(['admin/core/user*']) ? 'active' : '' }}">
                        <a href="{{ route('admin.core.user.index') }}">Danh sách</a>
                    </li>
                    <li class="{{ request()->is(['admin/core/role*']) ? 'active' : '' }}">
                        <a href="{{ route('admin.core.role.index') }}">Nhóm quyền</a>
                    </li>
                    <li class="{{ request()->is(['admin/core/permission*']) ? 'active' : '' }}">
                        <a href="{{ route('admin.core.permission.index') }}">Phân quyền</a>
                    </li>
                    <li  class="{{ request()->is(['admin/core/navigation*']) ? 'active' : '' }}">
                        <a href="{{ route('admin.core.nav.index') }}">Quản lý Menu</a>
                    </li>
                </ul>
            </li>
        </ul>

    </div>
</nav>