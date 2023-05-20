<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ route(Request::segment(1) . '.dashboard') }}" class="brand-link">
        <img src="{{ asset('assets/images/' . config('app.icon')) }}" alt="{{ config('app.icon') }}"
            class="brand-image img-circlee elevation-22" style="width:30px;height:30px;">
        <span class="brand-text font-weight-lightt">{{ config('app.name') }}</span>
    </a>

    <div class="sidebar">
        <div class="user-panel my-3 pb-3 d-flex">
            <div class="image">
                @php
                    $path = auth()->user()->path;
                    $file = auth()->user()->file;
                    $file == 'default-user.svg' ? ($url = asset('assets/images/' . $file)) : ($url = asset('storage/' . $path . $file));
                @endphp
                <img src="{{ $url }}" class="img-circle elevation-22" alt="{{ $url }}"
                    style="width:30px;height:30px;">
            </div>
            <div class="info">

                <a href="{{ route(Request::segment(1) . '.profil.index', auth()->user()->uuid) }}"
                    class="d-block">{{ auth()->user()->name }}</a>
            </div>
        </div>
        <nav class="mt-2 text-capitalize">
            <ul class="nav nav-pills nav-sidebar flex-column nav-flat" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route(Request::segment(1) . '.dashboard') }}"
                        class="nav-link {{ Request::is(Request::segment(1) . '/dashboard*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p class="text">Dashboard</p>
                    </a>
                </li>

                @php
                    // $parents = App\Models\UserAccessParent::where('user_level_id', auth()->user()->user_level_id)
                    //     ->with(['menu'])
                    //     ->orderBy('order')
                    //     ->get();
                    $parents = App\Models\UserMenuParent::whereHas('access', function ($q) {
                        $q->where('user_level_id', auth()->user()->user_level_id);
                    })
                        ->orderBy('order')
                        ->get();
                    
                @endphp
                @forelse ($parents as $parent)
                    {{-- ada data parents --}}

                    @if (empty($parent->url) || $parent->url === '#')
                        {{-- url kosong atau pagar --}}
                        <li class="nav-item {{ $segment2 == $parent->prefix ? 'menu-open' : '' }}">
                            <a href="{{ '/' . Request::segment(1) . '/' . $parent->prefix }}"
                                class="nav-link {{ $segment2 == $parent->prefix ? 'active' : '' }}">
                                <i class="nav-icon {{ $parent->icon }}"></i>
                                <p class="text">
                                    {{ $parent->name }}
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @php
                                    // $children = App\Models\UserAccessChild::where('user_level_id', auth()->user()->user_level_id)
                                    //     ->where('user_menu_parent_id', $parent->id)
                                    //     ->with(['menu'])
                                    //     ->orderBy('order')
                                    //     ->get();
                                    
                                    $children = App\Models\UserMenuChild::whereHas('access', function ($q) use ($parent) {
                                        $q->where('user_level_id', auth()->user()->user_level_id)->where('user_menu_parent_id', $parent->id);
                                    })
                                        ->orderBy('order')
                                        ->get();
                                @endphp
                                @forelse ($children as $child)
                                    <li class="nav-item">
                                        <a href="{{ url('/' . Request::segment(1) . $child->url) }}"
                                            class="nav-link {{ Request::is(Request::segment(1) . $child->url . '*') ? 'active' : '' }}">
                                            <i class="nav-icon {{ $child->icon }}"></i>
                                            <p class="text">{{ $child->name }}</p>
                                        </a>
                                    </li>
                                @empty
                                    <li class="nav-item">
                                        <a href="{{ route(Request::segment(1) . '.dashboard') }}" class="nav-link">
                                            <i class="nav-icon fa-fw fas fa-info-circle"></i>
                                            <p class="text">anda tidak punya akses!</p>
                                        </a>
                                    </li>
                                @endforelse

                            </ul>
                        </li>
                        {{-- end url kosong atau pagar --}}
                    @else
                        {{-- url ada --}}
                        <li class="nav-item">
                            <a href="{{ url('/' . Request::segment(1) . $parent->url) }}"
                                class="nav-link {{ Request::is(Request::segment(1) . $parent->url . '*') ? 'active' : '' }}">
                                <i class="nav-icon {{ $parent->icon }}"></i>
                                <p class="text">{{ $parent->name }}</p>
                            </a>
                        </li>
                        {{-- end url ada --}}
                    @endif

                @empty
                    {{-- tidak ada data parents --}}
                    <li class="nav-item">
                        <a href="{{ route(Request::segment(1) . '.dashboard') }}" class="nav-link">
                            <i class="nav-icon fa-fw fas fa-info-circle"></i>
                            <p class="text">anda tidak punya akses!</p>
                        </a>
                    </li>
                    {{-- end tidak ada data parents --}}
                @endforelse
                <li class="nav-header mx-2 mb-3" style="border-bottom: 1px solid #4f5962"></li>
                <li class="nav-item">
                    <a href="{{ route('auth.logout') }}" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt "></i>
                        <p>Logout</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
