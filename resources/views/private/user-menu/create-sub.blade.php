@extends('private.templates.main')
@section('container')
<x-private.button.link-back href="../" />

<div class="row">
    <div class="col-md-9 col-lg">
        <div class="card">
            <div class="card-body">
                <form action="{{ $segmentForm.'/'.$menu->slug.'/create_sub' }}" method="post">
                    @csrf
                    <div class="form-row">
                        <x-private.form.input-row-readonly type="text" name="main" label="menu utama"
                            :value="old('main',$menu->name)" class="col-md-6" />
                    </div>
                    <div class="form-row">
                        <x-private.form.input-row type="number" name="order" label="urutan" :value="old('order')"
                            class="col-md-2" />
                    </div>
                    <div class="form-row">
                        <x-private.form.input-row type="text" name="name" label="nama" :value="old('name')"
                            class="col-md-4" />
                    </div>
                    <div class="form-row">
                        <x-private.form.input-row type="text" name="icon" label="icon" :value="old('icon')"
                            class="col-md-4" />
                    </div>
                    <div class="form-row">
                        <x-private.form.input-row type="text" name="prefix" label="prefix" :value="old('prefix')"
                            class="col" />
                    </div>
                    <div class="form-row">
                        <x-private.form.input-row type="text" name="url" label="url" :value="old('url')" class="col" />
                    </div>
                    <x-private.button.button-save />
                </form>
            </div>
        </div>
    </div>
</div>
@endsection