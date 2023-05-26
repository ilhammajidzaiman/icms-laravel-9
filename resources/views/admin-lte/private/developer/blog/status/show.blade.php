@extends('admin-lte.private.templates.main')

@section('header')
    rincian kategori
@endsection

@section('container')
    <x-button-link href="{{ route('developer.blog.status.index') }}" label="kembali"
        class="rounded-pill btn-sm btn-outline-secondary mb-3" icon="fa-arrow-left" />

    <div class="row">
        <div class="col-md-9 col-lg">
            <div class="card">
                <div class="card-body">
                    <div class="form-row">
                        <x-form-input-row-readonly type="text" name="name" label="nama" value="{{ $status->name }}"
                            class="col-md-4" />
                    </div>
                    <div class="form-row">
                        <x-form-input-row-readonly type="text" name="color" label="warna" value="{{ $status->color }}"
                            class="col-md-4" />
                    </div>
                    <div class="form-row">
                        <x-form-input-row-readonly type="text" name="created_at" label="dibuat"
                            value="{{ $status->created_at->diffForHumans() . ', ' . $status->created_at->format('d-m-Y, H:i:s') }}"
                            class="col" />
                        <x-form-input-row-readonly type="text" name="updated_at" label="diubah"
                            value="{{ $status->updated_at->diffForHumans() . ', ' . $status->updated_at->format('d-m-Y, H:i:s') }}"
                            class="col" />
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
