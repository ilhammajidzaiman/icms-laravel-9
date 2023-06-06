@extends('private.templates.layout')

@section('header')
    child menu baru
@endsection

@section('container')
    <x-button-link href="{{ route(Request::segment(1) . '.nav-menu.parent.index') }}" label="kembali"
        class="rounded-pill btn btn-md btn-outline-primary mb-3" icon="fa-fw fas fa-arrow-left" />

    <div class="row">
        <div class="col-12 col-md">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <form action="{{ route(Request::segment(1) . '.nav-menu.child.store', $navMenuParent->uuid) }}"
                            method="post">
                            @csrf
                            <div class="row">
                                <x-form-input-row-readonly type="text" name="parent" label="parent nav menu"
                                    value="{{ $navMenuParent->name }}" class="col" />
                            </div>
                            <div class="row">
                                <x-form-input-row type="number" name="order" label="urutan" value="{{ old('order') }}"
                                    class="col-md-2" />
                            </div>
                            <div class="row">
                                <x-form-input-row type="text" name="name" label="nama" value="{{ old('name') }}"
                                    class="col-md-4" />
                            </div>
                            <div class="row">
                                <x-form-input-row type="text" name="url" label="url" value="{{ old('url') }}"
                                    class="col" />
                            </div>
                            <x-button-submit label="simpan" class="btn btn-primary" icon="fa-fw fas fa-save" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
