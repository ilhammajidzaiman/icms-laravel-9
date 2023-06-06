@extends('private.templates.layout')

@section('header')
    rincian nav menu parent
@endsection

@section('container')
    <x-button-link href="{{ route(Request::segment(1) . '.nav-menu.parent.index') }}" label="kembali"
        class="rounded-pill btn btn-md btn-outline-primary mb-3" icon="fa-fw fas fa-arrow-left" />

    <div class="row">
        <div class="col-12 col-md">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div class="row">
                            <x-form-input-row-readonly type="text" name="order" label="urutan"
                                value="{{ $navMenuParent->order }}" class="col-md-4" />
                        </div>
                        <div class="row">
                            <x-form-input-row-readonly type="text" name="name" label="nama"
                                value="{{ $navMenuParent->name }}" class="col-md-4" />
                        </div>
                        <div class="row">
                            <x-form-input-row-readonly type="text" name="url" label="url"
                                value="{{ $navMenuParent->url }}" class="col" />
                        </div>
                        <div class="row">
                            <x-form-input-row-readonly type="text" name="created_at" label="dibuat"
                                value="{{ $navMenuParent->created_at->diffForHumans() . ', ' . $navMenuParent->created_at->format('d-m-Y, H:i:s') }}"
                                class="col-md-6" />
                            <x-form-input-row-readonly type="text" name="updated_at" label="diubah"
                                value="{{ $navMenuParent->updated_at->diffForHumans() . ', ' . $navMenuParent->updated_at->format('d-m-Y, H:i:s') }}"
                                class="col-md-6" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
