{{-- Add header --}}

<div class="container-fluid">
    <div class="navigation">
        <div class="row">
            <ul class="topnav">
                <li></li>
                <li>
                    <a href="{{ url('home') }}">
                        <i class="fa fa-home"></i> {{ trans('global.home') }}</a>
                </li>
                <li>
                    <a href="{{ url('create') }}">
                        <i class="fa fa-file-text-o"></i> {{ trans('global.submit_tickets') }}</a>

                </li>
                <li>
                    <a href="{{ url('list') }}">
                        <i class="fa fa-file-text-o"></i> {{ trans('global.my_tickets') }}</a>

                </li>
                <li>
                    <a href="{{ url('knowledge/base') }}">
                        <i class="fa fa-book"></i> {{ trans('global.knowledge_base') }}</a>
                </li>
                <li>

                    <a href="{{ route('logout') }}"
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
        </div>
    </div>
</div>
