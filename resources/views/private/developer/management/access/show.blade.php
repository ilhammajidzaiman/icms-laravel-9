@extends('private.templates.layout')

@section('header')
    rincian level akses
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
                                <ol class="list-unstyled">
                                    @php
                                        // $parents = App\Models\UserAccessParent::where('user_level_id', $level->id)
                                        //     ->with(['menu'])
                                        //     ->get();
                                        $parents = App\Models\UserMenuParent::whereHas('access', function ($q) use ($level) {
                                            $q->where('user_level_id', $level->id);
                                        })
                                            ->orderBy('order')
                                            ->get();
                                    @endphp
                                    @foreach ($parents as $parent)
                                        {{-- data parent menu --}}
                                        <li>
                                            <x-badge class="badge bg-primary" label="{{ $parent->order }}" />
                                            <i class="{{ $parent->icon }}"></i>
                                            {{ $parent->name }}
                                            {{-- data child menu --}}
                                            <ol class="list-unstyled ms-5 pb-2">
                                                @php
                                                    // $children = App\Models\UserAccessChild::where('user_level_id', $level->id)
                                                    //     ->where('user_menu_parent_id', $parent->menu->id)
                                                    //     ->with(['menu'])
                                                    //     ->get();
                                                    $children = App\Models\UserMenuChild::whereHas('access', function ($q) use ($parent, $level) {
                                                        $q->where('user_level_id', $level->id)->where('user_menu_parent_id', $parent->id);
                                                    })
                                                        ->orderBy('order')
                                                        ->get();
                                                @endphp
                                                @foreach ($children as $child)
                                                    <li>
                                                        <x-badge class="badge bg-secondary" label="{{ $child->order }}" />
                                                        <i class="{{ $child->icon }}"></i>
                                                        {{ $child->name }}
                                                    </li>
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
    </div>
@endsection

{{-- @extends('private.templates.layout')

@section('header')
    rincian level akses
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
                                <ol class="list-unstyled">
                                    @php
                                        $parents = App\Models\UserAccessParent::where('user_level_id', $level->id)
                                            ->with(['menu'])
                                            ->get();
                                    @endphp
                                    @foreach ($parents as $parent)
                                        <li>
                                            <x-badge class="badge bg-primary" label="{{ $parent->menu->order }}" />
                                            <i class="{{ $parent->menu->icon }}"></i>
                                            {{ $parent->menu->name }}
                                            <ol class="list-unstyled ms-5 pb-2">
                                                @php
                                                    $children = App\Models\UserAccessChild::where('user_level_id', $level->id)
                                                        ->where('user_menu_parent_id', $parent->menu->id)
                                                        ->with(['menu'])
                                                        ->get();
                                                    
                                                    $children = App\Models\UserMenuChild::whereHas('access', function ($q) use ($parent) {
                                                        $q->where('user_level_id', auth()->user()->user_level_id)->where('user_menu_parent_id', $parent->id);
                                                    })
                                                        ->orderBy('order')
                                                        ->get();
                                                @endphp
                                                @foreach ($children as $child)
                                                    <li>
                                                        <x-badge class="badge bg-secondary"
                                                            label="{{ $child->menu->order }}" />
                                                        <i class="{{ $child->menu->icon }}"></i>
                                                        {{ $child->menu->name }}
                                                    </li>
                                                @endforeach
                                            </ol>
                                        </li>
                                    @endforeach
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection --}}
