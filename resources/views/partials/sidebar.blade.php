<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.index') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fa-solid fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">MY_CMS@2025</div>
    </a>

    <hr class="sidebar-divider my-0">

    <!-- Dashboard -->
    <li class="nav-item {{ request()->routeIs('admin.index') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.index') }}">
            <i class="fa-solid fa-gauge-high"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <div class="sidebar-heading">CONTENT MANAGEMENT</div>

    <!-- Posts -->
    <li class="nav-item {{ request()->routeIs('posts.*') ? 'active' : '' }}">
        <a class="nav-link {{ request()->routeIs('posts.*') ? '' : 'collapsed' }}" href="#" data-toggle="collapse"
            data-target="#collapseTwo" aria-expanded="{{ request()->routeIs('posts.*') ? 'true' : 'false' }}"
            aria-controls="collapseTwo">
            <i class="fa-solid fa-file-lines"></i>
            <span>Posts</span>
        </a>
        <div id="collapseTwo" class="collapse {{ request()->routeIs('posts.*') ? 'show' : '' }}"
            aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">POST MANAGEMENT:</h6>
                <a class="collapse-item {{ request()->routeIs('posts.index') ? 'active' : '' }}"
                   href="{{ route('posts.index') }}">View All Posts</a>
                <a class="collapse-item {{ request()->routeIs('posts.create') ? 'active' : '' }}"
                   href="{{ route('posts.create') }}">Create New Post</a>
            </div>
        </div>
    </li>

    <!-- Comments -->
    <li class="nav-item {{ request()->routeIs('comments.index') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('comments.index') }}">
            <i class="fa-solid fa-comments"></i>
            <span>Comments</span>
        </a>
    </li>

    <!-- Messages -->
    <li class="nav-item {{ request()->routeIs('messages.index') ? 'active' : '' }}">
        <a class="nav-link" href="{{route('messages.index')}}">
            <i class="fa-solid fa-envelope"></i>
            <span>Messages</span>
        </a>
    </li>

    <!-- Categories -->
    <li class="nav-item {{ request()->routeIs('categories.index') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('categories.index') }}">
            <i class="fa-solid fa-tags"></i>
            <span>Categories</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <div class="sidebar-heading">USER MANAGEMENT</div>

    <!-- Users -->
    <li class="nav-item {{ request()->routeIs('users.*') ? 'active' : '' }}">
        <a class="nav-link {{ request()->routeIs('users.*') ? '' : 'collapsed' }}" href="#" data-toggle="collapse"
            data-target="#collapseUsers" aria-expanded="{{ request()->routeIs('users.*') ? 'true' : 'false' }}"
            aria-controls="collapseUsers">
            <i class="fa-solid fa-users-gear"></i>
            <span>Users</span>
        </a>
        <div id="collapseUsers" class="collapse {{ request()->routeIs('users.*') ? 'show' : '' }}"
            aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">MANAGE USERS:</h6>
                <a class="collapse-item {{ request()->routeIs('users.index') ? 'active' : '' }}"
                   href="{{ route('users.index') }}">View All Users</a>
                <a class="collapse-item {{ request()->routeIs('users.create') ? 'active' : '' }}"
                   href="{{ route('users.create') }}">Create New User</a>
            </div>
        </div>
    </li>

    <!-- Profile -->
    <li class="nav-item {{ request()->routeIs('profile.*') ? 'active' : '' }}">
        <a class="nav-link {{ request()->routeIs('profile.*') ? '' : 'collapsed' }}" href="#"
            data-toggle="collapse" data-target="#collapseProfile"
            aria-expanded="{{ request()->routeIs('profile.*') ? 'true' : 'false' }}"
            aria-controls="collapseProfile">
            <i class="fa-solid fa-user"></i>
            <span>Profile</span>
        </a>
        <div id="collapseProfile" class="collapse {{ request()->routeIs('profile.*') ? 'show' : '' }}"
            aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">PROFILE SETTINGS:</h6>
                <a class="collapse-item {{ request()->routeIs('profile.index') ? 'active' : '' }}"
                   href="{{ route('profile.index', Auth::user()->id) }}">View Profile</a>
                <a class="collapse-item {{ request()->routeIs('profile.edit') ? 'active' : '' }}"
                   href="{{ route('profile.edit', Auth::user()->id) }}">Edit Profile</a>
            </div>
        </div>
    </li>

    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>