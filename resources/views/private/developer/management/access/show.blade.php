@extends('private.templates.layout')

@section('header')
    rincian level akses
@endsection

@section('container')
    <x-button-link href="{{ route('developer.management.access.index') }}" label="kembali"
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
                                <ol>
                                    @php
                                        $parents = App\Models\UserAccessParent::where('user_level_id', $level->id)
                                            ->with(['menu'])
                                            ->get();
                                    @endphp
                                    @foreach ($parents as $parent)
                                        {{-- data parent menu --}}
                                        <li>
                                            {{ $parent->menu->name }}
                                            {{-- data child menu --}}
                                            <ol>
                                                @php
                                                    $children = App\Models\UserAccessChild::where('user_level_id', $level->id)
                                                        ->where('user_menu_parent_id', $parent->menu->id)
                                                        ->with(['menu'])
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
    </div>
@endsection
