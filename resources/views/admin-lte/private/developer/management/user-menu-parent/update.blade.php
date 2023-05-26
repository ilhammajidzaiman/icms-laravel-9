@extends('admin-lte.private.templates.main')

@section('header')
    edit menu parent
@endsection

@section('container')
    <x-button-link href="{{ route('developer.management.user.menu.parent.index') }}" label="kembali"
        class="rounded-pill btn-sm btn-outline-secondary mb-3" icon="fa-arrow-left" />

    <div class="row">
        <div class="col-md-9 col-lg">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('developer.management.user.menu.parent.update', $menuParent->uuid) }}"
                        method="post">
                        @method('put')
                        @csrf
                        <div class="form-row">
                            <x-form-input-row type="number" name="order" label="urutan" :value="old('order', $menuParent->order)"
                                class="col-md-2" />
                        </div>
                        <div class="form-row">
                            <x-form-input-row type="text" name="name" label="nama" :value="old('name', $menuParent->name)"
                                class="col-md-4" />
                        </div>
                        <div class="form-row">
                            <x-form-input-row type="text" name="icon" label="icon" :value="old('icon', $menuParent->icon)"
                                class="col-md-4" />
                        </div>
                        <div class="form-row">
                            <x-form-input-row type="text" name="prefix" label="prefix" :value="old('prefix', $menuParent->prefix)"
                                class="col" />
                        </div>
                        <div class="form-row">
                            <x-form-input-row type="text" name="url" label="url" :value="old('url', $menuParent->url)"
                                class="col" />
                        </div>
                        <x-button-submit label="simpan" class="rounded-pill btn-primary" icon="fa-save" />
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
