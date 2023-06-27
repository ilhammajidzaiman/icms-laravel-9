@extends('private.templates.layout')

@section('header')
    rincian child nav menu
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
                            <x-form-input-row-readonly type="text" name="parent" label="parent"
                                value="{{ $navMenuChild->parent->name }}" class="col" />
                        </div>
                        <div class="row">
                            <x-form-input-row-readonly type="text" name="order" label="urutan"
                                value="{{ $navMenuChild->order }}" class="col-md-2" />
                        </div>
                        <div class="row">
                            <x-form-input-row-readonly type="text" name="name" label="nama"
                                value="{{ $navMenuChild->name }}" class="col-md-4" />
                        </div>
                        <div class="row">
                            <x-form-input-row-readonly type="text" name="url" label="url"
                                value="{{ $navMenuChild->url }}" class="col" />
                        </div>
                        <div class="row">
                            <x-form-input-row-readonly type="text" name="created_at" label="dibuat"
                                value="{{ $navMenuChild->created_at->diffForHumans() . ', ' . $navMenuChild->created_at->format('d-m-Y, H:i:s') }}"
                                class="col-md-6" />
                            <x-form-input-row-readonly type="text" name="updated_at" label="diubah"
                                value="{{ $navMenuChild->updated_at->diffForHumans() . ', ' . $navMenuChild->updated_at->format('d-m-Y, H:i:s') }}"
                                class="col-md-6" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
