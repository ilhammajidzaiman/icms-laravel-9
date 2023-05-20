@extends('private.templates.main')

@section('header')
    edit profil
@endsection

@section('container')
    <x-button-link href="{{ route(Request::segment(1) . '.profil.index', $profil->uuid) }}" label="kembali"
        class="rounded-pill btn-sm btn-outline-secondary mb-3" icon="fa-arrow-left" />

    <form action="{{ route(Request::segment(1) . '.profil.update', $profil->uuid) }}" method="post"
        enctype="multipart/form-data">
        @method('put')
        @csrf
        <div class="row">
            <div class="col-md-3 p-5">
                @php
                    $path = $profil->path;
                    $file = $profil->file;
                    $file == 'default-user.svg' ? ($url = asset('assets/images/' . $file)) : ($url = asset('storage/' . $path . $file));
                @endphp
                <x-form-file-preview name="file" label="thumbnail" :value="$url" accept=".jpg,.jpeg,.png" />
            </div>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-body">
                        <div class="form-row">
                            <x-form-input-row type="text" name="name" label="nama" :value="old('name', $profil->name)"
                                class="col-md-4" />
                        </div>
                        <div class="form-row">
                            <x-form-input-row type="text" name="username" label="username" :value="old('username', $profil->username)"
                                class="col-md-4" />
                        </div>
                        <div class="form-row">
                            <x-form-input-row type="text" name="email" label="email" :value="old('email', $profil->email)"
                                class="col-md-6" />
                        </div>
                        <div class="form-row">
                            <div class="col mb-3">
                                Ganti password
                                <a
                                    href="{{ route(Request::segment(1) . '.profil.password.edit', $profil->uuid) }}">disini</a>
                            </div>
                        </div>
                        <x-button-submit label="simpan" class="rounded-pill btn-primary" icon="fa-save" />
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('script')
    <script src="{{ asset('/assets/js/image-preview.js') }}"></script>
@endsection
