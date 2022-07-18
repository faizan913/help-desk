<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        @auth
            <span class="brand-text font-weight-light">{{ Auth::user()->name }}</span>
        @endauth
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item menu-open">
                    <a href="{{ route('admin.dashboard') }}"
                        class="nav-link
                        {{ request()->is('/') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            {{ trans('global.dashboard') }}
                        </p>
                    </a>

                </li>
                @role('Admin')
                    <li class="nav-item">
                        <a href="#"
                            class="nav-link {{ request()->is('users') || request()->is('users/*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                {{ trans('global.user_management') }}
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('users.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p> {{ trans('global.user') }}</p>
                                </a>
                            </li>

                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="#"
                            class="nav-link {{ request()->is('priorities') || request()->is('statuses') || request()->is('departments') || request()->is('services/*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-wrench"></i>
                            <p>
                                {{ trans('global.tools') }}
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('priorities.index') }}"
                                    class="nav-link {{ request()->is('priorities') || request()->is('priorities/*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-th"></i>
                                    <p>
                                        {{ trans('global.priority') }}
                                        <span class="right badge badge-danger">New</span>
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('statuses.index') }}"
                                    class="nav-link {{ request()->is('statuses') || request()->is('statuses/*') ? 'active' : '' }}">
                                    <i class="nav-icon far fa-image"></i>
                                    <p>
                                        {{ trans('global.status') }}
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('departments.index') }}"
                                    class="nav-link {{ request()->is('departments') || request()->is('departments/*') ? 'active' : '' }}">
                                    <i class="nav-icon far fa-image"></i>
                                    <p>
                                        {{ trans('global.department') }}
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('services.index') }}"
                                    class="nav-link {{ request()->is('services') || request()->is('services/*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-columns"></i>
                                    <p>
                                        Service Type
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('comments.index') }}"
                            class="nav-link {{ request()->is('comments') || request()->is('comments/*') ? 'active' : '' }}">
                            <i class="fa-fw fas fa-comment nav-icon"></i>
                            <p>{{ trans('global.comments') }}</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="#"
                            class="nav-link {{ request()->is('knowledges') || request()->is('knowledges/*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-book"></i>
                            <p>
                                {{ trans('global.knowledge_base') }}
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('knowledges.index') }}" class="nav-link">
                                    <i class="nav-icon fas fa-book"></i>
                                    <p> {{ trans('global.knowledge_base') }}</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('articlecomments.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p> {{ trans('global.article_comments') }}</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('ratings.index') }}"
                            class="nav-link {{ request()->is('ratings') || request()->is('ratings/*') ? 'active' : '' }}">
                            <i class="fa-fw fas fa-question-circle nav-icon"></i>
                            <p> {{ trans('global.ratings') }}</p>
                        </a>
                    </li>
                @endrole
                <li class="nav-item">
                    <a href="{{ route('tickets.index') }}"
                        class="nav-link {{ request()->is('tickets') || request()->is('tickets/*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-ticket-alt"></i>
                        <p> {{ trans('global.tickets') }}</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('reports.index') }}"
                        class="nav-link {{ request()->is('reports') || request()->is('reports/*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-chart-line"></i>
                        <p> {{ trans('global.reports') }}</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        <i class="nav-icon fas fa-fw fa-sign-out-alt"></i>
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>


            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
