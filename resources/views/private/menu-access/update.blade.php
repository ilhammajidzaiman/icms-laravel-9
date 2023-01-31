@extends('private.templates.main')
@section('container')
<x-private.button.link-back href="../" />

<div class="row">
    <div class="col-md-9 col-lg">
        <div class="card">
            <div class="card-body">
                <form action="{{ $segmentForm.'/'.$level->slug }}" method="post">
                    @method('put')
                    @csrf
                    <div class="form-row">
                        <x-private.form.input-row type="text" name="name" label="nama" :value="old('name',$level->name)"
                            class="col-md-4" />
                    </div>

                    <div class="text-capitalize mb-3">
                        <label>akses menu</label>
                        @foreach ($menus as $menu)

                        @php
                        $accesses=App\Models\UserAccess::where('level_id',$level->id)->where('menu_id',$menu->id)->get();
                        @endphp
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="menu[]" id="{{ $menu->id }}"
                                value="{{ $menu->id }}" @foreach ($accesses as $acces) {{$menu->id ==
                            $acces->menu_id
                            ?
                            'checked':''}}@endforeach
                            >
                            <label class="form-check-label" for="{{ $menu->id }}">
                                <i class="{{ $menu->icon }}"></i>
                                {{ $menu->name }}
                            </label>
                        </div>
                        @endforeach
                    </div>


                    <x-private.button.button-save />
                </form>
            </div>
        </div>
    </div>
</div>
@endsection