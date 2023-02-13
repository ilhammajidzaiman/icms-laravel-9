<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ url($segment1.'/dashboard') }}" class="brand-link">
        @php
        $value = $config->file;
        $value == 'logo.svg' ? $url=url('assets/images/'.$value) : $url=asset('storage/'.$value);
        @endphp
        <img src="{{ $url }}" alt="{{ $url }}" class="brand-image img-circlee elevation-22"
            style="width:30px;height:30px;">
        <span class="brand-text font-weight-lightt">{{ $config->app }}</span>
    </a>

    <div class="sidebar">
        <div class="user-panel my-3 pb-3 d-flex">
            <div class="image">
                @php
                $value=auth()->user()->file;
                $value == 'default-user.svg' ? $url=url('assets/images/'.$value) : $url=asset('storage/'.$value);
                @endphp
                <img src="{{ $url }}" class="img-circle elevation-22" alt="{{ $url }}" style="width:30px;height:30px;">
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

                @php
                $parents=
                App\Models\UserAccess::where('level_id',auth()->user()->level_id)->with(['menu'])->orderBy('order')->get();
                @endphp

                @forelse ($parents as $parent)
                {{-- ada data parents --}}

                @if ((empty($parent->menu->url)) || ($parent->menu->url==='#'))
                {{-- url kosong atau pagar --}}
                <li class="nav-item {{ $segment2 == $parent->menu->prefix ? 'menu-open' : ''}}">
                    <a href="{{ '/'.$segment1.'/'.$parent->menu->prefix }}"
                        class="nav-link {{ $segment2 == $parent->menu->prefix ? 'active' : '' }}">
                        <i class="nav-icon {{ $parent->menu->icon }}"></i>
                        <p class="text">
                            {{ $parent->menu->name }}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        @php
                        $children= App\Models\UserMenu::where('parent_id',$parent->menu->id)->orderBy('order')->get();
                        @endphp
                        @forelse ($children as $child)
                        <li class="nav-item">
                            <a href="{{ url('/'.$segment1.$child->url) }}"
                                class="nav-link {{ Request::is($segment1.$child->url.'*')?'active':'' }}">
                                <i class="nav-icon {{ $child->icon }}"></i>
                                <p class="text">{{ $child->name }}</p>
                            </a>
                        </li>
                        @empty
                        <li class="nav-item">
                            <a href="{{ url('/'.$segment1.'/dashboard') }}" class="nav-link">
                                <i class="nav-icon fa-fw fas fa-info-circle"></i>
                                <p class="text">anda tidak punya akses!</p>
                            </a>
                        </li>
                        @endforelse

                    </ul>
                </li>

                @else
                {{-- url ada --}}
                <li class="nav-item">
                    <a href="{{ url('/'.$segment1.$parent->menu->url) }}"
                        class="nav-link {{ Request::is($segment1.$parent->menu->url.'*')?'active':'' }}">
                        <i class="nav-icon {{ $parent->menu->icon }}"></i>
                        <p class="text">{{ $parent->menu->name }}</p>
                    </a>
                </li>
                @endif

                @empty
                {{-- tidak ada data parents --}}
                <li class="nav-item">
                    <a href="{{ url('/'.$segment1.'/dashboard') }}" class="nav-link">
                        <i class="nav-icon fa-fw fas fa-info-circle"></i>
                        <p class="text">anda tidak punya akses!</p>
                    </a>
                </li>
                @endforelse
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