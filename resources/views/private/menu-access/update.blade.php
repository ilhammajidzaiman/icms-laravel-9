@extends('private.templates.main')
@section('container')
<x-private.button.link-back href="../" />

<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <div class="form-row">
                    <x-private.form.input-row-readonly type="text" name="name" label="nama"
                        :value="old('name',$level->name)" class="col-md-4" />
                </div>

                <div class="text-capitalize mb-3">
                    <label>akses menu</label>
                    <ul class="list-unstyled">
                        @foreach ($menus as $menu)
                        @php
                        $accesses=App\Models\UserAccess::where('level_id',$level->id)->where('menu_id',$menu->id)->orderBy('order')->get();
                        @endphp
                        <li>
                            {{-- data parent menu --}}
                            <div class="form-check">
                                <input class="form-check-input check-parent" type="checkbox" name="menu"
                                    id="{{ $menu->id }}" value="{{ $menu->id }}" @foreach ($accesses as $acces) {{
                                    $menu->id
                                == $acces->menu_id ? 'checked':'' }} @endforeach
                                data-level="{{$level->id}}"
                                data-menu="{{ $menu->id }}" data-order="{{ $menu->order }}" >
                                <label class="form-check-label" for="{{ $menu->id }}">
                                    <i class="{{ $menu->icon }}"></i>
                                    {{ $menu->name }}
                                </label>
                            </div>
                            {{-- end data parent menu --}}

                            <ol class="list-unstyled pl-4">
                                @php
                                $childs= App\Models\UserMenu::where('parent_id',$menu->id)->orderBy('order')->get();
                                @endphp
                                @foreach ($childs as $child)
                                @php
                                $checkedChild=App\Models\UserAccessChild::where('menu_id',$menu->id)->where('child_id',$child->id)->orderBy('order')->get();
                                @endphp
                                <li>
                                    {{-- data child menu --}}
                                    <div class="form-check">
                                        <input class="form-check-input check-child" type="checkbox" name="menu"
                                            id="{{ $child->id }}" value="{{ $child->id }}" data-parent="{{$menu->id}}"
                                            @foreach ($checkedChild as $acces) {{ $menu->id == $acces->menu_id ?
                                        'checked':'' }} @endforeach
                                        data-child="{{ $child->id }}" data-child-order="{{ $child->order }}" >
                                        <label class="form-check-label" for="{{ $child->id }}">
                                            <i class="{{ $child->icon }}"></i>
                                            {{ $child->name }}
                                            {{ $child->order }}
                                        </label>
                                    </div>
                                    {{-- end data child menu --}}
                                </li>
                                @endforeach
                            </ol>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection