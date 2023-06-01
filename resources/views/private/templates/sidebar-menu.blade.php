<div class="sidebar-menu text-capitalize">
    <ul class="menu">

        {{-- <li class="sidebar-title">Menu</li> --}}
        <li class="divider divider-left">
            <div class="divider-text">menu</div>
        </li>

        <li class="sidebar-item">
            <a href="{{ route(Request::segment(1) . '.dashboard') }}" class='sidebar-link'>
                <i class="bi bi-grid-fill"></i>
                <span>dashboard</span>
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
            @if (empty($parent->url) || $parent->url === '#')
                <li class="sidebar-item has-sub {{ $segment2 == $parent->prefix ? 'active' : '' }}">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-grid-1x2-fill"></i>
                        <span>{{ $parent->name }}</span>
                    </a>
                    <ul class="submenu {{ $segment2 == $parent->prefix ? 'active' : '' }}">
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
                            <li
                                class="submenu-item {{ Request::is(Request::segment(1) . $child->url . '*') ? 'active' : '' }}">
                                <a href="{{ url('/' . Request::segment(1) . $child->url) }}">
                                    <span>
                                        {{ $child->name }}
                                    </span>
                                </a>
                            </li>
                        @empty
                            <li class="submenu-item ">
                                <a href="{{ route(Request::segment(1) . '.dashboard') }}">
                                    no access!
                                </a>
                            </li>
                        @endforelse
                    </ul>
                </li>
            @else
                {{-- url ada --}}

                <li class="sidebar-item  ">
                    <a href="{{ route(Request::segment(1) . '.dashboard') }}" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>{{ $parent->name }}</span>
                    </a>
                </li>
            @endif
        @empty
            <li class="sidebar-item">
                <a href="{{ route(Request::segment(1) . '.dashboard') }}" class='sidebar-link'>
                    <i class="bi bi-grid-fill"></i>
                    <span>no access!</span>
                </a>
            </li>
        @endforelse

        {{-- <li class="divider divider-left">
            <div class="divider-text">Menu</div>
        </li> --}}

        <li class="sidebar-item">
            <a href="{{ route('auth.logout') }}" class='sidebar-link'>
                <i class="bi bi-box-arrow-left"></i>
                <span>logout</span>
            </a>
        </li>
    </ul>
</div>
