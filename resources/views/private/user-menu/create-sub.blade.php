@extends('private.templates.main')
@section('container')

<x-button-link-pill :href="'./'" label="kembali" class="btn-sm btn-outline-secondary mb-3" icon="fa-arrow-left" />

<div class="row">
    <div class="col-md-9 col-lg">
        <div class="card">
            <div class="card-body">
                <form action="{{ $segmentUrl.'/'.$menu->uuid.'/create_sub' }}" method="post">
                    @csrf
                    <div class="form-row">
                        <x-form-input-row-readonly type="text" name="main" label="menu utama"
                            :value="old('main',$menu->name)" class="col-md-6" />
                    </div>
                    <div class="form-row">
                        <x-form-input-row type="number" name="order" label="urutan" :value="old('order')"
                            class="col-md-2" />
                    </div>
                    <div class="form-row">
                        <x-form-input-row type="text" name="name" label="nama" :value="old('name')" class="col-md-4" />
                    </div>
                    <div class="form-row">
                        <x-form-input-row type="text" name="icon" label="icon" :value="old('icon')" class="col-md-4" />
                    </div>
                    <div class="form-row">
                        <x-form-input-row type="text" name="prefix" label="prefix" :value="old('prefix')" class="col" />
                    </div>
                    <div class="form-row">
                        <x-form-input-row type="text" name="url" label="url" :value="old('url')" class="col" />
                    </div>
                    <x-button-submit label="simpan" class="btn-primary" icon="fa-save" />
                </form>
            </div>
        </div>
    </div>
</div>
@endsection