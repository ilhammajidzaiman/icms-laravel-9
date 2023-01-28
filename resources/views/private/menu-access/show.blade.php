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
                        <ol>
                            @php
                            $menus= App\Models\UserLevel::where('id', '=', $level->id)->first();
                            @endphp
                            @forelse ($menus->menus as $menu)
                            <li>
                                <i class="{{ $menu->icon }}"></i>
                                {{ $menu->name }}
                            </li>
                            @empty
                            <li>
                                <x-private.alert.alert-empty />
                            </li>
                            @endforelse
                        </ol>
                    </div>
                </div>



            </div>
        </div>
    </div>
</div>
@endsection