@extends('private.templates.main')

@section('header')
    edit akses
@endsection

@section('container')
    <x-button-link href="{{ route('developer.management.access.index') }}" label="kembali"
        class="rounded-pill btn-sm btn-outline-secondary mb-3" icon="fa-arrow-left" />

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="form-row">
                        <x-form-input-row-readonly type="text" name="name" label="level" :value="old('name', $level->name)"
                            class="col-md-4" />
                    </div>

                    <div class="text-capitalize mb-3">
                        <label>akses menu</label>
                        <ul class="list-unstyled">
                            @foreach ($menus as $menu)
                                @php
                                    $checkedParents = App\Models\UserAccessParent::where('user_level_id', $level->id)
                                        ->where('user_menu_parent_id', $menu->id)
                                        ->orderBy('order')
                                        ->get();
                                @endphp
                                {{-- parent --}}
                                <li>
                                    {{-- data parent menu --}}
                                    <div class="form-check">
                                        <input class="form-check-input check-parent" type="checkbox" name="menu"
                                            id="parent{{ $menu->id }}" value="{{ $menu->id }}"
                                            @foreach ($checkedParents as $parent)
                                            {{ $menu->id == $parent->user_menu_parent_id ? 'checked' : '' }} @endforeach
                                            data-parent-level="{{ $level->id }}" data-parent="{{ $menu->id }}">
                                        <label class="form-check-label" for="parent{{ $menu->id }}">
                                            <i class="{{ $menu->icon }}"></i>
                                            {{ $menu->name }}
                                        </label>
                                    </div>
                                    {{-- end data parent menu --}}
                                    {{-- child --}}




                                    <ol class="list-unstyled pl-4">
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
                                                    ->orderBy('order')
                                                    ->get();
                                            @endphp
                                            {{-- data child menu --}}
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input check-child" type="checkbox"
                                                        name="menu" id="child{{ $child->id }}"
                                                        value="{{ $child->id }}" data-child-level="{{ $level->id }}"
                                                        data-child-parent="{{ $menu->id }}"
                                                        data-child="{{ $child->id }}"
                                                        @foreach ($checkedChildren as $checkedChild) {{ $menu->id == $checkedChild->user_menu_parent_id ? 'checked' : '' }} @endforeach>
                                                    <label class="form-check-label" for="child{{ $child->id }}">
                                                        <i class="{{ $child->icon }}"></i>
                                                        {{ $child->name }}
                                                    </label>
                                                </div>
                                            </li>
                                            {{-- end data child menu --}}
                                        @endforeach
                                    </ol>
                                    {{-- end child --}}
                                </li>
                                {{-- end parent --}}
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
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
