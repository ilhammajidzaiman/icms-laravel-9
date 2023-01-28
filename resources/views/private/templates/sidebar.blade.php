<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ url($segment1.'/dashboard') }}" class="brand-link">
        @php
        $value = $config->file;
        $value == 'logo.svg' ? $url=url('assets/images/'.$value) : $url=asset('storage/'.$value);
        @endphp
        <img src="{{ $url }}" alt="{{ $url }}" class="brand-image img-circlee elevation-22" width="86" height="86">
        <span class="brand-text font-weight-lightt">{{ $config->app }}</span>
    </a>

    <div class="sidebar">
        <div class="user-panel my-3 pb-3 d-flex">
            <div class="image">
                @php
                $value=auth()->user()->file;
                $value == 'default-user.svg' ? $url=url('assets/images/'.$value) : $url=asset('storage/'.$value);
                @endphp
                <img src="{{ $url }}" class="img-circle elevation-22" alt="{{ $url }}" width="120" height="120">
            </div>
            <div class="info">
                <a href="{{ url('/'.$segment1.'/profil/'.auth()->user()->uuid) }}" class="d-block">{{
                    auth()->user()->name }}</a>
            </div>
        </div>
        <nav class="mt-2 text-capitalize">
            <ul class="nav nav-pills nav-sidebar flex-column nav-flat" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="{{ url('/'.$segment1.'/dashboard') }}"
                        class="nav-link {{ Request::is($segment1.'/dashboard*')?'active':'' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p class="text">Dashboard</p>
                    </a>
                </li>

                @can('admin')
                <li class="nav-item">
                    <a href="{{ url('/'.$segment1.'/config') }}"
                        class="nav-link {{ Request::is($segment1.'/config*')?'active':'' }}">
                        <i class="nav-icon fa-fw fas fa-cog"></i>
                        <p class="text">config</p>
                    </a>
                </li>

                <li class="nav-item {{ $segment2 == 'master' ? 'menu-open' : ''}}">
                    <a href="#" class="nav-link {{ $segment2 == 'master' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Master
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('/'.$segment1.'/master/status') }}"
                                class="nav-link {{ Request::is($segment1.'/'.$segment2.'/status*')?'active':'' }}">
                                <i class="nav-icon fa-fw fas fa-check"></i>
                                <p class="text">status</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/'.$segment1.'/master/level') }}"
                                class="nav-link {{ Request::is($segment1.'/'.$segment2.'/level*')?'active':'' }}">
                                <i class="nav-icon fa-fw fas fa-star"></i>
                                <p class="text">level</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/'.$segment1.'/master/menu') }}"
                                class="nav-link {{ Request::is($segment1.'/'.$segment2.'/menu*')?'active':'' }}">
                                <i class="nav-icon fa-fw fas fa-list"></i>
                                <p class="text">menu</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/'.$segment1.'/master/access') }}"
                                class="nav-link {{ Request::is($segment1.'/'.$segment2.'/access*')?'active':'' }}">
                                <i class="nav-icon fa-fw fas fa-shield-alt"></i>
                                <p class="text">akses</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="{{ url('/'.$segment1.'/user') }}"
                        class="nav-link {{ Request::is($segment1.'/user*')?'active':'' }}">
                        <i class="nav-icon fa-fw fas fa-users"></i>
                        <p class="text">user</p>
                    </a>
                </li>
                @endcan

                <li class="nav-header mx-2 mb-3" style="border-bottom: 1px solid #4f5962"></li>

                <li class="nav-item">
                    <a href="{{ url('/logout') }}" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt "></i>
                        <p>Logout</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>