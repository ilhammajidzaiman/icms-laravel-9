@extends('admin-lte.private.templates.main')

@section('header')
    rincian akses
@endsection

@section('container')
    <x-button-link href="{{ route('developer.management.access.index') }}" label="kembali"
        class="rounded-pill btn-sm btn-outline-secondary mb-3" icon="fa-arrow-left" />

    <div class="row">
        <div class="col-md-9 col-lg">
            <div class="card">
                <div class="card-body">
                    <div class="form-row">
                        <x-form-input-row-readonly type="text" name="name" label="level"
                            value="{{ old('name', $level->name) }}" class="col-md-4" />
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="menu">Akses Menu</label>
                            <ol class="pl-3">
                                @php
                                    $parents = App\Models\UserAccessParent::where('user_level_id', $level->id)
                                        ->with(['menu'])
                                        ->orderBy('order')
                                        ->get();
                                @endphp
                                @foreach ($parents as $parent)
                                    {{-- data parent menu --}}
                                    <li>
                                        {{ $parent->menu->name }}
                                        {{-- data child menu --}}
                                        <ol class="pl-3">
                                            @php
                                                $children = App\Models\UserAccessChild::where('user_level_id', $level->id)
                                                    ->where('user_menu_parent_id', $parent->menu->id)
                                                    ->with(['menu'])
                                                    ->orderBy('order')
                                                    ->get();
                                            @endphp
                                            @foreach ($children as $child)
                                                <li>{{ $child->menu->name }}</li>
                                            @endforeach
                                        </ol>
                                        {{-- end data child menu --}}
                                    </li>
                                    {{-- end data parent menu --}}
                                @endforeach
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
