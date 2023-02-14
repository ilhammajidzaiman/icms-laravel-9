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
                        $checkedParents=App\Models\UserAccess::where('level_id',$level->id)->where('menu_id',$menu->id)->orderBy('order')->get();
                        @endphp
                        {{-- parent --}}
                        <li>
                            {{-- data parent menu --}}
                            <div class="form-check">
                                <input class="form-check-input check-parent" type="checkbox" name="menu"
                                    id="{{ $menu->id }}" value="{{ $menu->id }}" @foreach ($checkedParents as $parent)
                                    {{ $menu->id == $parent->menu_id ? 'checked':'' }} @endforeach
                                data-parent-level="{{$level->id}}"
                                data-parent="{{ $menu->id }}" data-parent-order="{{ $menu->order }}" >
                                <label class="form-check-label" for="{{ $menu->id }}">
                                    <i class="{{ $menu->icon }}"></i>
                                    {{ $menu->name }}
                                </label>
                            </div>
                            {{-- end data parent menu --}}
                            {{-- child --}}
                            <ol class="list-unstyled pl-4">
                                @php
                                $children = App\Models\UserMenu::where('parent_id',$menu->id)->orderBy('order')->get();
                                @endphp
                                @foreach ($children as $child)
                                @php
                                $checkedChildren=App\Models\UserAccessChild::where('level_id',$level->id)->where('menu_id',$menu->id)->where('child_id',$child->id)->orderBy('order')->get();
                                @endphp
                                {{-- data child menu --}}
                                <li>
                                    <div class="form-check">
                                        <input class="form-check-input check-child" type="checkbox" name="menu"
                                            id="{{ $child->id }}" value="{{ $child->id }}"
                                            data-child-level="{{$level->id}}" data-child-parent="{{$menu->id}}"
                                            data-child="{{ $child->id }}" data-child-order="{{ $child->order }}"
                                            @foreach ($checkedChildren as $checkedChild) {{ $menu->id ==
                                        $checkedChild->menu_id ? 'checked':'' }} @endforeach >
                                        <label class="form-check-label" for="{{ $child->id }}">
                                            <i class="{{ $child->icon }}"></i>
                                            {{ $child->name }}
                                            {{ $child->order }}
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