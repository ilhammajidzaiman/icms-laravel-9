@extends('private.templates.layout')

@section('header')
    edit level akses
@endsection

@section('container')
    <x-button-link href="{{ route(Request::segment(1) . '.management.access.index') }}" label="kembali"
        class="rounded-pill btn btn-md btn-outline-primary mb-3" icon="fa-fw fas fa-arrow-left" />

    <div class="row">
        <div class="col-12 col-md">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div class="row">
                            <x-form-input-row-readonly type="text" name="name" label="level"
                                value="{{ old('name', $level->name) }}" class="col" />
                        </div>

                        <div class="row">
                            <div class="form-group">
                                <label for="menu" class="form-label text-capitalize">akses menu</label>
                                {{-- parent menu --}}
                                <ul class="list-unstyled ps-55">
                                    @foreach ($menus as $menu)
                                        @php
                                            $checkedParents = App\Models\UserAccessParent::where('user_level_id', $level->id)
                                                ->where('user_menu_parent_id', $menu->id)
                                                ->get();
                                        @endphp
                                        <li>
                                            <div class="form-check">
                                                <input class="form-check-input form-check-primary check-parent"
                                                    type="checkbox" name="menu" id="parent{{ $menu->id }}"
                                                    value="{{ $menu->id }}" data-parent-level="{{ $level->id }}"
                                                    data-parent="{{ $menu->id }}"
                                                    @foreach ($checkedParents as $parent) {{ $menu->id == $parent->user_menu_parent_id ? 'checked' : '' }} @endforeach>
                                                <label class="form-check-label fw-normal" for="parent{{ $menu->id }}">
                                                    <i class="{{ $menu->icon }}"></i>
                                                    {{ $menu->name }}
                                                </label>
                                            </div>

                                            {{-- child menu --}}
                                            <ul class="list-unstyled ps-5">
                                                @php
                                                    $children = App\Models\UserMenuChild::where('user_menu_parent_id', $menu->id)
                                                        ->orderBy('order')
                                                        ->get();
                                                @endphp
                                                @foreach ($children as $child)
                                                    @php
                                                        $checkedChildren = App\Models\UserAccessChild::where('user_level_id', $level->id)
                                                            ->where('user_menu_parent_id', $menu->id)
                                                            ->where('user_menu_child_id', $child->id)
                                                            ->get();
                                                    @endphp
                                                    <li>
                                                        <div class="form-check">
                                                            <input class="form-check-input form-check-primary check-child"
                                                                type="checkbox" name="menu"
                                                                id="child{{ $child->id }}" value="{{ $child->id }}"
                                                                data-child-level="{{ $level->id }}"
                                                                data-child-parent="{{ $menu->id }}"
                                                                data-child="{{ $child->id }}"
                                                                @foreach ($checkedChildren as $checkedChild) {{ $menu->id == $checkedChild->user_menu_parent_id ? 'checked' : '' }} @endforeach>
                                                            <label class="form-check-label fw-normal"
                                                                for="child{{ $child->id }}">
                                                                <i class="{{ $child->icon }}"></i>
                                                                {{ $child->name }}
                                                            </label>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                            {{-- end child menu --}}
                                        </li>
                                    @endforeach
                                </ul>
                                {{-- end parent menu --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('/plugins/js/jquery-3.6.0.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.check-parent').on('click', function() {
                const level = $(this).data('parent-level');
                const parent = $(this).data('parent');
                $.ajax({
                    type: 'get',
                    url: "{{ url($segmentUrl . '/parent') }}/" + level + "/" + parent,
                    success: function(request) {
                        alert("Akses menu diubah!");
                    }
                });
            });

            $('.check-child').on('click', function() {
                const level = $(this).data('child-level');
                const parent = $(this).data('child-parent');
                const child = $(this).data('child');
                $.ajax({
                    type: 'get',
                    url: "{{ url($segmentUrl . '/child') }}/" + level + "/" + parent + "/" +
                        child,
                    success: function(request) {
                        alert("Akses sub menu diubah!");
                    }
                });
            });
        });
    </script>
@endsection
