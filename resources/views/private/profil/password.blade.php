@extends('private.templates.main')

@section('header')
    ganti password
@endsection

@section('container')
    <x-button-link href="{{ route(Request::segment(1) . '.profil.edit', $profil->uuid) }}" label="kembali"
        class="rounded-pill btn-sm btn-outline-secondary mb-3" icon="fa-arrow-left" />

    <form action="{{ route(Request::segment(1) . '.profil.password.update', $profil->uuid) }}" method="post">
        @method('put')
        @csrf
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="form-row">
                            <x-form-input-password name="password" label="password" class="col" />
                        </div>
                        <div class="form-row">
                            <x-form-input-password name="confirmation" label="konfirmasi password" class="col" />
                        </div>
                        <x-button-submit label="simpan" class="rounded-pill btn-primary" icon="fa-save" />
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
