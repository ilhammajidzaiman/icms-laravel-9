@extends('private.templates.main')
@section('container')

<x-private.button.link-back href="./" />

<div class="row">
    <div class="col-md-9 col-lg">
        <div class="card">
            <div class="card-body">
                <div class="form-row">
                    <x-private.form.input-row-readonly type="text" name="name" label="nama"
                        :value="old('name',$level->name)" class="col-md-4" />
                </div>

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="menu">Akses Menu</label>
                        <ol class="pl-3">
                            @php
                            $parents=App\Models\UserAccess::where('level_id',$level->id)->with(['menu'])->orderBy('order')->get();
                            @endphp
                            @foreach ($parents as $parent)
                            <li>
                                {{ $parent->menu->name }}
                                <ol class="pl-3">
                                    @php
                                    $children=App\Models\UserAccessChild::where('menu_id',$parent->menu->id)->with(['menu'])->orderBy('order')->get();
                                    @endphp
                                    @foreach ($children as $child)
                                    <li>{{ $child->menu->name }}</li>
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
@endsection